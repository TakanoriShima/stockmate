<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    // カテゴリー新規投稿画面表示
    public function create(Request $request){
        // ログインしているユーザーが追加した削除していないカテゴリー一覧を取得
        $categories = \Auth::user()->categories->where('delete_flag', false);
        return view('categories.create', ['categories' => $categories]);
    }

    // カテゴリー登録処理
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            //カテゴリー名は必須、50文字以内指定
            'name' => [
                'required',
                'max:50',
                //ログインしているユーザーが登録した削除していないカテゴリーに重複がないか
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('user_id', \Auth::id())->where('delete_flag', false);
                }),
            ],
        ], [
            //すでに登録済みのカテゴリーが入力されたら表示
            'name.unique' => 'その名前はすでに存在します。',
        ]);

        //新規カテゴリーを作成
        $category = new Category;
        $category->user_id = \Auth::id();
        $category->name = $request->name;

        // カテゴリーをデータベースに保存
        $category->save();

        // 持物登録画面へリダイレクト
        return redirect()->route('articles.create')
                        //フラッシュメッセージの設定
                        ->with('success', 'カテゴリー名: ' . $category->name . 'を登録しました');
    }

    // カテゴリー編集画面表示
    public function edit(Request $request, $id){
        // 指定idのカテゴリーデータを取得
        $category = Category::find($id);
        // ログインしているユーザーが追加した削除していないカテゴリー一覧を取得
        $categories = \Auth::user()->categories->where('delete_flag', false);
        return view('categories.edit', ['category' => $category, 'categories' => $categories]);
    }

    // カテゴリー更新処理
    public function update(Request $request, $id){
        // バリデーション
        $request->validate([
            //カテゴリー名は必須、50文字以内指定
            'name' => [
                'required',
                'max:50',
                //ログインしているユーザーが登録した削除していないカテゴリーに重複がないか
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('user_id', \Auth::id())->where('delete_flag', false);
                }),
            ],
        ], [
            //すでに登録済みのカテゴリーが入力されたら表示
            'name.unique' => 'その名前はすでに存在します。',
        ]);
        // 指定idのカテゴリーデータを取得
        $category = Category::find($id);

        // カテゴリー名を変更
        $category->name = $request->name;

        // データベースを更新
        $category->save();

        // カテゴリー登録画面へリダイレクト
        return redirect()->route('categories.create')
                        //フラッシュメッセージの設定
                        ->with('success', 'カテゴリー名: ' . $category->name . 'の情報を更新しました');
    }

    // カテゴリー削除処理（論理削除）
    public function destroy(Request $request, $id){
        // 指定idのカテゴリーデータを取得
        $category = Category::find($id);
        // delete_flagをtrueに更新
        $category->delete_flag = true;
        // データベースの上書き保存
        $category->save();

        // 削除したカテゴリーに属する削除していない持物データ一覧を取得
        $articles = $category->articles->where('delete_flag', false);
        // 削除したカテゴリーに属する持物データを論理削除
        foreach($articles as $article){
            $article->delete_flag = true;
            $article->save();
        }

        // カテゴリー登録画面へリダイレクト
        return redirect()->route('categories.create')
                        //フラッシュメッセージの設定
                        ->with('success', 'カテゴリー名: ' . $category->name . 'を削除しました');
    }
}
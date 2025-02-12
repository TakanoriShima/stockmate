<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{

    // カテゴリー新規投稿画面表示
    public function create(Request $request){
        return view('categories.create');
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
                //ログインしているユーザーが登録したカテゴリーに重複がないか
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('user_id', \Auth::id());
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

        // カテゴリー登録画面へリダイレクト
        return redirect()->route('articles.create')
                        //フラッシュメッセージの設定
                        ->with('success', 'カテゴリー名: ' . $category->name . 'を登録しました');;
    }

}
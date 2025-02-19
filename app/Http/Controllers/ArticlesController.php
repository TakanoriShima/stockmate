<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticlesController extends Controller
{
    // 持物一覧画面表示
    public function index(Request $request){
        // ログインしているユーザーが登録した、削除していない持物一覧を使用期限の昇順に取得
        $articles = Article::whereHas('category', function ($query) {
            $query->where('user_id', auth()->id())->where('delete_flag', false);
        })->where('delete_flag', false)->orderBy('expiration_date', 'asc')->get();

        return view('articles.index', ['articles' => $articles]);
    }

    // 持物登録画面表示
    public function create(Request $request){
        // ログインしているユーザーが追加した削除していないカテゴリー一覧を取得
        $categories = \Auth::user()->categories->where('delete_flag', false);

        // カテゴリーが1つも登録されていない場合は、カテゴリー登録ページへリダイレクト
        if($categories->isEmpty()){
            // セッションにエラーメッセージをセット
            session()->flash('message', '最初にカテゴリーを登録してください。');
            return redirect(route('categories.create'));
        }
        
        return view('articles.create', ['categories'=> $categories]);
    }

    // 持物登録処理
    public function store(Request $request)
    {  
        // バリデーション
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:20',
            'expiration_date' => 'required|date|after_or_equal:today', 
            'stock' => 'required|integer',
        ], [
            // 過去の消費期限の持物は登録できないように、未来日付限定に設定  
            'expiration_date.after_or_equal' => '日付は今日以降を指定してください。',
            // 小数点は入力できないように設定    
            'stock.integer' => '在庫数は整数である必要があります。',
        ]);
        // 新規持物を作成
        $article = new Article;
        $article->category_id = $request->category_id;
        $article->name = $request->name;
        $article->expiration_date= $request->expiration_date;
        $article->stock = $request->stock;
        // もし、メモが記入されていたら
        if($request->memo !== null){
            $article->memo = $request->memo;
        }
        // データベースに持物保存
        $article->save();

        // 持物一覧画面へリダイレクト
        return redirect()->route('articles.index')
                        //フラッシュメッセージの設定
                        ->with('success', '持物名: ' . $article->name . 'を登録しました');
    }    

    // 登録持物変更画面表示
    public function edit(Request $request, $id){
        // 指定idの持物データを取得
        $article = Article::find($id);
        // ログインしているユーザーが追加した削除していないカテゴリー一覧を取得
        $categories = \Auth::user()->categories->where('delete_flag', false);

        return view('articles.edit', ['article'=> $article, 'categories'=> $categories]);
    }

    // 登録持物変更処理
    public function update(Request $request, $id)
    {  
        // バリデーション
        $request->validate([
            'name' => 'required|max:20',
            'expiration_date' => 'required|date|after_or_equal:today',
            'stock' => 'required|integer',
        ], [
            'expiration_date.after_or_equal' => '日付は今日以降を指定してください。',
            'stock.integer' => '在庫数は整数である必要があります。',
        ]);

        // 指定idの持物データを取得
        $article = Article::find($id);
        // データ情報の更新
        $article->category_id = $request->category_id;
        $article->name = $request->name;
        $article->expiration_date= $request->expiration_date;
        $article->stock = $request->stock;
        // もし、メモが記入されていたら
        if($request->memo !== null){
            $article->memo = $request->memo;
        }
        // データベースに持物保存
        $article->save();
        // 持物一覧画面へリダイレクト
        return redirect()->route('articles.index')
                    //フラッシュメッセージの設定
                    ->with('success','持物名: '.$article->name.'を更新しました');
    }    

    // 持物削除処理（論理削除）
     public function destroy(Request $request, $id){
        // 指定idの持物データを取得
        $article = Article::find($id);
        // データベースの持物内容を更新
        $article->delete_flag = true;
        // データベースのレコード更新
        $article->save();

        // 持物一覧画面へリダイレクト
        return redirect()->route('articles.index')
                        //フラッシュメッセージの設定
                        ->with('success', '持物名: ' . $article->name . 'を削除しました');
    }

    // 持物検索画面表示
    public function search(Request $request){
        // ログインしているユーザーが登録したカテゴリー一覧を取得
        $categories = \Auth::user()->categories->where('delete_flag', false);
        // 各種変数を定義
        $category_ids = [];
        $keyword = '';
        $articles = [];
        $stock = '';
        $expiration_date = '';

        return view('articles.search', ['keyword' => $keyword, 'categories' =>  $categories, 'articles' => $articles, 'category_ids' => $category_ids, 'stock' => $stock, 'expiration_date' => $expiration_date]);
     }

    // 持物検索処理 
    public function select_articles(Request $request)
    {
        // 検索画面から入力された値を取得
        $keyword = $request->input('keyword', '');
        $stock = $request->input('stock', '');
        $category_ids = $request->input('categories', []);
        $expiration_date = $request->input('expiration_date');

        // ログインしているユーザーが登録した削除していないカテゴリー一覧を取得
        $categories = \Auth::user()->categories->where('delete_flag', false);

        // クエリビルダーで検索条件を動的に構築
        $query = Article::query()->whereHas('category', function ($query) {
            $query->where('user_id', \Auth()->id())->where('delete_flag', false);
        // 削除したものは表示しない  
        })->where('delete_flag', false);

        // 持物名が入力されていたら
        if (!empty($keyword)) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        // カテゴリーが選択されていたら
        if (!empty($category_ids) && is_array($category_ids)) {
            $query->whereIn('category_id', $category_ids);
        }

        // 在庫数が入力されていたら
        if (!empty($stock)) {
            $query->where('stock', $stock); 
        }

        // 使用期限が入力されていたら
        if (!empty($expiration_date)) {
            $query->where('expiration_date', $expiration_date);
        }

        // 検索の実行
        $articles = $query->get();

        return view('articles.search', [
            'keyword' => $keyword,
            'articles' => $articles,
            'categories' => $categories,
            'category_ids' => $category_ids,
            'stock' => $stock,
            'expiration_date' => $expiration_date
        ]);
    }
}
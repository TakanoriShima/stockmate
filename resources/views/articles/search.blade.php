@extends('layouts.common')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <h1 class="text-center text-primary">商品検索</h1>
    </div> 
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('articles.select_articles')}}">
                <!-- @csrf -->
                <div class="row">
                    <div class="col-12 mb-2 mt-2">
                        <div class="form-group">
                            <input type="search" name="keyword" class="form-control" placeholder="キーワード" value="{{ old('keyword') ? old('keyword') : $keyword }}">
                        </div>
                    </div>
                    <div class="col-12 mb-2 mt-2">
                        <div class="form-group">
                            <input type="number" name="stock" class="form-control" placeholder="ストック" value="{{ old('stock') ? old('stock') : $stock }}">
                        </div>
                    </div>
                    <div class="form-check-inline mb-1">
                    @foreach($categories as $category)
                    <div class="form-check inline">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="flexCheckDefault" {{ in_array($category->id, $category_ids) ? 'checked' : ''}}>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $category->name }}
                        </label>
                    </div>
                    @endforeach
                    </div>
                    <div class="col-12 mb-2 mt-2">
                        <div class="form-group">
                            <input type="date" name="expiration_date" class="form-control" min="{{ date('Y-m-d') }}" placeholder="使用期限" value="{{ old('expiration_date') ? old('expiration_date') : $expiration_date }}">
                        </div>
                    </div>
                    <div class="col-12 mb-2 mt-2">
                        <button type="submit" class="btn btn-primary w-100">検索</button>
                    </div>
                </div> 
            </form>
        </div>          
    </div>
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-12 text-center">
                <p class="result">検索結果は {{ count($articles) }}件です</p>       
            </div>    
        </div>    
        @if(count($articles) > 0)
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">カテゴリー名</th>
                    <th class="text-center">商品名</th>
                    <th class="text-center">在庫数</th>
                    <th class="text-center">消費期限</th>
                    <th class="text-center">操作</th>
                </tr>
                @foreach($articles as $article)
                <tr>
                    <td class="text-center">{{ $article->category->name }}</td>
                    <td class="text-center">{{ $article->name }}</td>
                    <td class="text-center">{{ $article->stock }}</td>
                    <td class="text-center">
                        @if(date('Y-m-d') > $article->expiration_date)
                        <p class="error">期限切れ</p>
                        @endif{{ $article->expiration_date }}
                    </td>
                    <td class="text-center">
                        @if(date('Y-m-d') <= $article->expiration_date)
                        <a class="btn btn-primary" href="{{ route('articles.edit', $article->id) }}">変更</a>
                        @endif
                        <form action = "{{ route('articles.destroy', $article->id) }}" method = "POST">
                            @csrf
                            @method('DELETE')
                            <div class="col-12 mb-2 mt-2">
                            <input type = 'submit' value = '削除' class="btn btn-danger" onclick = 'return confirm("削除しますか？")'>
                            </div>
                        </form> 
                    </td>
                </tr>
                @endforeach
            </table>  
        </div>      
        @endif    
    </div>
</div>
@endsection
@extends('layouts.common')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <h1 class="text-center text-primary">登録一覧</h1>
    </div> 
    <div class="row mb-2 justify-content-center">
        <a class="offset-md-10 col-md-2 btn btn-success" href="{{ route('articles.create')}}">持物登録</a>
    </div> 
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success mt-1">{{ session('success') }}</div>
            @endif
            @if(!$articles->isEmpty())
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">カテゴリー名</th>
                    <th class="text-center">持物名</th>
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
                        @endif
                        {{ $article->expiration_date }}
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
            @else
            <p class="text-center text-danger mt-2">現在、登録されている持物はありません</p>
            @endif
        </div>          
    </div>
</div>
@endsection
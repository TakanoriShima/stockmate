@extends('layouts.common')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <h1 class="text-center text-primary">商品更新画面</h1>
    </div> 
    <div class="row container">
    <form action="{{ route('articles.update', ['article' => $article]) }}" method="POST">
            @if (count($errors) > 0)
                <ul class="alert alert-danger">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
                </ul>
            @endif
            @csrf
            @method('PUT')
            <div class="form-check-inline mb-1">
                @foreach($categories as $category)
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="category_id" id="category{{ $category->id }}" value="{{ $category->id }}" 
                @if($category->id === $article->category_id) checked @endif>
                    <label class="form-check-label" for="category{{ $category->id }}">
                    {{ $category->name }}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="row">
                @error('name')
                 <div class="error"><span>{{ $message }}</span></div>
                @enderror
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="名前" 
                    value="{{ old('article') ? old('article') : $article->name }}">
                    </div>
                </div>
                @error('expiration_date')
                 <div class="error"><span>{{ $message }}</span></div>
                @enderror
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                    <input type="date" name="expiration_date" class="form-control" min="{{ date('Y-m-d') }}" placeholder="使用期限" value="{{ old('expiration_date') ? old('expiration_date') : $article->expiration_date }}">
                    </div>
                </div>
                @error('stock')
                 <div class="error"><span>{{ $message }}</span></div>
                @enderror
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                        <input type="number" name="stock" class="form-control" placeholder="ストック" min="1" value="{{ old('stock') ? old('stock') : $article->stock }}">
                    </div>
                </div>
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                    <input type="text" name="memo" class="form-control" placeholder="メモ" value="{{ old('memo') ? old('memo') : $article->memo }}">
                    </div>
                </div>
                <div class="col-12 mb-2 mt-2">
                    <button type="submit" class="btn btn-primary w-100">変更</button>
                </div>
            </div> 
        </form>
    </div>
</div>
@endsection 

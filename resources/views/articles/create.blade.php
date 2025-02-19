@extends('layouts.common')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <h1 class="text-center text-primary">持物登録</h1>
    </div> 
    <div class="row mb-2 justify-content-center">
        <a class="offset-md-10 col-md-2 btn btn-success" href="{{ route('categories.create')}}">カテゴリー操作</a>
    </div>   
    <div class="row container">
        <form action="{{ route('articles.store')}}" method="POST">
            @if (count($errors) > 0)
                <ul class="alert alert-danger">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
                </ul>
            @endif
            @if(session('success'))
            <div class="alert alert-success mt-1">{{ session('success') }}</div>
            @endif
            @csrf
            <div class="form-check-inline mb-1">
                @error('category_id')
                 <div class="error"><span>{{ $message }}</span></div>
                @enderror
                @foreach($categories as $category)
                <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="category_id" id="category{{ $category->id }}" value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'checked' : ''}}>
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
                    <input type="text" name="name" class="form-control" placeholder="名前" value="{{ old('name') }}">
                    </div>
                </div>
                @error('expiration_date')
                 <div class="error"><span>{{ $message }}</span></div>
                @enderror
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                    <input type="date" name="expiration_date" class="form-control" min="{{ date('Y-m-d') }}" placeholder="使用期限" value="{{ old('expiration_date') }}">
                    </div>
                </div>
                @error('stock')
                 <div class="error"><span>{{ $message }}</span></div>
                @enderror
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                        <input type="number" name="stock" class="form-control" min="1" placeholder="在庫数" value="{{ old('stock') }}">
                    </div>
                </div>
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                        <input type="text" name="memo" class="form-control" placeholder="メモ">
                    </div>
                </div>
                <div class="col-12 mb-2 mt-2">
                    <button type="submit" class="btn btn-primary w-100">登録</button>
                </div>
            </div> 
        </form>
    </div>
</div>
@endsection 
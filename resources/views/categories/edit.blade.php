@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-2">
        <h1 class="text-center text-primary">カテゴリーの編集</h1>
    </div> 

    @if(session('success'))
        <div class="alert alert-success mt-1">{{ session('success') }}</div>
    @endif

    <div class="row container">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @if (count($errors) > 0)
                <ul class="alert alert-danger">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
                </ul>
            @endif
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 mb-2 mt-2">
                    <div class="form-group">
                        <p id="count"></p>
                        <input type="text" name="name" class="form-control" placeholder="名前を50文字以内で入力してください" id="name" value="{{ old('name') ? old('name') : $category->name }}">
                    </div>
                </div>
                <div class="col-12 mb-2 mt-2">
                    <button type="submit" class="btn btn-primary w-100">更新</button>
                </div>
            </div> 
        </form>
    </div>
    <div class="row justify-content-center mt-4">
        <h3 class="text-center text-success mb-3">登録済みのカテゴリー一覧</h3>
        <table class="table table-bordered table-striped">
            <tr>
                <th class="text-center">カテゴリー名</th>
                <th class="text-center">登録持物数</th>
            </tr>
            @foreach($categories as $category)
            <tr>
                <td class="text-center">{{ $category->name }}</td>
                <td class="text-center">{{ count($category->articles->where('delete_flag', false))}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection 


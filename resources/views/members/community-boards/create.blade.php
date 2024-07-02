@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>新しいメッセージを作成</h1>

        <form action="{{ route('community-boards.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="content">内容</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">投稿する</button>
        </form>
    </div>
@endsection

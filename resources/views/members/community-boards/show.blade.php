@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $message->title }}</h1>
        <p>{{ $message->content }}</p>

        <h2>コメント</h2>
        @foreach ($message->comments as $comment)
            <div class="card">
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                    <p>投稿者: {{ $comment->user->name }}</p>
                </div>
            </div>
        @endforeach

        <h2>コメントを追加する</h2>
        <form action="{{ route('comments.store', $message->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">コメント内容</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">コメントする</button>
        </form>
    </div>
@endsection


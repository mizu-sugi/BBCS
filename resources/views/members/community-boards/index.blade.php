<!-- resources/views/messages/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>メッセージ一覧</h1>
    <a href="{{ route('community-boards.create') }}">新規メッセージ作成</a>
    @foreach ($messages as $message)
        <div>
            <h2><a href="{{ route('community-boards.show', $message) }}">{{ $message->title }}</a></h2>
            <p>{{ $message->content }}</p>
            <p>作成者: {{ $message->user->name }}</p>
        </div>
    @endforeach
@endsection

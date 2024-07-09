@extends('layouts.users')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $message->title }}</h1>
        <p class="text-gray-700 mb-4">{{ $message->content }}</p>
        <p class="text-gray-500 mb-8">投稿者: {{ $message->member->name }}</p>

        <h2 class="text-2xl font-bold mb-4">コメント</h2>
        @foreach ($message->comments as $comment)
            <div class="bg-white rounded-lg shadow-md mb-4">
                <div class="p-4">
                    <p class="text-gray-700 mb-2">{{ $comment->content }}</p>
                    <p class="text-gray-500">投稿者: {{ $comment->member->name }}</p>

                    @if (Auth::id() === $comment->member_id)
                        <div class="flex justify-end mt-2">
                            <a href="{{ route('members.community-boards.edit', [$message->id, $comment->id]) }}" class="text-blue-500 hover:underline mr-4">編集</a>
                            <form action="{{ route('members.community-boards.destroy', [$message->id, $comment->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">削除</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <h2 class="text-2xl font-bold mb-4">返信する</h2>
        <form action="{{ route('members.comments.store', $message->id) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">内容</label>
                <textarea id="content" name="content" rows="3" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
            <button type="submit" class="bg-purple-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">送信</button>
        </form>
    </div>
@endsection

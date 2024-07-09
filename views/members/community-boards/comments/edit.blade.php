@extends('layouts.users')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">コメントを編集</h1>
        <form action="{{ route('members.community-boards.comments.update', [$message->id, $comment->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">内容</label>
                <textarea id="content" name="content" rows="3" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('content', $comment->content) }}</textarea>
            </div>
            <button type="submit" class="bg-purple-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">更新</button>
        </form>
    </div>
@endsection
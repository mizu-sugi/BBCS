@extends('layouts.users')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">New Message</h1>

        <form action="{{ route('members.community-boards.store') }}" method="POST" class="max-w-md bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">内容</label>
                <textarea id="content" name="content" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required></textarea>
            </div>

            <button type="submit" class="w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">POST</button>
        </form>
    </div>
@endsection

@extends('layouts.users')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8 text-center">Community Boards</h1>
        <a href="{{ route('members.community-boards.create') }}" class="block w-full max-w-xs mx-auto py-3 px-6 bg-purple-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 text-center mb-8">Create a New Message</a>
        
        <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($messages as $message)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ route('members.community-boards.show', $message) }}" class="block px-6 py-4">
                        <h2 class="text-xl font-semibold text-black-500 hover:underline mb-2">{{ $message->title }}</h2>
                        <p class="text-gray-700 mb-4 line-clamp-3">{{ $message->content }}</p>
                        <p class="text-gray-500">Posted by <span class="font-semibold">{{ $message->member->name }}</span></p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection



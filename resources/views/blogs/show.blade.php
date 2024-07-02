@extends('layouts.default')
@section('title', $blog->title)

@section('content')
<section class="bg-gray-100 pt-2">
    <div class="container mx-auto">
        <p class="text-left px-4 pt-2 text-gray-400"><a href="/" class="text-blue-600 hover:underline">HOME</a><span class="px-2">&gt</span>NEWS</p>
        <h1 class="mt-2 text-4xl font-bold font-heading text-center h-32">{{ $blog->title }}</h1>
    </div>
</section>

<section class="pb-24">
    <div class="container px-4 mx-auto">
        <div class="border rounded-lg overflow-hidden shadow-lg">
            <div class="relative h-56">
                <img class="w-full h-56 object-cover" src="{{ asset('storage/'. $blog->image) }}" alt="">
            </div>
            <div class="pt-2 pb-4 px-4">
                <p class="text-gray-500 leading-relaxed">{{ $blog->body }}</p>
                <div class="flex justify-between mt-4">
                    <time class="block text-xs text-gray-500">{{ $blog->updated_at->format('Y-m-d H:i') }}</time>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

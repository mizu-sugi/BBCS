@extends('layouts.users')

@section('content')
<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <h3 class="text-xl font-bold mb-6">メンバーリスト</h3>
            @foreach($members as $member)
                <div class="mb-4 p-4 bg-gray-100 rounded shadow">
                    <h4 class="text-lg font-semibold">{{ $member->name }}</h4>
                    <p class="text-sm text-gray-600">{{ $member->email }}</p>
                    @if($member->image)
                        <img class="mt-2 w-16 h-16 rounded-full" src="{{ $member->image }}" alt="{{ $member->name }}">
                    @else
                        <img class="mt-2 w-16 h-16 rounded-full" src="{{ asset('path/to/default/image.png') }}" alt="No image">
                    @endif
                    <p class="mt-2 text-sm">{{ $member->introduction }}</p>
                    <a href="{{ route('members.show', $member->id) }}" class="text-blue-500 hover:underline">プロフィールを見る</a>
                </div>
            @endforeach
            @if($members->isEmpty())
                <p class="text-red-500">メンバーが見つかりません。</p>
            @endif
        </div>
    </div>
</section>
@endsection



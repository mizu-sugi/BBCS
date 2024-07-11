@extends('layouts.default')

@section('content')
<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <div class="flex px-6 pb-4 border-b">
                <h3 class="text-xl font-bold">メンバー情報</h3>
            </div>

            <div class="pt-4 px-6">
                @if(session('message'))
                    <div class="mb-8 py-4 px-6 border border-green-300 bg-green-50 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="name">ユーザーネーム</label>
                    <div class="bg-gray-100 px-4 py-3 mb-2 text-sm rounded">
                        {{ $member->name }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="email">メールアドレス</label>
                    <div class="bg-gray-100 px-4 py-3 mb-2 text-sm rounded">
                        {{ $member->email }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="image">画像</label>
                    <div>
                        <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" class="rounded-full shadow-md w-32">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="subtype">サブタイプ</label>
                    <div class="bg-gray-100 px-4 py-3 mb-2 text-sm rounded">
                        {{ $member->subtype }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="stage">ステージ</label>
                    <div class="bg-gray-100 px-4 py-3 mb-2 text-sm rounded">
                        {{ $member->stage }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="current_treatment">治療方法</label>
                    <div class="bg-gray-100 px-4 py-3 mb-2 text-sm rounded">
                    @if (!is_null($member->current_treatment))
                        <ul>
                        @foreach ($member->current_treatment as $treatment)
                        <li>{{ $treatment }}</li>
                        @endforeach
                        </ul>
                    @else
                        <p>No treatments found.</p>
                    @endif
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="introduction">自己紹介文</label>
                    <div class="bg-gray-100 px-4 py-3 mb-2 text-sm rounded">
                        {{ $member->introduction }}
                    </div>
                </div>

                <a href="{{ route('admin.users.management') }}" class="text-sm text-gray-600 underline">一覧に戻る</a>
            </div>
        </div>
    </div>
</section>
@endsection

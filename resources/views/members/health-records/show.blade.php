@extends('layouts.users')

@section('content')

<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">健康記録の詳細</h2>

    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2">体温</label>
        <p class="text-gray-700">{{ $healthRecord->temperature }} ℃</p>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2">症状の評価</label>

        <div class="mb-2">
            <span class="text-gray-700">吐き気: </span>
            <span class="text-gray-700">{{ $healthRecord->nausea_level }}</span>
        </div>

        <div class="mb-2">
            <span class="text-gray-700">倦怠感: </span>
            <span class="text-gray-700">{{ $healthRecord->fatigue_level }}</span>
        </div>

        <div class="mb-2">
            <span class="text-gray-700">痛み: </span>
            <span class="text-gray-700">{{ $healthRecord->pain_level }}</span>
        </div>

        <div class="mb-2">
            <span class="text-gray-700">食欲: </span>
            <span class="text-gray-700">{{ $healthRecord->appetite_level }}</span>
        </div>

        <div class="mb-2">
            <span class="text-gray-700">しびれ: </span>
            <span class="text-gray-700">{{ $healthRecord->numbness_level }}</span>
        </div>

        <div class="mb-2">
            <span class="text-gray-700">不安感: </span>
            <span class="text-gray-700">{{ $healthRecord->anxiety_level }}</span>
        </div>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2">その他、気になる症状</label>
        <p class="text-gray-700">{{ $healthRecord->memo }}</p>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2">作成日時</label>
        <p class="text-gray-700">{{ $healthRecord->created_at->format('Y-m-d H:i:s') }}</p>
    </div>

    <div class="flex justify-end mt-4">
        <a href="{{ route('members.health-records.edit', $healthRecord->id) }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
            編集
        </a>
        <form action="{{ route('members.health-records.destroy', $healthRecord->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                削除
            </button>
        </form>
    </div>
</div>

@endsection
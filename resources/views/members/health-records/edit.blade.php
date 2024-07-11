@extends('layouts.users')

@section('content')

<form action="{{ route('members.health-records.update', $healthRecord->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
    @csrf
    @method('PUT')

    <!-- Body Temperature -->
    <div class="mb-4">
        <label for="temperature" class="block text-gray-700 font-bold mb-2">体温</label>
        <div class="flex items-center">
            <input type="text" id="temperature" name="temperature" value="{{ $healthRecord->temperature }}" placeholder="体温を入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <span class="ml-2 text-gray-600">℃</span>
        </div>
    </div>

    <!-- Symptoms Ratings -->
    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2">症状の評価</label>

        <!-- Nausea -->
        <div class="mb-2">
            <span class="text-gray-700">吐き気</span>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="nausea_level{{ $i }}" class="inline-flex items-center mr-4 cursor-pointer">
                        <input type="radio" id="nausea_level{{ $i }}" name="nausea_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4" {{ $healthRecord->nausea_level == $i ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">{{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <!-- Fatigue -->
        <div class="mb-2">
            <span class="text-gray-700">倦怠感</span>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="fatigue_level{{ $i }}" class="inline-flex items-center mr-4 cursor-pointer">
                        <input type="radio" id="fatigue_level{{ $i }}" name="fatigue_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4" {{ $healthRecord->fatigue_level == $i ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">{{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <!-- Pain -->
        <div class="mb-2">
            <span class="text-gray-700">痛み</span>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="pain_level{{ $i }}" class="inline-flex items-center mr-4 cursor-pointer">
                        <input type="radio" id="pain_level{{ $i }}" name="pain_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4" {{ $healthRecord->pain_level == $i ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">{{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <!-- Appetite -->
        <div class="mb-2">
            <span class="text-gray-700">食欲</span>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="appetite_level{{ $i }}" class="inline-flex items-center mr-4 cursor-pointer">
                        <input type="radio" id="appetite_level{{ $i }}" name="appetite_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4" {{ $healthRecord->appetite_level == $i ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">{{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <!-- Numbness -->
        <div class="mb-2">
            <span class="text-gray-700">しびれ</span>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="numbness_level{{ $i }}" class="inline-flex items-center mr-4 cursor-pointer">
                        <input type="radio" id="numbness_level{{ $i }}" name="numbness_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4" {{ $healthRecord->numbness_level == $i ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">{{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <!-- Anxiety -->
        <div class="mb-2">
            <span class="text-gray-700">不安感</span>
            <div class="flex items-center mt-1">
                @for ($i = 1; $i <= 5; $i++)
                    <label for="anxiety_level{{ $i }}" class="inline-flex items-center mr-4 cursor-pointer">
                        <input type="radio" id="anxiety_level{{ $i }}" name="anxiety_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4" {{ $healthRecord->anxiety_level == $i ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">{{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>
    </div>

    <!-- Memo -->
    <div class="mb-6">
        <label for="memo" class="block text-gray-700 font-bold mb-2">その他、気になる症状</label>
        <textarea id="memo" name="memo" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="症状などを入力してください">{{ $healthRecord->memo }}</textarea>
    </div>

    <!-- Submit Button -->
    <div class="flex items-center justify-between">
        <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            更新
        </button>
        <a href="{{ route('members.health-records.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
            キャンセル
        </a>
    </div>
</form>

@endsection

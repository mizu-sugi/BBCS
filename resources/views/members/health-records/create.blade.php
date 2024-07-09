@extends('layouts.users')

@section('content')

<form action="{{ route('members.health-records.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
    @csrf

    <!-- Body Temperature -->
    <div class="mb-4">
        <label for="temperature" class="block text-gray-700 font-bold mb-2">体温</label>
        <div class="flex items-center">
            <input type="text" id="temperature" name="temperature" placeholder="体温を入力してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                        <input type="radio" id="nausea_level{{ $i }}" name="nausea_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4">
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
                        <input type="radio" id="fatigue_level{{ $i }}" name="fatigue_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4">
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
                        <input type="radio" id="pain_level{{ $i }}" name="pain_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4">
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
                        <input type="radio" id="appetite_level{{ $i }}" name="appetite_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4">
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
                        <input type="radio" id="numbness_level{{ $i }}" name="numbness_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4">
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
                        <input type="radio" id="anxiety_level{{ $i }}" name="anxiety_level" value="{{ $i }}" class="form-radio text-blue-500 h-4 w-4">
                        <span class="ml-2 text-sm text-gray-700">{{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>
    </div>

    <!-- Additional Notes -->
    <div class="mb-6">
        <label for="memo" class="block text-gray-700 font-bold mb-2">その他、気になる症状</label>
        <textarea id="memo" name="memo" placeholder="その他の気になる症状を記入してください" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('memo') }}</textarea>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit" class="bg-purple-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            保存
        </button>
    </div>
</form>

@endsection


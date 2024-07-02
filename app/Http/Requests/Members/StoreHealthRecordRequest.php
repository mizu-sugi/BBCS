<?php

namespace App\Http\Requests\Members;

use Illuminate\Foundation\Http\FormRequest;

class StoreHealthRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'temperature' => ['required', 'numeric'],
            'nausea_level' => ['required', 'integer', 'between:1,5'],
            'fatigue_level' => ['required', 'integer', 'between:1,5'],
            'pain_level' => ['required', 'integer', 'between:1,5'],
            'appetite_level' => ['required', 'integer', 'between:1,5'],
            'numbness_level' => ['required', 'integer', 'between:1,5'],
            'anxiety_level' => ['required', 'integer', 'between:1,5'],
            'memo' => ['nullable', 'string'],
        ];
    }
}

// 'title' => ['required', 'max:255'],
// 'image' => [
//     'required',
//     'file', // ファイルがアップロードされている
//     'image', // 画像ファイルである
//     'max:2000', // ファイル容量が2000kb以下である
//     'mimes:jpeg,jpg,png', // 形式はjpegかpng
//     'dimensions:min_width=300,min_height=300,max_width=1200,max_height=1200', // 画像の解像度が300px * 300px ~ 1200px * 1200px
// ],
// 'body' => ['required', 'max:20000'],
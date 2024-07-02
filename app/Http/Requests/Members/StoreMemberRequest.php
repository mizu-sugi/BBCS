<?php

namespace App\Http\Requests\Members;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => [
                'nullable',
                'file',
                'image',
                'max:2000', // ファイル容量が2000kb以下
                'mimes:jpeg,jpg,png', // 形式はjpegかpng
                'dimensions:min_width=100,min_height=100,max_width=300,max_height=300', // 画像の解像度が100px * 100px ~ 300px * 300px
            ],
            'subtype' => ['nullable', 'string', 'in:hormone_positive_her2_negative,hormone_positive_her2_positive,hormone_negative_her2_positive,triple_negative'],
            'stage' => ['nullable', 'string', 'in:stage0,stage1,stage2,stage3,stage4'],
            'current_treatment' => ['nullable', 'array'],
            'current_treatment.*' => ['string', 'in:just_diagnosed,surgery,radiation_therapy,chemotherapy,targeted_therapy,hormone_therapy,under_observation,folk_remedies,others'],
            'introduction' => ['nullable', 'string', 'max:255'],
        ];
    }

    // 属性名の翻訳
    public function attributes()
    {
        return [
            'name' => 'ユーザーネーム',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'password_confirmation' => 'パスワード(確認)',
            'image' => '画像',
            'subtype' => 'サブタイプ',
            'stage' => 'ステージ',
            'current_treatment' => '治療方法',
            'introduction' => '自己紹介文',
        ];
    }

    // エラーメッセージのカスタマイズ
    public function messages()
    {
        return [
            'name.required' => 'ユーザーネームは必須項目です。',
            'email.required' => 'メールアドレスは必須項目です。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.required' => 'パスワードは必須項目です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワード確認が一致しません。',
            'image.image' => '画像ファイルをアップロードしてください。',
            'image.max' => '画像ファイルのサイズは2MB以下にしてください。',
            'image.mimes' => '画像ファイルの形式はjpegまたはpngにしてください。',
            'image.dimensions' => '画像の解像度は100px x 100px 〜 300px x 300pxにしてください。',
            'subtype.in' => '選択したサブタイプが正しくありません。',
            'stage.in' => '選択したステージが正しくありません。',
            'current_treatment.array' => '治療方法は配列で入力してください。',
            'current_treatment.*.in' => '選択した治療方法が正しくありません。',
            'introduction.max' => '自己紹介文は255文字以内で入力してください。',
        ];
    }
}

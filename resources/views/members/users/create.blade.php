@extends('layouts.default')

@section('content')
<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <form action="{{ route('members.users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex px-6 pb-4 border-b">
                    <h3 class="text-xl font-bold">メンバー登録</h3>

                </div>

                <div class="pt-4 px-6">
                    <!-- ▼▼▼▼エラーメッセージ▼▼▼▼　-->
                    @if($errors->any())
                        <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-400">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- ▲▲▲▲エラーメッセージ▲▲▲▲　-->

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="name">ユーザーネーム</label>
                        <input id="name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="text" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="email">メールアドレス</label>
                        <input id="email" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="password">パスワード</label>
                        <input id="password" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="password" name="password">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="password_confirmation">パスワード(確認)</label>
                        <input id="password_confirmation" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="password" name="password_confirmation">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="image">画像</label>
                        <div class="flex items-end">
                            <img id="previewImage" src="/images/admin/noimage.jpg" data-noimage="/images/admin/noimage.jpg" alt="" class="rounded-full shadow-md w-32">
                            <input id="image" class="block w-full px-4 py-3 mb-2" type="file" accept='image/*' name="image">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="subtype">サブタイプ</label>
                        <select id="subtype" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="subtype">
                            <option value="" disabled selected>選択してください</option>
                            <option value="hormone_positive_her2_negative">ホルモン受容体陽性/HER2陰性</option>
                            <option value="hormone_positive_her2_positive">ホルモン受容体陽性/HER2陽性</option>
                            <option value="hormone_negative_her2_positive">ホルモン受容体陰性/HER2陽性</option>
                            <option value="triple_negative">トリプルネガティブ</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="stage">ステージ</label>
                        <select id="stage" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="stage">
                            <option value="" disabled selected>選択してください</option>
                            <option value="stage0">ステージ0</option>
                            <option value="stage1">ステージⅠ</option>
                            <option value="stage2">ステージⅡ</option>
                            <option value="stage3">ステージⅢ</option>
                            <option value="stage4">ステージⅣ</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="current_treatment">治療方法</label>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="just_diagnosed">
                                <span class="ml-2">診断を受けたばかり</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="surgery">
                                <span class="ml-2">手術</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="radiation_therapy">
                                <span class="ml-2">放射線治療</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="chemotherapy">
                                <span class="ml-2">化学療法</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="targeted_therapy">
                                <span class="ml-2">分子標的療法</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="hormone_therapy">
                                <span class="ml-2">ホルモン療法</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="under_observation">
                                <span class="ml-2">経過観察中</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="folk_remedies">
                                <span class="ml-2">民間療法</span>
                            </label>
                        </div>
                        <div class="block">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox" name="treatment[]" value="others">
                                <span class="ml-2">その他</span>
                            </label>
                        </div>
                </div>



                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="introduction">自己紹介文</label>
                        <textarea id="introduction" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="introduction" rows="2">{{ old('introduction') }}</textarea>
                    </div>

                    <div class="ml-auto">
                        <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-black rounded-md">登録</button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</section>

<script>
    // 画像プレビュー
    document.getElementById('image').addEventListener('change', e => {
        const previewImageNode = document.getElementById('previewImage')
        const fileReader = new FileReader()
        fileReader.onload = () => previewImageNode.src = fileReader.result
        if (e.target.files.length > 0) {
            fileReader.readAsDataURL(e.target.files[0])
        } else {
            previewImageNode.src = previewImageNode.dataset.noimage
        }
    })
</script>
@endsection
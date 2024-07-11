<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Members\StoreMemberRequest;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                // すべてのメンバーを取得
                $members = Member::all();
              

                // ビューにデータを渡す
                return view('members.tinder.index', compact('members'));
    }

    public function management()
    {
        // ここにメンバーの一覧を取得するロジックを記述する
        $members = Member::all(); // 例として全てのメンバーを取得する

        // management.blade.php ビューを返す
        return view('admin.users.management', [
            'members' => $members,
        ]);
    }

    //メンバー登録画面の表示
    public function create()
    {
        return view('members.users.create');
    }

    //メンバー登録処理
    public function store(StoreMemberRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|string|min:8|confirmed',
            'subtype' => 'required|in:hormone_positive_her2_negative,hormone_positive_her2_positive,hormone_negative_her2_positive,triple_negative',
            'stage' => 'required|in:stage0,stage1,stage2,stage3,stage4',
            'current_treatment' => ['required', 'array'],
            'current_treatment.*' => ['string', 'in:just_diagnosed,surgery,radiation_therapy,chemotherapy,targeted_therapy,hormone_therapy,under_observation,folk_remedies,others'],
            'introduction' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $validatedData['image'] = $request->file('image')->store('users', 'public');
        $validatedData['password'] = Hash::make($validatedData['password']);

                // current_treatment を配列から文字列に変換
    if (isset($validatedData['current_treatment']) && is_array($validatedData['current_treatment'])) {
        $validatedData['current_treatment'] = implode(',', $validatedData['current_treatment']);
    }

        Member::create($validatedData);

        return redirect()->route('members.login')->with('success', 'ユーザを登録しました');
    }


    public function show($id)
{
    // メンバーの詳細を取得する処理
    $member = Member::findOrFail($id);
    
    return view('members.show', compact('member'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}

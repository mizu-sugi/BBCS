<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class MemberAuthController extends Controller
{
    public function showLoginForm()
{
    return view('members.login');
}

public function login(Request $request)
{
    
    // バリデーション(フォームリクエストに書き換え可)
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // ログイン情報が正しいか
    // Auth::attemptメソッドでログイン情報が正しいか検証
    if (Auth::guard('members')->attempt($credentials)) {
        // セッションを再生成する処理(セキュリティ対策)
        $request->session()->regenerate();

        // ミドルウェアに対応したリダイレクト(後述)
        // 下記はredirect('/admin/blogs')に類似
        return redirect()->intended('/members/health-records/index');
    }

    // ログイン情報が正しくない場合のみ実行される処理(return すると以降の処理は実行されないため)
    // 一つ前のページ(ログイン画面)にリダイレクト
    // その際にwithErrorsを使ってエラーメッセージで手動で指定する
    // リダイレクト後のビュー内でold関数によって直前の入力内容を取得出来る項目をonlyInputで指定する
    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません',
    ])->onlyInput('email');
    }

    public function index()
{
    $member = Auth::guard('members')->user();
    $healthRecords = $member->healthRecords;

    return view('members.health-records.index', compact('healthRecords'));
}


public function logout(Request $request)
{
    // ログアウト処理
    Auth::guard('members')->logout();
    // 現在使っているセッションを無効化(セキュリティ対策のため)
    $request->session()->invalidate();
    // セッションを無効化を再生成(セキュリティ対策のため)
    $request->session()->regenerateToken();

    return redirect()->route('members.login');
}

}

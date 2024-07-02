<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Members\HealthRecordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Members\MemberController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Members\MemberAuthController;

use App\Http\Controllers\Members\MessageController;
use App\Http\Controllers\Members\CommentController;




Route::get('/', function () {
    return view('index');
});

//管理画面
Route::prefix('/admin')
    ->name('admin.')

    ->group(function () {
        //ログイン時のみアクセス可能なルート
        Route::middleware('auth')
            ->group(function () {
                //ブログ
                Route::resource('/blogs', AdminBlogController::class)->except('show');

                //ユーザ登録
                Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
                Route::post('/users', [UserController::class, 'store'])->name('users.store');

                //ログアウト
                Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
            });
        //未ログイン時のみアクセス可能なルート
        Route::middleware('guest')
            ->group(function () {
                //ログイン
                Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
                Route::post('/login', [AuthController::class, 'login']);

            }); 
    });


    //ブログ
    
    Route::get('/blogs/first', [BlogController::class, 'showFirstBlog']);
    Route::get('/blogs/index', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/', [BlogController::class, 'latestThree'])->name('home');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');



//体調管理
Route::middleware('auth:members')->group(function () {
    Route::get('/members/health-records/index', [HealthRecordController::class, 'index'])->name('members.health-records.index');
    Route::get('/members/health-records/create', [HealthRecordController::class, 'create'])->name('members.health-records.create');
    Route::post('/members/health-records', [HealthRecordController::class, 'store'])->name('members.health-records.store');
    Route::get('/members/health-records/{healthRecord}/edit', [HealthRecordController::class, 'edit'])->name('members.health-records.edit');
    Route::put('/members/health-records/{healthRecord}', [HealthRecordController::class, 'update'])->name('members.health-records.update');
    Route::delete('/members/health-records/{healthRecord}', [HealthRecordController::class, 'destroy'])->name('members.health-records.destroy');
});



//メンバーマイページ
Route::get('/members/users/create', [MemberController::class, 'create'])->name('members.users.create');
Route::post('/members/users', [MemberController::class, 'store'])->name('members.users.store');

//メンバー認証
Route::get('/members/login', [MemberAuthController::class, 'showLoginForm'])->name('members.login');
Route::post('/members/login', [MemberAuthController::class, 'login']);
Route::post('/members/logout', [MemberAuthController::class, 'logout'])->name('members.logout');

//tinder
Route::get('/members/tinder/index', [MemberController::class, 'index'])->name('members.tinder.index');
Route::get('/members/{id}', [MemberController::class, 'show'])->name('members.show');

Route::get('/admin/users/management', [MemberController::class, 'management'])->name('admin.users.management');
Route::get('/members/{id}', [MemberController::class, 'show'])->name('members.show');


//掲示板
Route::resource('/members/community-boards', MessageController::class);
Route::resource('/members/community-boards.comments', CommentController::class)->shallow();
Route::post('/members/community-boards/{message}/comments', [CommentController::class, 'store'])->name('comments.store');


















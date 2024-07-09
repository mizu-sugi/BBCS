<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Members\HealthRecordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Members\MemberController;
use App\Http\Controllers\Members\TweetController;


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
    //Route::get('/members/health-records/{healthRecord}/edit', [HealthRecordController::class, 'edit'])->name('members.health-records.edit');
    Route::put('/members/health-records/{healthRecord}', [HealthRecordController::class, 'update'])->name('members.health-records.update');
    Route::delete('/members/health-records/{healthRecord}', [HealthRecordController::class, 'destroy'])->name('members.health-records.destroy');
    Route::get('/members/health-records/{id}/edit', 'HealthRecordController@edit')->name('health-records.edit');
});



//メンバーマイページ
Route::get('/members/users/create', [MemberController::class, 'create'])->name('members.users.create');
Route::post('/members/users', [MemberController::class, 'store'])->name('members.users.store');

//メンバー認証
Route::get('/members/login', [MemberAuthController::class, 'showLoginForm'])->name('members.login');
Route::post('/members/login', [MemberAuthController::class, 'login']);
Route::post('/members/logout', [MemberAuthController::class, 'logout'])->name('members.logout');


//管理者のユーザー管理
Route::get('/admin/users/management', [MemberController::class, 'management'])->name('admin.users.management');
Route::get('/members/{id}', [MemberController::class, 'show'])->name('members.show');


//community-boards
Route::middleware('auth:members')->group(function () {
    Route::get('/members/community-boards/index', [MessageController::class, 'index'])->name('members.community-boards.index');
    Route::get('/members/community-boards/{message}', [MessageController::class, 'show'])->name('members.community-boards.show');
    Route::get('/members/community-boards/create', [MessageController::class, 'create'])->name('members.community-boards.create');
    Route::post('/members/community-boards', [MessageController::class, 'store'])->name('members.community-boards.store');
    Route::get('/members/community-boards/{message}/edit', [MessageController::class, 'edit'])->name('members.community-boards.edit');
    Route::put('/members/community-boards/{message}', [MessageController::class, 'update'])->name('members.community-boards.update');
    Route::delete('/members/community-boards/{message}', [MessageController::class, 'destroy'])->name('members.community-boards.destroy');

    // Comments routes
    Route::post('/members/community-boards/{message}/comments', [CommentController::class, 'store'])->name('members.community-boards.comments.store');
    Route::get('/members/community-boards/{message}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('members.community-boards.comments.edit');
    Route::put('/members/community-boards/{message}/comments/{comment}', [CommentController::class, 'update'])->name('members.community-boards.comments.update');
    Route::delete('/members/community-boards/{message}/comments/{comment}', [CommentController::class, 'destroy'])->name('members.community-boards.comments.destroy');
    Route::get('/members/community-boards/comments/index', [MessageController::class, 'index'])->name('members.community-boards.comments.index');

});


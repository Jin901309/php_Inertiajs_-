<?php

use App\Http\Controllers\WelcomeCtl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PostCtl;
use Illuminate\Foundation\Application;
use App\Http\Controllers\User\FriendCtl;
use App\Http\Controllers\User\MemberCtl;
use App\Http\Controllers\User\CommentCtl;
use App\Http\Controllers\User\ProfileCtl;
use App\Http\Controllers\User\PostLikeCtl;
use App\Http\Controllers\User\DashboardCtl;
use App\Http\Controllers\User\CommentLikeCtl;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->get('/', [WelcomeCtl::class, 'show'])->name('welcome');

Route::middleware(['guest'])->get('/test', [WelcomeCtl::class, 'index'])->name('test');


Route::middleware(['auth:sanctum', 'verified'])->prefix('user')->group(function() {
    Route::get('dashboard', [DashboardCtl::class, 'index'])->name('dashboard.index');
    Route::get('profile/{user:username}', [ProfileCtl::class, 'show'])->name('profiles.show');
    Route::get('members', [MemberCtl::class, 'index'])->name('members.index');
    Route::prefix('friends')->name('friends.')->group(function(){
        Route::get('', [FriendCtl::class, 'index'])->name('index');
        Route::post('/{user}', [FriendCtl::class, 'store'])->name('store');
        Route::patch('/{user}', [FriendCtl::class, 'update'])->name('update');
        Route::get('/{user}', [FriendCtl::class, 'deny'])->name('deny');
        Route::delete('/{user}', [FriendCtl::class, 'destroy'])->name('destroy');
    });
    Route::prefix('posts')->name('posts.')->group(function(){
        Route::post('', [PostCtl::class, 'store'])->name('store');
        Route::delete('/{post}', [PostCtl::class, 'destroy'])->name('destroy');

    });
    Route::prefix('comments')->name('comments.')->group(function() {
        Route::post('/{post}/comments', [CommentCtl::class, 'store'])->name('store');
    });

    Route::prefix('post-like')->name('post-like.')->group(function(){
        Route::post('/{post}', [PostLikeCtl::class, 'store'])->name('store');
        Route::delete('/{post}', [PostLikeCtl::class, 'destroy'])->name('destroy');
    });
    Route::prefix('comment-like')->name('comment-like.')->group(function(){
        Route::post('/{comment}', [CommentLikeCtl::class, 'store'])->name('store');
        Route::delete('/{comment}', [CommentLikeCtl::class, 'destroy'])->name('destroy');
    });
    Route::prefix('notifications')->name('notifications.')->group(function() {
        Route::post('/mark-one/{id}', [NotificationController::class, 'store'])->name('store');
        Route::get('/mark-all', [NotificationController::class, 'update'])->name('update');
        Route::get('/mark-delete/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    });
});



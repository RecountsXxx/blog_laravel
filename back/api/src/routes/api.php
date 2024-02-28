<?php

use App\Http\Controllers\Account\AvatarUploadController;
use App\Http\Controllers\Account\UserChangeDataController;
use App\Http\Controllers\Auth\ConfirmEmailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostOperations\AddCommentPostController;
use App\Http\Controllers\Post\PostOperations\AddLikePostController;
use App\Http\Controllers\Post\PostOperations\AddViewPostController;
use App\Http\Controllers\Report\ReportCommentController;
use App\Http\Controllers\Report\ReportPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class)->name('auth.register');
    Route::post('login', LoginController::class)->name('auth.login');
    Route::get('confirm-email/{id}/{token}', ConfirmEmailController::class)->name('auth.confirm-email');

    Route::middleware(['check.auth.jwt'])->group(function () {
        Route::get('logout', LogoutController::class)->name('auth.logout');
    });
});

Route::prefix('account')->middleware(['check.auth.jwt'])->group(function () {
    Route::post('avatar-upload', AvatarUploadController::class)->name('account.avatar-upload');
    Route::put('update-user', UserChangeDataController::class)->name('account.update-user');
});

Route::apiResource('post', PostController::class);
Route::prefix('post')->group(function () {
    Route::middleware('check.auth.jwt')->group(function () {
        Route::post('add_like', AddLikePostController::class)->name('post.add-like');
        Route::post('add_comment', AddCommentPostController::class)->name('post.add-comment');
    });

    Route::post('add_view', AddViewPostController::class)->name('post.add-view');
    Route::post('user', [PostController::class, 'GetPostsOnUser'])->name('post.get-posts-on-user');
    Route::post('category', [PostController::class, 'GetPostsOnCategory'])->name('post.get-posts-on-category');
});

Route::prefix('report')->middleware('check.auth.jwt')->group(function () {
    Route::post('comment', ReportCommentController::class)->name('report.comment');
    Route::post('post', ReportPostController::class)->name('report.post');
});

Route::prefix('category')->group(function () {
    Route::get('/', CategoryController::class)->name('category.index');
});


<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Report\ReportCommentController;
use App\Http\Controllers\Report\ReportPostController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('admin')->group(function (){

    Route::prefix('auth')->group(function () {
        Route::post('login', LoginController::class)->name('auth.login');
        Route::middleware(['check.auth.jwt'])->group(function () {
            Route::post('register', RegisterController::class)->name('auth.register');
            Route::get('logout', LogoutController::class)->name('auth.logout');
        });
    });
    Route::middleware(['check.auth.jwt'])->group(function () {
        Route::apiResource('post',PostController::class);
        Route::apiResource('category',CategoryController::class);
        Route::apiResource('admin',AdminController::class);

        Route::apiResource('user',UserController::class);
        Route::post('/user/ban_posts/{id}',[UserController::class, 'ban_posts']);
        Route::post('/user/ban_comments/{id}',[UserController::class, 'ban_comments']);
        Route::post('/user/unban/{id}',[UserController::class, 'unban']);

        Route::apiResource('report_post',ReportPostController::class);
        Route::apiResource('report_comment',ReportCommentController::class);

        Route::get('/dashboard',[DashboardController::class, 'index']);
    });
});

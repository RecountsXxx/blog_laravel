<?php

use App\Http\Controllers\Account\AvatarUploadController;
use App\Http\Controllers\Auth\ConfirmEmailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can registerPage API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', RegisterController::class)->name('api.auth.register');
Route::post('auth/login', LoginController::class)->name('api.auth.login');
Route::get('auth/confirm-email/{id}/{token}', ConfirmEmailController::class)->name('api.auth.confirm_email');

Route::middleware(['check.auth.jwt'])->group(function () {
    Route::post('account/avatar-upload', AvatarUploadController::class)->name('api.account.avatar_upload');

});

//сделай middleware для админа токо админ может создать категории
Route::resource('category',\App\Http\Controllers\Category\CategoryController::class);
//пост только для авторизированого юзера
Route::resource('post',\App\Http\Controllers\Posts\PostController::class);

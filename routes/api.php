<?php

use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout']);

//email verification
Route::get('email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware('auth', 'signed');

//reset password
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

//Google authentication
Route::prefix('google/auth')->group(function () {
	Route::get('redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
	Route::get('callback', [GoogleController::class, 'callBackFromGoogle'])->name('google.callback');
});

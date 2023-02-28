<?php

use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegistrationController::class, 'register']);

//email verification
Route::get('email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware('verify');

//reset password
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('{locale}/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

//Google authentication
Route::prefix('google/auth')->controller(GoogleController::class)->group(function () {
	Route::get('redirect', 'redirect')->name('google.redirect');
	Route::get('callback', 'callBackFromGoogle')->name('google.callback');
	Route::post('login', 'login')->name('google.login');
});

Broadcast::routes(['middleware' => 'auth:sanctum']);

// Auth routes
Route::middleware('auth:sanctum')->group(function () {
	Route::controller(LoginController::class)->group(function () {
		Route::get('/user', 'user');
		Route::post('/logout', 'logout');
	});

	//movie crud
	Route::controller(MovieController::class)->group(function () {
		Route::get('/movie-list', 'index');
		Route::post('/movie-list/search', 'search');
		Route::post('/movies', 'store');
		Route::get('/movie/{id}', 'get');
		Route::post('/movie/{id}', 'update');
		Route::delete('/movie/{id}', 'destroy');
	});

	//Quote Crud
	Route::controller(QuoteController::class)->group(function () {
		Route::post('/quotes', 'getAll');
		Route::get('/quotes/{id}', 'index');
		Route::get('/quote/{id}', 'get');
		Route::post('/quote', 'store');
		Route::post('/quote-update', 'update');
		Route::delete('/quote/{id}', 'destroy');
		Route::post('/quotes/search', 'search');
	});

	//Profile
	Route::controller(ProfileController::class)->group(function () {
		Route::post('/user-update', 'update');
		Route::get('/emails', 'get');
		Route::post('/email-create', 'create');
		Route::delete('/email-destroy/{email:id}', 'destroy');
		Route::post('/secondary-email-verify', 'verify');
		Route::post('/make-email-primary/{email}', 'makePrimary');
	});

	Route::controller(LikeController::class)->group(function () {
		Route::post('quotes/{quote:id}/like', 'like');
	});

	Route::controller(CommentController::class)->group(function () {
		Route::post('/quotes/{quote:id}/comment', 'store');
	});

	Route::controller(NotificationController::class)->group(function () {
		Route::get('/notifications', 'get');
		Route::get('/notifications/read', 'markAsRead');
	});
});

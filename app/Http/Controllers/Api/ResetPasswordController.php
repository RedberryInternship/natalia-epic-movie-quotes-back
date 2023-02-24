<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeEmailRequest;
use App\Http\Requests\storeResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
	public function sendResetLink(storeEmailRequest $request)
	{
		$request->validated();
		$status = Password::sendResetLink(
			$request->only('email')
		);
		return $status === Password::RESET_LINK_SENT
		? response()->json('Password reset link sent!', 200)
		 : response()->json('email not found', 404);
	}

	public function showResetForm($token)
	{
		return redirect(config('app.frontend_url') . '?token=' . $token . '&email=' . request()->email);
	}

	public function resetPassword(storeResetPasswordRequest $request)
	{
		$request->validated();
		$status = Password::reset(
			$request->only('email', 'password', 'confirm_password', 'token'),
			function ($user, $password) {
				$user->forceFill([
					'password' => Hash::make($password),
				])->setRememberToken(Str::random(60));
				$user->save();
				event(new PasswordReset($user));
			}
		);
		return $status === Password::PASSWORD_RESET
					? response()->json('Password has changed successfully!', 200)
					: response()->json(['email' => [__($status)]], 404);
	}
}

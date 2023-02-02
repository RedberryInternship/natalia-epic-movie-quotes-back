<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
	public function redirect()
	{
		return Socialite::driver('google')->redirect();
	}

		public function callBackFromGoogle()
		{
			try
			{
				$googleUser = Socialite::driver('google')->user();
				$user = User::where('email', $googleUser->getEmail())->first();

				if (!$user)
				{
					$saveUser = User::create([
						'name'      => $googleUser->getName(),
						'email'     => $googleUser->getEmail(),
						'google_id' => $googleUser->getId(),
					]);
					$token = Auth::login($saveUser);
					return response()->json([
						'message' => 'success',
					]);
				}
				else
				{
					Auth::login($user);

					return response()->json([
						'message' => 'success',
					]);
				}
			}
			catch(\Throwable $th)
			{
				throw($th);
			}
		}
}

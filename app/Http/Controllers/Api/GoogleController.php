<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
	public function redirect()
	{
		return Socialite::driver('google')->stateless()->redirect();
	}

	public function callBackFromGoogle(Request $request)
	{
		$data = $request->all();
		return redirect(config('app.frontend_url') . '/oauth?' . http_build_query($data));
	}

	public function login()
	{
		$googleUser = Socialite::driver('google')->stateless()->user();
		$user = User::where('email', $googleUser->getEmail())->first();
		if (!$user)
		{
			$saveUser = User::create([
				'name'      => $googleUser->getName(),
				'email'     => $googleUser->getEmail(),
				'thumbnail' => $googleUser->getAvatar(),
				'google_id' => $googleUser->getId(),
			]);

			auth()->login($saveUser);
			if (auth()->check())
			{
				return response('', 200);
			}
			else
			{
				return response()->json('Login failed');
			}
		}
		else
		{
			auth()->login($user);
			return  response('', 200);
		}
	}
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
	public function redirect()
	{
		return Socialite::driver('google')->stateless()->redirect();
	}

	   public function callBackFromGoogle()
	   {
	   	try
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

	   			auth()->loginUsingId($saveUser->id);
	   			$cookie = Cookie::make('authenticated', 1);
	   			if (auth()->check())
	   			{
	   				return redirect(env('FRONTEND_URL') . '/news-feed')->with($cookie);
	   			}
	   			else
	   			{
	   				return response()->json('Login failed');
	   			}
	   		}
	   		else
	   		{
	   			Auth::login($user);
	   			$cookie = Cookie::make('authenticated', 1);

	   			return redirect(env('FRONTEND_URL') . '/news-feed')->withCookie($cookie);
	   		}
	   	}
	   	catch(\Throwable $th)
	   	{
	   		throw($th);
	   	}
	   }
}

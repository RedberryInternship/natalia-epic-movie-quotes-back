<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
	public function user()
	{
		return response(['user' => auth()->user()]);
	}

	public function login(LoginRequest $request)
	{
		$field_type = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
		$request->merge([$field_type => $request->email]);

		if (auth()->attempt($request->only([$field_type, 'password']), $request->remember_me))
		{
			$request->session()->regenerate();
			$user = Auth::user();
			if ($user->email_verified_at != null)
			{
				return response(['user' => $user]);
			}

			return response()->json(['message' => 'Not verified'], 401);
		}

		$user = User::whereHas('emails', function ($query) use ($request) {
			$query->where('email', $request->email);
		})->first();

		if ($user && Hash::check($request->password, $user->password))
		{
			if ($request->email_verified_at != null)
			{
				auth()->login($user);
				$request->session()->regenerate();
				return response(['user' => $user]);
			}

			return response()->json(['message' => 'Not verified'], 401);
		}

		return response()->json(['message' => 'Invalid credentials'], 401);
	}

	public function logout()
	{
		Auth::guard('web')->logout();
		request()->session()->invalidate();

		return response()->json(['message' => 'Logged Out']);
	}
}

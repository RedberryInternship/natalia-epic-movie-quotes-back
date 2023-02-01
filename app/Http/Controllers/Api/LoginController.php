<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

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

		if (auth()->attempt($request->only([$field_type, 'password'])))
		{
			$request->session()->regenerate();
			$user = Auth::user();
			return response(['user' => $user]);
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

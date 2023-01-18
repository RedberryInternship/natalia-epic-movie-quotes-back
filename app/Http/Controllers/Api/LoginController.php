<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function user(){
		return response(['user' => auth()->user()]);
	}

	public function login(LoginRequest $request): JsonResponse
	{
		$vallidated = $request->validated();

		if (Auth::attempt($vallidated))
		{
			request()->session()->regenerate();
			return response()->json(['message' => 'Successfully logged in']);
		}

		return response()->json(['message' => 'Invalid Credentials'], 401);
	}

	public function logout()
	{
		Auth::logout();
		request()->session()->invalidate();
		request()->session()->regenerateToken();
		return response(['message' => 'Logged Out']);
	}
}

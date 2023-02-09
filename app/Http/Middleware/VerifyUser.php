<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class VerifyUser extends Middleware
{
	protected function redirectTo($request)
	{
		if (!$request->expectsJson())
		{
			$user = User::find($request->id);
			$user->markEmailAsVerified();
			return env('FRONTEND_URL') . '?verification=true';
		}
	}
}

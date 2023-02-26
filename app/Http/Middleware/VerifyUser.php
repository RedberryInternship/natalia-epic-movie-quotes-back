<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class VerifyUser extends Middleware
{
	protected function redirectTo($request)
	{
		$locale = $request->query('locale');
		if (!$request->expectsJson())
		{
			$user = User::find($request->id);
			if ($user->email_verified_at === null)
			{
				$user->markEmailAsVerified();
				$user->save();
				return config('app.frontend_url') . '/' . $locale . '?verification=true';
			}
			else
			{
				return config('app.frontend_url') . '/' . $locale . '/403';
			}
		}
	}
}

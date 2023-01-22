<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
	public function notice()
	{
		return response()->json([
			'message' => 'email verification sent',
		]);
	}

	public function verify(Request $request)
	{
		$user = User::where('id', $request->id)->first();
		$user->email_verified_at = Carbon::now();
		$user->save();
		return response()->json('Email has been Verified', 200);
	}
}

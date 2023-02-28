<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
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
		$user->markEmailAsVerified();
		$user->save();
		return response()->json('Email has been Verified', 200);
	}
}

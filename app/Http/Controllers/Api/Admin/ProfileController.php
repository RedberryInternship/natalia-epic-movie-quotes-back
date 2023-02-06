<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\addEmailRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Mail\SecondaryVerificationMail;
use App\Models\Email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
	public function update(ProfileUpdateRequest $request)
	{
		$attributes = $request->validated();
		$user = User::findOrFail(auth()->id());
		if (isset($attributes['thumbnail']))
		{
			$attributes['thumbnail'] = request()->file('thumbnail')->store('images');
			$user->thumbnail = env('APP_URL') . '/storage/' . $attributes['thumbnail'];
		}

		if (isset($attributes['name']))
		{
			$user->name = $attributes['name'];
		}
		if (isset($attributes['password']))
		{
			$user->password = Hash::make($attributes['password']);
		}
		$user->save();
		return response()->json('profile updated', 200);
	}

	public function create(addEmailRequest $request)
	{
		$attributes = $request->validated();
		$user = User::findOrFail(auth()->id());
		$attributes['user_id'] = $user->id;
		$attributes['token'] = Str::random(60);
		Email::create($attributes);
		$email = Email::where('email', $request->email)->first();

		Mail::to($email->email)->send(new SecondaryVerificationMail($user, $email));
		return response('Email Created successfully and confirmation link was sent to the user!', 200);
	}

	public function get()
	{
		$user = User::findOrFail(auth()->id());
		return response()->json($user->emails, 200);
	}

	public function destroy(Email $email)
	{
		$email->delete();
		return response()->json('Email deleted successfully', 200);
	}

	public function verify()
	{
		$email = Email::where('token', request()[0])->first();
		if (isset($email))
		{
			$email->email_verified_at = Carbon::now();
			$email->save();
			return response()->json('Email verified Successfully!', 200);
		}
		return response()->json(['error'=>'Email Verification failed!']);
	}
}

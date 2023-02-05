<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\addEmailRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
		$email = Email::create($attributes);
		return response('Email Created successfully!', 200);
	}
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeResetPasswordRequest extends FormRequest
{
	public function rules()
	{
		return [
			'token'            => 'required',
			'email'            => 'required|exists:users,email',
			'password'         => 'required',
			'confirm_password' => 'required',
		];
	}
}

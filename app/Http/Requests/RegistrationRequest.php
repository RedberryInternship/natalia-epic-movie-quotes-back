<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name'     => 'required|unique:users,name',
			'email'    => 'required|unique:users,email',
			'password' => 'required',
		];
	}
}

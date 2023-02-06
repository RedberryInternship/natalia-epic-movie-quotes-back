<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class addEmailRequest extends FormRequest
{
	public function rules()
	{
		return [
			'email' => 'required|unique:users,email|unique:emails,email',
		];
	}
}

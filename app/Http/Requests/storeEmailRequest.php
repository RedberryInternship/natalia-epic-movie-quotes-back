<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeEmailRequest extends FormRequest
{
	public function rules()
	{
		return [
			'email' => 'exists:users,email',
		];
	}
}

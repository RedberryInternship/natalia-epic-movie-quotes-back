<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name'      => 'nullable',
			'password'  => 'nullable',
			'thumbnail' => 'image|nullable',
		];
	}
}

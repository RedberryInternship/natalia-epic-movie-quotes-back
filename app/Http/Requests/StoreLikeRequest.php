<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLikeRequest extends FormRequest
{
	public function rules()
	{
		return [
			'from' => 'required',
			'to'   => 'required',
		];
	}
}

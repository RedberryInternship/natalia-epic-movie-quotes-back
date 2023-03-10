<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
	public function rules()
	{
		return [
			'body' => 'required',
			'from' => 'required',
			'to'   => 'required',
		];
	}
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuoteRequest extends FormRequest
{
	public function rules()
	{
		return [
			'quote_en' => 'required',
			'quote_ge' => 'required',
			'image'    => 'nullable',
		];
	}
}

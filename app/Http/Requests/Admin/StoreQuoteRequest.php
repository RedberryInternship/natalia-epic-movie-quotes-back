<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{
	public function rules()
	{
		return [
			'quote_en' => 'required',
			'quote_ge' => 'required',
			'image'    => 'required',
			'movie_id' => 'required',
		];
	}
}

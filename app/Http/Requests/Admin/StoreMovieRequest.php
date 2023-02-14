<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
	public function rules()
	{
		return [
			'title_en'             => 'required',
			'title_ge'             => 'required',
			'director_en'          => 'required',
			'director_ge'          => 'required',
			'description_en'       => 'required',
			'description_ge'       => 'required',
			'genre'                => 'required',
			'year'                 => 'required',
			'budget'               => 'required',
		];
	}
}

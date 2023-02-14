<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuoteRequest;
use App\Models\Quote;

class QuoteController extends Controller
{
	public function store(StoreQuoteRequest $request)
	{
		$quote = Quote::create([
			'quote'          => json_encode([
				'en' => $request['quote_en'],
				'ge' => $request['quote_ge'],
			]),
			'movie_id'       => $request->movie_id,
			'image'          => request()->file('image')->store('images'),
		]);

		if (!$quote)
		{
			return response()->json('Error has occurred', 422);
		}

		return response()->json('success', 201);
	}
}

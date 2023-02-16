<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Quote;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request, Quote $quote)
	{
		$attributes = $request->validated();
		$attributes['user_id'] = auth()->id();
		$quote->comments()->create($attributes);

		return response()->json('Comment Added Successfully!', 200);
	}
}

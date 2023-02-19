<?php

namespace App\Http\Controllers\Api;

use App\Events\AddComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Quote;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request, Quote $quote)
	{
		$attributes = $request->validated();

		$attributes['user_id'] = auth()->id();
		$attributes['quote_id'] = $quote->id;
		$quote->comments()->create($attributes);
		AddComment::dispatch($attributes);

		return response()->json('Comment Added Successfully!', 200);
	}
}

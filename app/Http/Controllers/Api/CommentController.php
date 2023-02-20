<?php

namespace App\Http\Controllers\Api;

use App\Events\AddComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Notification;
use App\Models\Quote;

class CommentController extends Controller
{
	public function store(StoreCommentRequest $request, Quote $quote)
	{
		event(new AddComment($request->all()));

		$attributes['user_id'] = auth()->id();
		$attributes['quote_id'] = $quote->id;
		$attributes['body'] = $request->body;
		$quote->comments()->create($attributes);

		if ($request->to !== auth()->user()->id)
		{
			$notification = Notification::create([
				'from' => $request->from,
				'to'   => $request->to,
				'type' => 'comment',
				'is_read' => false,
			]);
		}

		return response()->json('Comment Added Successfully!', 200);
	}
}

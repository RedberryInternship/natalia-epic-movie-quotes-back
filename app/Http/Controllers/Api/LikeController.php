<?php

namespace App\Http\Controllers\Api;

use App\Events\AddLikeEvent;
use App\Http\Controllers\Controller;
use App\Models\Like;

class LikeController extends Controller
{
	public function like($id)
	{
		$like = Like::where('quote_id', $id)->where('user_id', auth()->user()->id)->first();

		if (empty($like))
		{
			$like = Like::create([
				'quote_id' => $id,
				'user_id'  => auth()->user()->id,
			]);
			event(new AddLikeEvent($like));

			return response()->json(['message' => 'like'], 200);
		}
		else
		{
			Like::where('user_id', auth()->user()->id)
			->where('quote_id', $id)
			->delete();
			return response()->json(['message' => 'unlike'], 200);
		}
	}
}

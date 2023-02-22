<?php

namespace App\Http\Controllers\Api;

use App\Events\AddLikeEvent;
use App\Events\NotificationsEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLikeRequest;
use App\Models\Like;
use App\Models\Notification;

class LikeController extends Controller
{
	public function like(StoreLikeRequest $request, $id)
	{
		event(new AddLikeEvent($request->all()));
		$like = Like::where('quote_id', $id)->where('user_id', auth()->user()->id)->first();

		if (empty($like))
		{
			$like = Like::create([
				'quote_id' => $id,
				'user_id'  => auth()->user()->id,
			]);

			if ($request->to !== auth()->user()->id)
			{
				$notification = Notification::create([
					'to'          => $request->to,
					'from'        => $request->from,
					'type'        => 'like',
					'is_read'     => false,
				]);

				event(new NotificationsEvent($notification));
			}

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

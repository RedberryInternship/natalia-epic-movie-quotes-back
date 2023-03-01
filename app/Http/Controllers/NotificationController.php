<?php

namespace App\Http\Controllers;

use App\Http\Resources\GetNotificationResource;
use App\Models\Notification;

class NotificationController extends Controller
{
	public function get()
	{
		$notifications = Notification::where('to', auth()->user()->id)
			->with('author', 'quote', 'quote.movie', 'quote.comments', 'quote.likes', 'quote.comments.user')
			->orderBy('created_at', 'desc')
			->get();

		return response()->json(GetNotificationResource::collection($notifications));
	}

	public function markAsRead()
	{
		$notifications = Notification::where('to', auth()->user()->id)->update(['is_read' => true]);
		return response()->json('updated successfully!');
	}
}

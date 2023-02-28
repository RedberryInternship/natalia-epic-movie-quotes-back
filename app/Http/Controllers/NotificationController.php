<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
	public function get()
	{
		$notifications = Notification::where('to', auth()->user()->id)
									->with('from')
									->orderBy('created_at', 'desc')
									->get();
		return response()->json($notifications);
	}

	public function markAsRead()
	{
		$notifications = Notification::where('to', auth()->user()->id)->update(['is_read' => true]);
		return response()->json('updated successfully!');
	}
}

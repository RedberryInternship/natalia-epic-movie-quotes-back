<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationsEvent implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $notification;

	public function __construct(Notification $notification)
	{
		$this->notification = $notification;
	}

	public function broadcastOn()
	{
		return new PrivateChannel('notifications.' . $this->notification->to);
	}
}

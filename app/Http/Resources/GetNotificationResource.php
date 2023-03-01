<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GetNotificationResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'created_at'   => $this->created_at,
			'from'         => $this->author,
			'id'           => $this->id,
			'is_read'      => $this->is_read,
			'quote'        => [
				'comments' => $this->quote->comments->map(function ($comment) {
					return [
						'id'          => $comment->id,
						'body'        => $comment->body,
						'created_at'  => $comment->created_at,
						'user'        => $comment->user,
						'quote_id'    => $comment->quote_id,
					];
				}),
				'likes'    => $this->quote->likes,
				'movie_id' => $this->quote->movie_id,
				'image'    => Storage::url($this->quote->image),
				'quote'    => json_decode($this->quote->quote),
				'user_id'  => $this->quote->user_id,
			],
			'quote_id'     => $this->quote_id,
			'to'           => $this->to,
			'type'         => $this->type,
		];
	}
}

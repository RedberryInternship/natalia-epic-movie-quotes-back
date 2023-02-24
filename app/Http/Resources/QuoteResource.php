<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class QuoteResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id'            => $this->id,
			'image'         => Storage::url($this->image),
			'quote'         => json_decode($this->quote),
			'comments'      => $this->comments,
			'likes'         => $this->likes,
			'movie'         => $this->movie,
			'user'          => $this->user,
		];
	}
}

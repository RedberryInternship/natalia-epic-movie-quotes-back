<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GetAllQuoteResource extends JsonResource
{
	public function toArray($request)
	{
		return 			[
			'id'                              => $this->id,
			'image'                           => Storage::url($this->image),
			'quote'                           => json_decode($this->quote),
			'title'                           => json_decode($this->movie->title),
			'user'                            => $this->user,
			'movie'                           => $this->movie,
			'comments'                        => $this->comments,
			'likes'                           => $this->likes,
		];
	}
}

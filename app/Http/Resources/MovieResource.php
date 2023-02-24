<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MovieResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id'     => $this->id,
			'year'   => $this->year,
			'title'  => json_decode($this->title),
			'image'  => Storage::url($this->image),
			'quotes' => $this->quotes,
		];
	}
}

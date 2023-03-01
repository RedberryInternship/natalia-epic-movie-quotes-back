<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function author()
	{
		return $this->belongsTo(User::class, 'from');
	}

	public function to()
	{
		return $this->belongsTo(User::class, 'to');
	}

	public function quote()
	{
		return $this->belongsTo(Quote::class, 'quote_id');
	}
}

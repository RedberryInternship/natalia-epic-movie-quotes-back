<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	use HasFactory;

	protected $guarded = [];

	public $translatable = ['title', 'director', 'description'];

	public function quote()
	{
		return $this->hasMany(Quote::class, 'movie_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerificationNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasApiTokens;

	use HasFactory;

	use Notifiable;

	protected $guarded = [];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function sendEmailVerificationNotification()
	{
		$this->notify(new VerificationNotification);
	}

	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPasswordNotification($token));
	}

	public function movies()
	{
		return $this->hasMany(Movie::class, 'user_id');
	}

	public function emails()
	{
		return $this->hasMany(Email::class, 'user_id');
	}
}

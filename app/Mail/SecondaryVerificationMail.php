<?php

namespace App\Mail;

use App\Models\Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SecondaryVerificationMail extends Mailable
{
	use Queueable, SerializesModels;

	public $user;

	public $email;

	public $local;

	public function __construct(User $user, Email $email, $local)
	{
		$this->user = $user;
		$this->email = $email;
		$this->local = $local;
	}

	public function build()
	{
		return $this->view('mail.verify-secondary-email');
	}
}

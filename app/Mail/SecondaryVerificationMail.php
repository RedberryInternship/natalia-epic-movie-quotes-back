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

	public function __construct(User $user, Email $email)
	{
		$this->user = $user;
		$this->email = $email;
	}

	public function build()
	{
		return $this->view('mail.verify-secondary-email');
	}
}

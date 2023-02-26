<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
	use Queueable;

	public $token;

	public static $createUrlCallback;

	public static $toMailCallback;

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function via($notifiable)
	{
		return ['mail'];
	}

	public function toMail($notifiable)
	{
		return $this->buildMailMessage($this->resetUrl($notifiable));
	}

	protected function buildMailMessage($url)
	{
		return (new MailMessage)
					->view('mail.reset-password', ['url' => $url]);
	}

	public function resetUrl($notifiable)
	{
		return url(route('password.reset', [
			'token'    => $this->token,
			'email'    => $notifiable->getEmailForPasswordReset(),
			'locale'   => app()->getLocale(),
		], false));
	}

	public static function createUrlUsing($callback)
	{
		static::$createUrlCallback = $callback;
	}

	public static function toMailUsing($callback)
	{
		static::$toMailCallback = $callback;
	}
}

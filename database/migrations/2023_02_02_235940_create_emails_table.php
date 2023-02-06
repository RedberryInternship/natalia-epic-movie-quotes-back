<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('emails', function (Blueprint $table) {
			$table->id();
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
			$table->string('token');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('emails');
	}
};

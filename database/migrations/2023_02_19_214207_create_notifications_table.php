<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('notifications', function (Blueprint $table) {
			$table->id();
			$table->foreignId('from')->constrained()->cascadeOnDelete()->references('id')->on('users');
			$table->foreignId('to')->constrained()->cascadeOnDelete()->references('id')->on('users');
			$table->string('type');
			$table->boolean('is_read')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('notifications');
	}
};

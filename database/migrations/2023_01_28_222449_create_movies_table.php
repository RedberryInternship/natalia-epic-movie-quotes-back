<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('movies', function (Blueprint $table) {
			$table->id();
			$table->json('title');
			$table->json('director');
			$table->json('description');
			$table->bigInteger('budget');
			$table->integer('year');
			$table->string('image')->nullable();
			$table->json('genre');
			$table->foreignId('user_id')->constrained()->cascadeOnDelete();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('movies');
	}
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('quotes', function (Blueprint $table) {
			$table->id();
			$table->json('quote');
			$table->string('image')->nullable();
			$table->foreignId('movie_id')->constrained()->cascadeOnDelete();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('quotes');
	}
};

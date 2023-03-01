<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::table('notifications', function (Blueprint $table) {
			$table->foreignId('quote_id')->constrained()->cascadeOnDelete();
		});
	}

	public function down()
	{
		Schema::dropIfExists('notifications');
	}
};

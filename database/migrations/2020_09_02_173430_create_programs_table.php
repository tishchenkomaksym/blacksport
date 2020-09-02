<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramsTable extends Migration {

	public function up()
	{
		Schema::create('programs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->string('images')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('programs');
	}
}
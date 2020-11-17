<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	public function up()
	{
		Schema::create('news', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->text('description');
			$table->text('images')->nullable();
			$table->timestamps();
			$table->string('published');
		});
	}

	public function down()
	{
		Schema::drop('news');
	}
}
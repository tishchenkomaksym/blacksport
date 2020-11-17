<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAmbassadorsTable extends Migration {

	public function up()
	{
		Schema::create('ambassadors', function(Blueprint $table) {
			$table->increments('id');
			$table->text('description');
			$table->text('image')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ambassadors');
	}
}
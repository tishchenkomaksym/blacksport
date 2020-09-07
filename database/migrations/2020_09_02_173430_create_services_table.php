<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	public function up()
	{
		Schema::create('services', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->text('description');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('services');
	}
}
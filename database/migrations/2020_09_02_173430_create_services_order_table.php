<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesOrderTable extends Migration {

	public function up()
	{
		Schema::create('services_order', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('services_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('services_order');
	}
}
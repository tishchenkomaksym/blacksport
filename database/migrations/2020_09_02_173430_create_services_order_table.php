<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesOrderTable extends Migration {

	public function up()
	{
		Schema::create('services_order', function(Blueprint $table) {
			$table->increments('id');
            $table->text('name');
            $table->string('phone');
            $table->string('email')->nullable();;
			$table->unsignedBigInteger('service_id');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('services_order');
	}
}

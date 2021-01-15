<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesExampleTable extends Migration {

	public function up()
	{
		Schema::create('services_examples', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedBigInteger('service_id');
			$table->string('name');
			$table->text('description');
			$table->timestamps();
			$table->text('media')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('services_examples');
	}
}

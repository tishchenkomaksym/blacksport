<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartnersTable extends Migration {

	public function up()
	{
		Schema::create('partners', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('description');
			$table->text('logo_image')->nullable();
			$table->text('avatar_image')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('partners');
	}
}

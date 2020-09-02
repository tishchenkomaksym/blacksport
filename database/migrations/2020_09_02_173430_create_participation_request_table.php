<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParticipationRequestTable extends Migration {

	public function up()
	{
		Schema::create('participation_request', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('program_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('participation_request');
	}
}
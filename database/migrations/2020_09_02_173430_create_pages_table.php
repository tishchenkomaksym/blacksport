<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('page_key');
			$table->text('meta_description');
			$table->tinyInteger('noindex');
			$table->tinyInteger('nofollow');
			$table->string('image1', 255)->nullable();
			$table->string('image2', 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pages');
	}
}
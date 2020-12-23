<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateViewTextsImagesTable extends Migration {

	public function up()
	{
		Schema::create('view_texts_images', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('view_texts_id')->unsigned();
			$table->text('image');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('view_texts_images');
	}
}

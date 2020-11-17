<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateViewTextsImagesTable extends Migration {

	public function up()
	{
		Schema::create('view-texts-images', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('view-texts_id')->unsigned();
			$table->text('image');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('view-texts-images');
	}
}
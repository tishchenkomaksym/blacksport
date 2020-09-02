<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->text('description');
			$table->text('specifications');
			$table->text('image');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->text('title');
			$table->text('description');
			$table->text('specifications');
			$table->integer('price');
			$table->text('image');
			$table->integer('category_id');
			$table->integer('order_count');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}

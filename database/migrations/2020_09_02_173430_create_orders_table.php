<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->text('products');
//			$table->bigInteger('user_id')->unsigned();
//			$table->integer('product_id')->unsigned();
			$table->string('delivery');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}

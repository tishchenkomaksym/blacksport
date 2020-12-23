<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->text('products')->default(null);
			$table->boolean('is_paid')->default(false);
			$table->string('delivery');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}

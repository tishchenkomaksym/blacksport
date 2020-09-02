<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('services', function(Blueprint $table) {
			$table->foreign('services_example_id')->references('id')->on('services_example')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('participation_request', function(Blueprint $table) {
			$table->foreign('program_id')->references('id')->on('programs')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('participation_request', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('services_order', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('services_order', function(Blueprint $table) {
			$table->foreign('services_id')->references('id')->on('services')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('services', function(Blueprint $table) {
			$table->dropForeign('services_services_example_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_user_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_product_id_foreign');
		});
		Schema::table('participation_request', function(Blueprint $table) {
			$table->dropForeign('participation_request_program_id_foreign');
		});
		Schema::table('participation_request', function(Blueprint $table) {
			$table->dropForeign('participation_request_user_id_foreign');
		});
		Schema::table('services_order', function(Blueprint $table) {
			$table->dropForeign('services_order_user_id_foreign');
		});
		Schema::table('services_order', function(Blueprint $table) {
			$table->dropForeign('services_order_services_id_foreign');
		});
	}
}
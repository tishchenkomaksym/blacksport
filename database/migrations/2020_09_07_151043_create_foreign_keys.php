<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('services_examples', function(Blueprint $table) {
			$table->foreign('service_id')->references('id')->on('services')
                                           ->onDelete('restrict')
                                           ->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('participation_request', function(Blueprint $table) {
			$table->foreign('program_id')->references('id')->on('programs')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('participation_request', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('services_order', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
		});
		Schema::table('services_order', function(Blueprint $table) {
			$table->foreign('service_id')->references('id')->on('services');
		});
		Schema::table('view-texts', function(Blueprint $table) {
			$table->foreign('page_id')->references('id')->on('pages')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('view-texts-images', function(Blueprint $table) {
			$table->foreign('view-texts_id')->references('id')->on('view-texts')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
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
			$table->dropForeign('services_order_service_id_foreign');
		});
		Schema::table('view-texts', function(Blueprint $table) {
			$table->dropForeign('view-texts_page_id_foreign');
		});
		Schema::table('view-texts-images', function(Blueprint $table) {
			$table->dropForeign('view-texts-images_view-texts_id_foreign');
		});
	}
}
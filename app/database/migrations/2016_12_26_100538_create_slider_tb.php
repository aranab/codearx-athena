<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Creates core_sliders table
        Schema::create('core_sliders', function($table) {
            $table->increments('id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('core_pages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('title', 50)->nullable();
            $table->string('description')->nullable();
            $table->string('content')->default('');
            $table->string('pic_name', 20);
            $table->string('ext', 10);
            $table->string('path', 20);
            $table->smallInteger('order_no')->unsigned();
            $table->boolean('status')->defult(true);
            $table->string('uploaded_by', 50)->nullable();
            $table->timestamp('uploaded_date')->nullable();
            $table->string('modified_by', 50)->nullable();
            $table->timestamp('modified_date')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // drop core_sliders table
        Schema::drop('core_sliders');
	}

}

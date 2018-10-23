<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreQuestionsTb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Creates core_questions table
        Schema::create('core_questions', function($table) {
            $table->increments('id')->unsigned();
            $table->text('question');
            $table->string('format', 5)->default('txt');
            $table->boolean('status')->defult(true);
            $table->smallInteger('order_no')->unsigned();
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
        // drop core_questions table
        Schema::drop('core_questions');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeaUsersTb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Creates the idea_users (ONE-to-ONE relation) table
        Schema::create('idea_users', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('core_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->defult(true);
            $table->text('remarks')->nullable();
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
        // drop idea_users table
        Schema::drop('idea_users');
	}

}

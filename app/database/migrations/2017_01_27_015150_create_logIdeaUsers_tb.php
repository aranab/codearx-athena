<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogIdeaUsersTb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Creates the log_idea_users table
        Schema::create('log_idea_users', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('idea_user_id')->unsigned();
            $table->foreign('idea_user_id')->references('id')->on('idea_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->defult(true);
            $table->string('uploaded_by', 50)->nullable();
            $table->timestamp('uploaded_date')->nullable();
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
        Schema::drop('log_idea_users');
	}

}

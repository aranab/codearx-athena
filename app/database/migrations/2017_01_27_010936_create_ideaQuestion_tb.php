<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeaQuestionTb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Creates the idea_users_answers (MANY-to-MANY relation) table
        Schema::create('idea_users_answers', function ($table) {
            $table->increments('id')->unsigned();
            $table->integer('idea_user_id')->unsigned();
            $table->foreign('idea_user_id')->references('id')->on('idea_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('core_questions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->text('content')->nullable();
            $table->string('mime_type', 100)->default('');
            $table->string('guid')->nullable();
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
        // drop idea_users_answers table
        Schema::drop('idea_users_answers');
	}

}

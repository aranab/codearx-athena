<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoreUserTb extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates core_users table
        Schema::create('core_users', function($table) {
            $table->increments('id')->unsigned();
            $table->string('fname', 50)->nullable();
            $table->string('lname', 20)->nullable();
            $table->string('username', 50)->unique();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('mobile', 20);
            $table->string('gender', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('company', 100)->nullable();
            $table->string('designation', 50)->nullable();
            $table->string('pic_name', 20)->nullable();
            $table->string('ext', 10)->nullable();
            $table->string('path', 70);
            $table->string('user_type', 10);
            $table->boolean('confirmed')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->string('last_visit_ip', 50)->nullable();
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
        // drop core_users table
        Schema::drop('core_users');
	}

}

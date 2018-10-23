<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorePagesTb extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates core_pages table
        Schema::create('core_pages', function($table) {
            $table->increments('id')->unsigned();
            $table->text('title');
            $table->integer('parent_id')->unsigned()->default(0)->index('parent_id');
            $table->string('name', 200)->index('name', 191);
            $table->longText('content')->nullable();
            $table->string('type', 10)->default('page');
            $table->string('content_type', 20)->default('');
            $table->boolean('status')->defult(true);
            $table->smallInteger('section_order')->unsigned()->default(0);
            $table->smallInteger('menu_order')->unsigned()->default(0);
            $table->string('mime_type', 100)->default('');
            $table->string('guid')->nullable();
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
        // drop core_pages table
        Schema::drop('core_pages');
    }

}
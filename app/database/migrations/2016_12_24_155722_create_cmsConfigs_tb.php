<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsConfigsTb extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates cms_configs table
        Schema::create('cms_configs', function($table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 191)->unique();
            $table->longText('value');
            $table->string('autoload', 20)->default('yes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop cms_configs table
        Schema::drop('cms_configs');
    }

}

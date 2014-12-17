<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('settings', function(Blueprint $table) {
            $table->string('key');
            $table->text('value');

			$table->index('key');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('settings', function(Blueprint $table) {
            $table->drop();
        });
	}

}

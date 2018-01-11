<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaestriaUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maestria_users', function(Blueprint $table)
		{
			$table->char('users_id', 32)->index('fk_users_has_maestrias_users_idx');
			$table->integer('maestrias_id')->index('fk_users_has_maestrias_maestrias1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maestria_users');
	}

}

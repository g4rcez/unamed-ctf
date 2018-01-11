<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMaestriaUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('maestria_users', function(Blueprint $table)
		{
			$table->foreign('maestrias_id', 'fk_users_has_maestrias_maestrias1')->references('id')->on('maestrias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('users_id', 'fk_users_has_maestrias_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('maestria_users', function(Blueprint $table)
		{
			$table->dropForeign('fk_users_has_maestrias_maestrias1');
			$table->dropForeign('fk_users_has_maestrias_users');
		});
	}

}

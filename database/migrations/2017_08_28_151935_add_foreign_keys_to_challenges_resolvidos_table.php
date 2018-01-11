<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChallengesResolvidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('challenges_resolvidos', function(Blueprint $table)
		{
			$table->foreign('challenges_id', 'fk_users_has_challenges_challenges1')->references('id')->on('challenges')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('users_id', 'fk_users_has_challenges_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('challenges_resolvidos', function(Blueprint $table)
		{
			$table->dropForeign('fk_users_has_challenges_challenges1');
			$table->dropForeign('fk_users_has_challenges_users1');
		});
	}

}

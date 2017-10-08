<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChallengesResolvidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('challenges_resolvidos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('users_id', 32)->index('fk_users_has_challenges_users1_idx');
			$table->integer('challenges_id')->index('fk_users_has_challenges_challenges1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('challenges_resolvidos');
	}

}

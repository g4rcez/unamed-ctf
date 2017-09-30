<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('challenges', function(Blueprint $table)
		{
			$table->foreign('categories_id', 'fk_challenges_categories1')->references('id')->on('categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('challenges', function(Blueprint $table)
		{
			$table->dropForeign('fk_challenges_categories1');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hints', function(Blueprint $table)
		{
			$table->foreign('challenges_id', 'fk_hints_challenges1')->references('id')->on('challenges')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hints', function(Blueprint $table)
		{
			$table->dropForeign('fk_hints_challenges1');
		});
	}

}

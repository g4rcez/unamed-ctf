<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('challenges', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 64);
			$table->integer('pontos');
			$table->string('enunciado', 2048);
			$table->string('autor', 64)->nullable();
			$table->string('flag', 128);
			$table->timestamps();
			$table->softDeletes();
			$table->integer('categories_id')->index('fk_challenges_categories1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('challenges');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hints', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('autor', 64)->nullable();
			$table->string('nome', 128);
			$table->string('descricao', 2048);
			$table->timestamps();
			$table->softDeletes();
			$table->integer('challenges_id')->index('fk_hints_challenges1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hints');
	}

}

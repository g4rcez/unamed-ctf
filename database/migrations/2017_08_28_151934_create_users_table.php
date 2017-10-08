<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->char('id', 32)->primary();
			$table->string('nickname', 64);
			$table->string('email', 128);
			$table->string('password', 256);
			$table->string('remember_token', 100)->nullable();
			$table->string('nacionalidade', 45)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('avatar', 128)->nullable();
			$table->string('categoria_favorita', 64)->nullable();
			$table->boolean('capitao')->nullable();
			$table->char('team_id', 32)->index('fk_users_team1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('card_no', 128);
			$table->string('title', 128);
			$table->string('first_name', 128);
			$table->string('last_name', 128);
			$table->string('email')->unique();
			$table->string('company_name', 128);
			$table->string('visitor_type', 128);
			$table->string('host_name', 128);
			$table->string('location', 128);
			$table->date('arival_date', 128);
			$table->time('arival_time', 128);
			$table->string('picture', 128);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visitors');
	}

}

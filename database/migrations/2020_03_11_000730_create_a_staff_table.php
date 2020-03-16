<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAStaffTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('a_staff', function (Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->unsigned()->default(1);
			$table->tinyInteger('role')->unsigned()->default(1);
			$table->string('name','100');
			$table->string('email')->unique();
            $table->string('password','300');
			$table->integer('created')->default(1);
			$table->integer('updated')->default(1);
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
		Schema::dropIfExists('a_staff');
	}
}

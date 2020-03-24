<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_product', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->string('title', '100');
            $table->text('text');
            $table->integer('price')->default(0)->comment('価格');
            $table->integer('num')->default(0)->comment('個数');
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
        Schema::dropIfExists('m_product');
    }
}

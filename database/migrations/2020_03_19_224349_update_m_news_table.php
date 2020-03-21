<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_news', function (Blueprint $table) {
            //
            $table->integer('price')->default(0)->after('category')->comment('価格');
            $table->integer('num')->default(0)->after('price')->comment('個数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_news', function (Blueprint $table) {
            //
        });
    }
}

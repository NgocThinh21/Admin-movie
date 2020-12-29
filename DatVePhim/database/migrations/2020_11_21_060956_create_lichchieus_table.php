<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichchieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichchieus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phim')->unsigned();
            $table->integer('thoigian')->unsigned();
            $table->integer('rap')->unsigned();
            $table->date('ngay');
            $table->timestamps();

            $table->foreign('phim')->references('id')->on('phims');
            $table->foreign('thoigian')->references('id')->on('khungtgchieus');
            $table->foreign('rap')->references('id')->on('raps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lichchieus');
    }
}

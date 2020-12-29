<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loaighe')->unsigned();
            $table->integer('loaiphim')->unsigned();
            $table->float('gia');
            $table->timestamps();

            $table->foreign('loaighe')->references('id')->on('loaighes');
           $table->foreign('loaiphim')->references('id')->on('dinhdangphims');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gias');
    }
}

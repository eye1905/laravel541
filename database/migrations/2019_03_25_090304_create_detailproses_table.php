<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailprosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailproses', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('id_proses')->unsigned();
            $table->foreign('id_proses')->references('id')->on('proses');
            $table->integer('id_barang')->unsigned();
            $table->foreign('id_barang')->references('id')->on('barangs');
            $table->integer('jumlahBarang');
            $table->integer('status');
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
        Schema::dropIfExists('detailproses');
    }
}

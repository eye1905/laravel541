<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tglProses');
            $table->integer('id_jenisProses')->unsigned();
            $table->foreign('id_jenisProses')->references('id')->on('jenis_proses');
            $table->integer('id_karyawan')->unsigned();
            $table->foreign('id_karyawan')->references('id')->on('karyawans');
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
        Schema::dropIfExists('proses');
    }
}

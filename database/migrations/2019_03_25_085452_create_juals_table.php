<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noNotaJual');
            $table->date('tglKirim');
            $table->string('noResi', 100);
            $table->date('tglPesan');
            $table->date('tglTerima');
            $table->string('total');
            $table->integer('statusBayar');
            $table->integer('id_konsumen')->unsigned();
            $table->foreign('id_konsumen')->references('id')->on('konsumens');
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
        Schema::dropIfExists('juals');
    }
}

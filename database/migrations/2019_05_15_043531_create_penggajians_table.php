<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if (Schema::hasTable('penggajians')) {
            Schema::create('penggajians', function (Blueprint $table) {
                $table->increments('id');
                $table->string('bulan', 50);
                $table->integer('tahun');
                $table->integer('gajiPokok');
                $table->integer('gajiTambahan');
                $table->integer('id_karyawan')->unsigned();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggajians');
    }
}

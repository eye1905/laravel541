<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailbelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailbelis', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('id_barang')->unsigned();
            $table->foreign('id_barang')->references('id')->on('barangs');
            $table->integer('id_beli')->unsigned();
            $table->foreign('id_beli')->references('id')->on('belis');
            $table->string('berat', 100);
            $table->integer('harga');
            $table->integer('subTotal');
            $table->integer('total');
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
        Schema::dropIfExists('detailbelis');
    }
}

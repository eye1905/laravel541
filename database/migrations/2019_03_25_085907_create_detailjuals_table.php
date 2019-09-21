<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailjualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailjuals', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('id_barang')->unsigned();
            $table->foreign('id_barang')->references('id')->on('barangs');
            $table->integer('id_jual')->unsigned();
            $table->foreign('id_jual')->references('id')->on('juals');
            $table->integer('beratJual');
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
        Schema::dropIfExists('detailjuals');
    }
}

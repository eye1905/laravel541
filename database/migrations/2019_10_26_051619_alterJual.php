<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterJual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('juals')) {
            Schema::table('juals', function (Blueprint $table) {
                $table->integer('noNotaJual')->nullable()->change();
                $table->date('tglKirim')->nullable()->change();
                $table->string('noResi', 100)->nullable()->change();
                $table->date('tglPesan');
                $table->date('tglTerima')->nullable()->change();
                $table->string('total')->nullable()->change();
                $table->integer('statusBayar');
                $table->integer('id_konsumen')->unsigned();
                $table->foreign('id_konsumen')->references('id')->on('konsumens');
                $table->integer('id_karyawan')->unsigned();
                $table->foreign('id_karyawan')->references('id')->on('karyawans');
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
        //
    }
}

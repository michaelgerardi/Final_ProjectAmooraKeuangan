<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_pemasukan')->nullable();
            $table->string('id_pengeluaran')->nullable();
            $table->date('tgl');
            $table->string('ket');
            $table->string('ref')->nullable();
            $table->integer('debit');
            $table->integer('kredit');
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
        Schema::dropIfExists('jurnal');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewer', function (Blueprint $table) {
            $table->increments('id_sewer');
            $table->string('id_admin')->nullable();
            $table->string('nip');
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('jenis_kelamin');
            $table->string('posisi');
            $table->string('image');
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
        Schema::dropIfExists('sewer');
    }
}

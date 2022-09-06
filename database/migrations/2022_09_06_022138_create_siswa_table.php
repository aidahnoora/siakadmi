<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama_siswa');
            $table->string('jenis_kelamin');
            $table->string('no_telp');
            $table->string('tmpt_lahir');
            $table->string('tgl_lahir');
            $table->string('foto');
            $table->string('nama_ortu');
            $table->string('pekerjaan');
            $table->string('tahun_masuk');
            $table->string('agama');
            $table->text('alamat');
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
        Schema::dropIfExists('siswa');
    }
}

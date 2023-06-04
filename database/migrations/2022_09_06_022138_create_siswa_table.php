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
            $table->bigInteger('nis')->primary();
            $table->string('nomor_induk')->unique();
            $table->string('nama_siswa');
            $table->foreignId('kelas_id');
            $table->string('jns_kelamin');
            $table->string('tmpt_lahir');
            $table->string('tgl_lahir');
            $table->string('foto');
            $table->string('nama_ortu');
            $table->string('no_telp');
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

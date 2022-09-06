<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitasSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('npsn');
            $table->string('nama_sekolah');
            $table->text('alamat');
            $table->string('kabupaten');
            $table->string('kode_pos');
            $table->string('logo');
            $table->string('nama_kepsek');
            $table->string('no_telp');
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
        Schema::dropIfExists('identitas_sekolah');
    }
}

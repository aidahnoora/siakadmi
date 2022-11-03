<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id');
            $table->bigInteger('siswa_nis');
            $table->string('tanggal');
            $table->enum('keterangan', ['hadir', 'sakit', 'izin', 'alfa'])->default('hadir');
            $table->timestamps();

            $table->foreign('siswa_nis')->references('nis')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}

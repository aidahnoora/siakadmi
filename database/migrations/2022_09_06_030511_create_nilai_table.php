<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id');
            $table->bigInteger('siswa_nis');
            $table->foreignId('mapel_id');
            $table->integer('tugas');
            $table->integer('rata_uh');
            $table->integer('uts');
            $table->integer('uas');
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
        Schema::dropIfExists('nilai');
    }
}

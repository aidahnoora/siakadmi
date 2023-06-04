<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->bigInteger('nip')->primary();
            $table->string('nama_guru');
            $table->string('pangkat_golongan')->nullable();
            $table->foreignId('mapel_id')->nullable();
            $table->string('tmpt_lahir');
            $table->date('tgl_lahir');
            $table->string('jns_kelamin');
            $table->string('no_telp');
            $table->string('foto');
            $table->string('email');
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
        Schema::dropIfExists('guru');
    }
}

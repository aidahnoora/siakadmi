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
            $table->id();
            $table->string('nip')->unique()->nullable();
            $table->string('nama_guru');
            $table->string('pangkat_golongan')->nullable();
            $table->string('tmpt_lahir');
            $table->string('tgl_lahir');
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

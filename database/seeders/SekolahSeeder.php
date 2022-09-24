<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identitas_sekolah')->insert([
            'id' => 6,
            'npsn' => 1212,
            'nama_sekolah' => 'MI Muhammadiyah Nglaran 1',
            'alamat' => 'Tulakan',
            'kabupaten' => 'Pacitan',
            'kode_pos' => '1212',
            'logo' => 'Ayq95kSAO8RGLCHP9RExENi8DLPF6ogXPfVA5b2V.png',
            'nama_kepsek' => 'Lesta',
            'no_telp' => '03584-121-345',
        ]);
    }
}

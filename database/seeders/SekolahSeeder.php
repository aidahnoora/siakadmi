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
            'npsn' => 111235010091,
            'nama_sekolah' => 'MI Muhammadiyah Nglaran 1',
            'alamat' => 'Sukorejo, Nglaran, Tulakan',
            'kabupaten' => 'Pacitan',
            'kode_pos' => '63571',
            'logo' => 'Ayq95kSAO8RGLCHP9RExENi8DLPF6ogXPfVA5b2V.png',
            'nama_kepsek' => 'Bambang Sutoyo, S.Pd.I',
            'no_telp' => '087759630188',
        ]);
    }
}

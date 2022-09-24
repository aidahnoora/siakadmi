<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mapel')->insert([
            'id' => 1,
            'nama_mapel' => 'Matematika',
            'tahun_mapel' => '2022',
            'semester' => '2'
        ]);
    }
}

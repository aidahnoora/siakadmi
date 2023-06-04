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
            [
                'nama_mapel' => 'Matematika',
                'semester' => '1',
            ],
            [
                'nama_mapel' => 'Olahraga',
                'semester' => '1'
            ],
            [
                'nama_mapel' => 'Bahasa Jawa',
                'semester' => '1'
            ],
            [
                'nama_mapel' => 'Matematika',
                'semester' => '2',
            ],
            [
                'nama_mapel' => 'Olahraga',
                'semester' => '2'
            ],
            [
                'nama_mapel' => 'Bahasa Jawa',
                'semester' => '2'
            ],
        ]);
    }
}

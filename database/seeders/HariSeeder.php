<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hari')->insert([
            'id' => 1,
            'nama_hari' => 'Senin',
        ]);

        DB::table('hari')->insert([
            'id' => 2,
            'nama_hari' => 'Selasa',
        ]);

        DB::table('hari')->insert([
            'id' => 3,
            'nama_hari' => 'Rabu',
        ]);

        DB::table('hari')->insert([
            'id' => 4,
            'nama_hari' => 'Kamis',
        ]);

        DB::table('hari')->insert([
            'id' => 5,
            'nama_hari' => 'Jumat',
        ]);

        DB::table('hari')->insert([
            'id' => 6,
            'nama_hari' => 'Sabtu',
        ]);
    }
}

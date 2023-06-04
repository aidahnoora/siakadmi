<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nilai')->insert([
            [
                'kelas_id' => 4,
                'siswa_nis' => 1200,
                'mapel_id' => 1,
                'tugas' => 90,
                'rata_uh' => 89,
                'uts' => 88,
                'uas' => 91,
            ],
            [
                'kelas_id' => 4,
                'siswa_nis' => 1200,
                'mapel_id' => 2,
                'tugas' => 80,
                'rata_uh' => 89,
                'uts' => 85,
                'uas' => 81,
            ]
        ]);
    }
}

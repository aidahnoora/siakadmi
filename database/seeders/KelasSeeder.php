<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            [
                'nama_kelas' => '1 (Satu)',
                'guru_nip' => 7460764666210093
            ],
            [
                'nama_kelas' => '2 (Dua)',
                'guru_nip' => 4945768669210022
            ],
            [
                'nama_kelas' => '3 (Tiga)',
                'guru_nip' => 1242768669110013
            ],
            [
                'nama_kelas' => '4 (Empat)',
                'guru_nip' => 1242768669110013
            ],
            [
                'nama_kelas' => '5 (Lima)',
                'guru_nip' => 1242768669110013
            ],
            [
                'nama_kelas' => '6 (Enam)',
                'guru_nip' => 1242768669110013
            ],
        ]);
    }
}

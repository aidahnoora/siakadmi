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
            'id' => 1,
            'nama_kelas' => '1 (Satu)',
            'guru_id' => 1
        ]);
    }
}

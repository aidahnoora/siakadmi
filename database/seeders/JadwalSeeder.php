<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwal')->insert([
            [
                'hari_id' => 1,
                'kelas_id' => 4,
                'mapel_id' => 1,
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '08:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'hari_id' => 1,
                'kelas_id' => 4,
                'mapel_id' => 2,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'hari_id' => 2,
                'kelas_id' => 4,
                'mapel_id' => 3,
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

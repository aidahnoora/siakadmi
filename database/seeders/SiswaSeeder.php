<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            'id' => 1,
            'nomor_induk' => '001',
            'nis' => '19930289123',
            'nama_siswa' => 'Aina',
            'kelas_id' => 1,
            'jns_kelamin' => 'Perempuan',
            'tmpt_lahir' => 'Surabaya',
            'tgl_lahir' => '12-12-2015',
            'foto' => 'https://source.unsplash.com/random',
            'nama_ortu' => 'Ilham',
            'no_telp' => '081231456781',
            'pekerjaan' => 'PNS',
            'tahun_masuk' => '2021',
            'agama' => 'Islam',
            'alamat' => 'Tulakan',
        ]);
    }
}

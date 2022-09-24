<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru')->insert([
            'id' => 1,
            'nip' => '1992030412340112',
            'nama_guru' => 'Azzah',
            'pangkat_golongan' => 'II/a',
            'mapel_id' => 1,
            'tmpt_lahir' => 'Pacitan',
            'tgl_lahir' => '04-03-1992',
            'jns_kelamin' => 'Perempuan',
            'no_telp' => '087751234567',
            'foto' => 'https://source.unsplash.com/random',
            'email' => 'azzah@gmail.com',
            'agama' => 'Islam',
            'alamat' => 'Nawangan, Pacitan',
        ]);
    }
}

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
            [
                'nip' => 7460764666210093,
                'nama_guru' => 'Farida Novianti, S.Pd.I',
                'pangkat_golongan' => '-',
                'mapel_id' => 1,
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '1986-11-28',
                'jns_kelamin' => 'Perempuan',
                'no_telp' => '-',
                'foto' => 'https://source.unsplash.com/random',
                'email' => 'farida@gmail.com',
                'agama' => 'Islam',
                'alamat' => 'Pacitan',
            ],
            [
                'nip' => 4945768669210022,
                'nama_guru' => 'Endang Wahyuni, S.Pd.I',
                'pangkat_golongan' => '-',
                'mapel_id' => 2,
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '1990-06-13',
                'jns_kelamin' => 'Perempuan',
                'no_telp' => '-',
                'foto' => 'https://source.unsplash.com/random',
                'email' => 'endang@gmail.com',
                'agama' => 'Islam',
                'alamat' => 'Pacitan',
            ],
            [
                'nip' => 1242768669110013,
                'nama_guru' => 'Sapto Hertomo, S.Pd',
                'pangkat_golongan' => '-',
                'mapel_id' => 3,
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '1990-09-10',
                'jns_kelamin' => 'Laki-laki',
                'no_telp' => '-',
                'foto' => 'https://source.unsplash.com/random',
                'email' => 'sapto@gmail.com',
                'agama' => 'Islam',
                'alamat' => 'Pacitan',
            ],
        ]);
    }
}

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
            [
                'nis' => '1200',
                'nomor_induk' => '001',
                'nama_siswa' => 'Arraya Alif Genie Amal',
                'kelas_id' => 4,
                'jns_kelamin' => 'Laki-laki',
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '2011-07-30',
                'foto' => 'https://source.unsplash.com/random',
                'nama_ortu' => 'Puput',
                'no_telp' => '-',
                'pekerjaan' => 'PNS',
                'tahun_masuk' => '2017',
                'agama' => 'Islam',
                'alamat' => 'Tulakan',
            ],
            [
                'nis' => '1201',
                'nomor_induk' => '002',
                'nama_siswa' => 'Intan Novitasari',
                'kelas_id' => 4,
                'jns_kelamin' => 'Perempuan',
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '2012-04-26',
                'foto' => 'https://source.unsplash.com/random',
                'nama_ortu' => 'Kariyati',
                'no_telp' => '-',
                'pekerjaan' => 'Wiraswasta',
                'tahun_masuk' => '2019',
                'agama' => 'Islam',
                'alamat' => 'Tulakan',
            ],
            [
                'nis' => '1202',
                'nomor_induk' => '003',
                'nama_siswa' => 'Intan Nanda Kusuma',
                'kelas_id' => 4,
                'jns_kelamin' => 'Perempuan',
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '2012-09-21',
                'foto' => 'https://source.unsplash.com/random',
                'nama_ortu' => 'Sujiati',
                'no_telp' => '-',
                'pekerjaan' => 'Wiraswasta',
                'tahun_masuk' => '2019',
                'agama' => 'Islam',
                'alamat' => 'Tulakan',
            ],
            [
                'nis' => '1203',
                'nomor_induk' => '004',
                'nama_siswa' => 'Adhi Akbar Maulana',
                'kelas_id' => 5,
                'jns_kelamin' => 'Laki-laki',
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '2010-05-01',
                'foto' => 'https://source.unsplash.com/random',
                'nama_ortu' => 'Sulastri',
                'no_telp' => '-',
                'pekerjaan' => 'PNS',
                'tahun_masuk' => '2018',
                'agama' => 'Islam',
                'alamat' => 'Tulakan',
            ],
            [
                'nis' => '1204',
                'nomor_induk' => '005',
                'nama_siswa' => 'Fajar Ardya Risna Flamboyan',
                'kelas_id' => 5,
                'jns_kelamin' => 'Laki-laki',
                'tmpt_lahir' => 'Pacitan',
                'tgl_lahir' => '2009-06-16',
                'foto' => 'https://source.unsplash.com/random',
                'nama_ortu' => 'Sunarti',
                'no_telp' => '-',
                'pekerjaan' => 'Wiraswasta',
                'tahun_masuk' => '2018',
                'agama' => 'Islam',
                'alamat' => 'Tulakan',
            ],
        ]);
    }
}

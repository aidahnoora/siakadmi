<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        $guru = User::create([
            'name' => 'Guru',
            'email' => 'guru@gmail.com',
            'password' => bcrypt('guru'),
            'role' => 'guru',
        ]);

        $siswa = User::create([
            'name' => 'Siswa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('siswa'),
            'role' => 'siswa',
        ]);

        $kepsek = User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@gmail.com',
            'password' => bcrypt('kepsek'),
            'role' => 'kepsek',
        ]);
    }
}

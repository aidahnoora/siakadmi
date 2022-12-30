<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([SiswaSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([GuruSeeder::class]);
        $this->call([MapelSeeder::class]);
        $this->call([KelasSeeder::class]);
        $this->call([HariSeeder::class]);
        $this->call([SekolahSeeder::class]);
    }
}

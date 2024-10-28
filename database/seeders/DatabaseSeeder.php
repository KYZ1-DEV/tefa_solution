<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Sekolah::factory(10)->create();
        // \App\Models\Industri::factory(10)->create();
        // \App\Models\Mitra::factory(10)->create();
        // \App\Models\Bantuan::factory(5)->create();
        // \App\Models\Laporan::factory(10)->create();
        \App\Models\User::factory()->create(
            [
                'name' => 'admin',
                'email'=> 'admin@gmail.com',
                'password'=> bcrypt('admin123'),
                'email_verified_at' => now(),
                'role' => 'admin'
            ]
        );
        \App\Models\User::factory()->create(
            [
                'name' => 'industri',
                'email'=> 'industri@gmail.com',
                'password'=> bcrypt('industri123'),
                'email_verified_at' => now(),
                'role' => 'industri'
            ]
        );
        \App\Models\User::factory()->create(
            [
                'name' => 'sekolah',
                'email'=> 'sekolah@gmail.com',
                'password'=> bcrypt('sekolah123'),
                'email_verified_at' => now(),
                'role' => 'sekolah'
            ]
        );



    }
}

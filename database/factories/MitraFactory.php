<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mitra>
 */
class MitraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_mitra' => $this->faker->company(),
            'tanggal_bermitra' => $this->faker->date(),
            'progres_bermitra' => $this->faker->randomElement(['0%','50%','100%']),
            'status_mitra' => $this->faker->randomElement(['proses','dibatalkan','selesai']),
            'id_sekolah' => \App\Models\Sekolah::factory(), // Hubungkan dengan sekolah
            'id_industri' => \App\Models\Industri::factory(), // Hubungkan dengan industri
            'id_bantuan' => null, // Atau isi dengan id dari bantuan jika ada
        ];
    }
}

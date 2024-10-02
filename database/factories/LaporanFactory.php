<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_laporan' => $this->faker->sentence(3),
            'progres_laporan' => $this->faker->randomElement(['0%', '50%', '100%']),
            'bukti_laporan' => $this->faker->imageUrl(640, 480, 'business', true, 'report'),
            'tanggal_laporan' => $this->faker->date(),
            'deskripsi_laporan' => $this->faker->paragraph(),
            'id_sekolah' => \App\Models\Sekolah::factory(), // Hubungkan dengan sekolah
        ];
    }
}

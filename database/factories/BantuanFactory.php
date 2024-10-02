<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bantuan>
 */
class BantuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis_bantuan' => $this->faker->randomElement(['Bantuan A', 'Bantuan B', 'Bantuan C']),
            'deskripsi_bantuan' => $this->faker->paragraph(),
            'id_industri' => \App\Models\Industri::factory()
        ];
    }
}

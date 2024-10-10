<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Industri>
 */
class IndustriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_industri' => $this->faker->company(),
            'npwp' => $this->faker->unique()->numerify('################'),
            'skdp' => $this->faker->unique()->text(10),
            'email' => $this->faker->unique()->safeEmail(),
            'alamat' => $this->faker->address(),
            'bidang_industri' => $this->faker->randomElement([
                'Teknologi Informasi',
                'Manufaktur',
                'Kesehatan',
                'Pendidikan',
                'Keuangan',
                'Pertanian',
                'Energi',
                'Transportasi',
                'Retail',
                'Pariwisata'
            ]),
            'no_tlpn_industri' => $this->faker->phoneNumber(),
            'id_user' => \App\Models\User::factory(), // Hubungkan dengan user
        ];
    }
}

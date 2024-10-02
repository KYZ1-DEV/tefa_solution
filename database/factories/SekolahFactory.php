<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sekolah>
 */
class SekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'npsn' => $this->faker->numerify('##########'),
            'nama_sekolah' => $this->faker->company(),
            'status' => $this->faker->randomElement(['negeri', 'swasta']),
            'jenjang' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'kepsek' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'no_tlpn_sekolah' => $this->faker->phoneNumber(),
            'id_user' => \App\Models\User::factory(), // Hubungkan dengan user
        ];
    }
}

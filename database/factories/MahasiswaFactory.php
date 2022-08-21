<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_mahasiswa' => $this->faker->randomNumber(8, true),
            'nama_mahasiswa' => $this->faker->name(),
            'no_hp_mahasiswa' => '08' . $this->faker->numerify('##########')
        ];
    }
}

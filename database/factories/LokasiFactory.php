<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lokasi>
 */
class LokasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lab' => $this->faker->words(5, true),
            'almari' => $this->faker->words(1, true),
            'kode_lokasi' => $this->faker->bothify('?#?')
        ];
    }
}

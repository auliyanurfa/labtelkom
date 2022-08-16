<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_material' => $this-> faker->words(3, true),
            'barcode' => $this->faker->ean8(),
            'unit_id' => mt_rand(1,2),
            'spesifikasi' => $this -> faker -> text(mt_rand(5,7)),
            'type' => $this -> faker -> word(),
            'stok' => $this->faker->randomNumber(2, true),
            'satuan' => 'pcs',
            'location' => $this -> faker -> buildingNumber(),
        ];
    }
}

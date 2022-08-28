<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peralatan>
 */
class PeralatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-2 years', 'now');
        return [
            'barcode' => $this->faker->bothify('????????########'),
            'nama_alat' => $this->faker->words(3, true) . ' ' . $this->faker->lexify('??????'),
            'jenis_id' => 1,
            'merk' => $this->faker->words(3, true)  . ' ' . $this->faker->lexify('????'),
            'tipe' => $this->faker->words(2, true)  . ' ' . $this->faker->lexify('????'),
            'spesifikasi' => $this->faker->paragraph(1, false),
            'tahun_masuk' => $date->format('Y'),
            'jumlah_alat' => 1,
            'kondisi' => $this->faker->randomElement(['Baik', 'Rusak', 'Dalam Perbaikan']),
            'lokasi_id' => 1,
        ];
    }
}

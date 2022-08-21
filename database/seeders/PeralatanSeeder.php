<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\Lokasi;
use App\Models\Peralatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PeralatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataLokasi = collect(Lokasi::pluck('id'));
        $dataJenis = collect(Jenis::pluck('id'))->toArray();
        $dataLokasi->map(function($query) use ($dataJenis){
            $key = array_rand($dataJenis);
            Peralatan::factory()->count(20)->state(
                new Sequence(
                    ['jenis_id' => $dataJenis[$key], 'lokasi_id' => $query]
                )
            )->create();
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use App\Models\Mahasiswa;
use App\Models\Peralatan;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $no = 0;
        $jumlah = 500;
        $mahasiswa = Mahasiswa::pluck('id')->toArray();
        $peralatan = Peralatan::pluck('id')->toArray();
        $kondisi = ['Baik', 'Rusak', 'Dalam Perbaikan'];
        while($no < $jumlah)
        {

            $status = rand(0,1);
            $keyRandM = array_rand($mahasiswa,1);
            $keyRandP = array_rand($peralatan, 1);
            $keyRandK1 = array_rand($kondisi, 1);
            $keyRandK2 = array_rand($kondisi, 1);
            $datePinjam = Factory::create()->dateTimeBetween('-2 years', 'now');
            $datePinjam = $datePinjam->format('Y-m-d H:i:s');
            $dateKembali = Carbon::parse($datePinjam)->addHours(rand(1,4));
            Aktivitas::create([
                'mahasiswa_id' => $mahasiswa[$keyRandM],
                'peralatan_id' => $peralatan[$keyRandP],
                'tgl_pinjam' => $datePinjam,
                'tgl_kembali' => $status == 1 ? $dateKembali : null,
                'status' => $status == 1 ? 'kembali' : 'pinjam',
                'kondisi_awal' => $kondisi[$keyRandK1],
                'kondisi_akhir' => $status == 1 ? $kondisi[$keyRandK2] : null
            ]);
            $no++;
        }
    }
}

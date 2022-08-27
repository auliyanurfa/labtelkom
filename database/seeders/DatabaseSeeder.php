<?php

namespace Database\Seeders;

use App\Models\Bhppemasukan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Unit;
use App\Models\Material;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'NIP' => '000000000000000000',
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'phone' => '081000111222',
            'role_id' => '1',
            'gender' => 'L',
            'address' => 'Politeknik Negeri Semarang'
        ]);
        User::create([
            'NIP' => '111111111111111111',
            'name' => 'prodi',
            'username' => 'prodi',
            'email' => 'prodi@gmail.com',
            'password' => bcrypt('prodi'),
            'phone' => '081000222111',
            'role_id' => '2',
            'gender' => 'L',
            'address' => 'Politeknik Negeri Semarang'
        ]);

        Role::create([
            'role_name' => 'Admin'
        ]);
        Role::create([
            'role_name' => 'Ketua Prodi'
        ]);

        Role::create([
            'role_name' => 'Ketua Lab'
        ]);

        Unit::create([
            'name_unit' => 'Resistor'
        ]);

        Unit::create([
            'name_unit' => 'Capasitor'
        ]);

        Material::factory(20)->create();

        $this->call(MahasiswaSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(LokasiSeeder::class);
        $this->call(PeralatanSeeder::class);
        $this->call(AktivitasSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'nip/nik' => '1970376648922000',
                'name' => 'Oscar',
                'email' => 'pengawas@gmail.com',
                'role' => 'pengawas',
                'jabatan' => 'anggota',
                'no_telp' => '081268309271',
                'password' => bcrypt('pengawas123'),
                'nbh' => null,
            ],
            [
                'nip/nik' => '1371376648920183',
                'name' => 'Budi',
                'email' => 'pengurus@gmail.com',
                'role' => 'pengurus',
                'jabatan' => 'ketua',
                'no_telp' => '081268309274',
                'password' => bcrypt('pengurus123'),
                'nbh' => '1732/BH-XVII tanggal 06 Mei 1988',
            ],
            [
                'nip/nik' => '1970379948922002',
                'name' => 'Indah',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'jabatan' => 'ketua',
                'no_telp' => '081268309272',
                'password' => bcrypt('admin123'),
                'nbh' => null,
            ],
            [
                'nip/nik' => '1970376238921998',
                'name' => 'Syaiful',
                'email' => 'kapeng@gmail.com',
                'role' => 'kapeng',
                'jabatan' => 'ketua',
                'no_telp' => '081268309279',
                'password' => bcrypt('kapeng123'),
                'nbh' => null,
            ],
            [
                'nip/nik' => '1966376238921999',
                'name' => 'Indra',
                'email' => 'kadin@gmail.com',
                'role' => 'kadin',
                'jabatan' => 'ketua',
                'no_telp' => '081268309278',
                'password' => bcrypt('kadin123'),
                'nbh' => null,
            ],
        ];

        foreach ($userData as $user) {
            User::create($user);
        }
    }
}

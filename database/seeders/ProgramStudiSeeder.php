<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_prodi' => 'SI',
                'nama_prodi' => 'Sistem Informasi',
                'kode_unik'  => 10,
            ],
            [
                'kode_prodi' => 'BD',
                'nama_prodi' => 'Bisnis Digital',
                'kode_unik'  => 20,
            ],
            [
                'kode_prodi' => 'KA',
                'nama_prodi' => 'Komputerisasi Akuntansi',
                'kode_unik'  => 30,
            ],
        ];

        foreach ($data as $item) {
            ProgramStudi::updateOrCreate(
                ['kode_prodi' => $item['kode_prodi']],
                [
                    'nama_prodi' => $item['nama_prodi'],
                    'kode_unik'  => $item['kode_unik'],
                ]
            );
        }
    }
}

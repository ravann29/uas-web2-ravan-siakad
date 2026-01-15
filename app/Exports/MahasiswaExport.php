<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * Pastikan library Maatwebsite\Excel sudah terinstal di vendor
     */
    public function collection()
    {
        return User::where('role', 'mahasiswa')->with('programStudi')->get();
    }

    public function query()
    {
        // Mengambil user dengan role mahasiswa beserta data prodi-nya
        return User::query()->where('role', 'mahasiswa')->with('programStudi');
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Email',
            'Program Studi',
            'Tanggal Dibuat'
        ];
    }

    public function map($mhs): array
    {
        return [
            $mhs->nim,
            $mhs->name,
            $mhs->email,
            $mhs->programStudi->nama_prodi ?? 'Umum',
            $mhs->created_at->format('d-m-Y'),
        ];
    }
}
<?php
namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new User([
            'name'     => $row['nama'],
            'email'    => $row['email'],
            'nim'      => $row['nim'],
            'role'     => 'mahasiswa',
            'id_prodi' => $row['id_prodi'],
            'password' => bcrypt('password123'), // Default password
        ]);
    }

    public function rules(): array
    {
        return [
            'nim' => 'required|unique:users,nim', // Validasi NIM Duplikat
            'email' => 'required|email|unique:users,email',
            'nama' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nim.unique' => 'NIM :input sudah terdaftar di sistem.',
            'email.unique' => 'Email :input sudah digunakan.',
        ];
    }
}
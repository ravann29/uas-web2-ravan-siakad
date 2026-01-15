<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';

    protected $fillable = [
        'program_studi_id',
        'nama_prodi',
        'kode_unik',
    ];

    public function mahasiswa()
    {
        // Parameter kedua adalah foreign key di tabel users (misal: program_studi_id)
        return $this->hasMany(User::class, 'program_studi_id');
    }
}
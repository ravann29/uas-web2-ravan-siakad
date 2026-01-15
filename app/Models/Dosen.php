<?php

namespace App\Models; // <-- HARUS PAKAI NAMESPACE MODEL

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Pastikan nama tabel database sudah benar
    protected $table = 'dosen'; 

    // PENTING: Untuk Route Model Binding (menggunakan NIDN)
    public function getRouteKeyName()
    {
        return 'nidn'; 
    }

    // Tentukan kolom mana saja yang boleh diisi
    protected $fillable = [
        'nidn',
        'nama_dosen',
        'email',
    ];
}
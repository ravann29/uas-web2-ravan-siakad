<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruang extends Model
{
    use HasFactory;

    protected $table = 'ruang';
    protected $fillable = ['nama_ruang', 'kapasitas'];

    // Relasi: Satu Ruang dipakai banyak Jadwal (Level 6)
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjar extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajar';
    protected $fillable = ['nama_tahun', 'aktif'];

    // Relasi: Satu TahunAjar memiliki banyak Jadwal
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
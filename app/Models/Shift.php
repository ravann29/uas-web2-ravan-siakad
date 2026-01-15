<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shift';

    protected $fillable = [
        'nama_shift',
        'jam_mulai',
        'jam_selesai',
    ];

    // Relasi: Satu Shift (Kelas) memiliki banyak Jadwal (Level 6)
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
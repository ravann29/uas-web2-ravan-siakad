<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';
    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'status_mk_id'];

    // Relasi: MataKuliah dimiliki oleh satu StatusMk (Level 6)
    public function statusMk(): BelongsTo
    {
        return $this->belongsTo(StatusMk::class, 'status_mk_id');
    }

    // Relasi: Satu MataKuliah ada di banyak Jadwal (Level 6)
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusMk extends Model
{
    use HasFactory;

    protected $table = 'status_mk';
    protected $fillable = ['nama_status'];

    // Relasi: Satu StatusMk dimiliki oleh banyak MataKuliah (Level 6)
    public function mataKuliahs(): HasMany
    {
        return $this->hasMany(MataKuliah::class, 'status_mk_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Ruang; // Pastikan Anda meng-import Model Ruang

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'hari', 'waktu_mulai', 'waktu_selesai', 'keterangan',
        'mata_kuliah_id', 'dosen_id', 'ruang_id', 'shift_id', 'tahun_ajar_id'
    ];

    // Relasi ke Mata Kuliah (digunakan di Controller dan View: $item->mataKuliah)
    public function mataKuliah(): BelongsTo 
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    // Relasi Dosen
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class); 
    }

    // Relasi Ruangan (Nama method harus 'ruangan' karena dipanggil di Controller/View)
    // Relasi menunjuk ke Model Ruang dengan foreign key 'ruang_id'.
    public function ruangan(): BelongsTo 
    {
        return $this->belongsTo(Ruang::class, 'ruang_id'); 
    }

    // Relasi Shift (digunakan di Controller untuk grouping)
    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class); 
    }

    // Relasi tambahan
    public function tahunAjar(): BelongsTo
    {
        return $this->belongsTo(TahunAjar::class);
    }
}
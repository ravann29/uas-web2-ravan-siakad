<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('jadwal', function (Blueprint $table) {
        $table->id();
        $table->string('hari', 20); // Contoh: SENIN
        $table->string('waktu_mulai', 10); // Contoh: 07.30
        $table->string('waktu_selesai', 10); // Contoh: 10.00
        $table->string('keterangan', 255)->nullable(); // Misal: Shalat Dzuhur
        
        // --- 4 Relasi Wajib Level 6 ---
        $table->foreignId('mata_kuliah_id')->nullable()->constrained('mata_kuliah');
        $table->foreignId('dosen_id')->nullable()->constrained('dosen');
        $table->foreignId('ruang_id')->nullable()->constrained('ruang');
        $table->foreignId('shift_id')->constrained('shift');
        // --- End 4 Relasi ---
        
        // Relasi Tambahan
        $table->foreignId('tahun_ajar_id')->constrained('tahun_ajar');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};

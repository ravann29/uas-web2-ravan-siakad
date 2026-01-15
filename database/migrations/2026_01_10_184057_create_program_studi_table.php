<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_studi_id', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prodi', 10)->unique();
            $table->string('nama_prodi', 100);
            $table->unsignedInteger('kode_unik'); // untuk NIM nanti
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_studi_id');
    }
};
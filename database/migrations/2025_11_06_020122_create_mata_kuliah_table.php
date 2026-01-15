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
    Schema::create('mata_kuliah', function (Blueprint $table) {
        $table->id();
        $table->string('kode_mk', 10)->unique();
        $table->string('nama_mk', 150);
        $table->integer('sks');
        
        // Foreign Key ke status_mk
        $table->foreignId('status_mk_id')->constrained('status_mk'); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};

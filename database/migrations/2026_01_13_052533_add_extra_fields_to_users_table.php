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
        Schema::table('users', function (Blueprint $table) {
            // Kita tidak menambah kolom 'role' di sini karena sudah ada di database Anda.
            
            // Menambahkan kolom foto setelah password
            if (!Schema::hasColumn('users', 'photo')) {
                $table->string('photo')->nullable()->after('password');
            }

            // Menambahkan kolom tanggal lahir
            if (!Schema::hasColumn('users', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('photo');
            }

            // Menambahkan kolom ID Program Studi
            if (!Schema::hasColumn('users', 'program_studi_id')) {
                $table->unsignedBigInteger('program_studi_id')->nullable()->after('tanggal_lahir');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['photo', 'tanggal_lahir', 'program_studi_id']);
        });
    }
};
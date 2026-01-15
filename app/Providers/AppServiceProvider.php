<?php

namespace App\Providers;

// WAJIB DITAMBAHKAN UNTUK MENGGUNAKAN GATE
use Illuminate\Support\Facades\Gate; 
use App\Models\User; // WAJIB DITAMBAHKAN UNTUK MODEL User

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Definisikan Gate "is_admin" untuk Level 9
        // Gate ini memeriksa apakah role pengguna yang sedang login adalah 'admin'.
        Gate::define('is_admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
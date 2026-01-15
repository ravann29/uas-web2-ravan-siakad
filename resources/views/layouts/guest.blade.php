<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Akademik') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* HEADER KONSISTEN */
        .header {
            background-color: #333;
            color: white;
            padding: 1rem 0;
            border-bottom: 5px solid #F39C12; /* Warna Oranye Konsisten */
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-links a {
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: #F39C12;
        }

        /* PERBAIKAN FORM BREEZE UNTUK KETERBACAAN */
        
        /* 1. Warna Teks Label Lebih Gelap */
        label {
            color: #333 !important; /* Membuat Label lebih hitam */
            font-weight: 600 !important; 
        }
        
        /* 2. Input Form Kontras */
        input[type="email"], 
        input[type="password"], 
        input[type="text"] {
            border-color: #ccc !important; /* Border lebih terlihat */
            color: #333 !important; /* Memastikan teks input hitam */
            background-color: #fff !important; /* Memastikan background input putih */
        }

        /* 3. Tombol Utama (Log In/Register) Menggunakan Warna Konsisten */
        .bg-indigo-500 {
            background-color: #F39C12 !important; /* Warna Oranye Konsisten */
            border-color: #F39C12 !important;
            transition: background-color 0.3s;
        }
        .bg-indigo-500:hover {
            background-color: #e68a00 !important; /* Hover Oranye yang lebih gelap */
        }
        
    </style>

</head>
<body class="font-sans text-gray-900 antialiased">
    <header class="header">
        <div class="container">
            <div class="text-xl font-bold">
                Sistem Akademik
            </div>
            
            <nav class="nav-links">
                <a href="{{ url('/') }}">HOME</a>
                <a href="{{ route('contact.form') }}">CONTACT</a>
                
                {{-- Logika Navigasi Otentikasi --}}
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/jadwal') }}">JADWAL</a>
                        {{-- Log Out perlu form karena menggunakan POST --}}
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-sm text-white hover:text-red-500 ml-4">
                                Log Out
                            </a>
                        </form>
                    @else
                        {{-- Tautan Login dan Register hanya tampil jika tidak sedang berada di halaman tersebut --}}
                        @if (!request()->is('login'))
                            <a href="{{ route('login') }}">LOGIN</a>
                        @endif
                        @if (Route::has('register') && !request()->is('register'))
                            <a href="{{ route('register') }}" class="ml-4">REGISTER</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    {{-- Konten Utama (Login/Register Form) --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
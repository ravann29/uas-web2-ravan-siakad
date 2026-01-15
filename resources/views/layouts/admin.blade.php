<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | @yield('title', 'Sistem Akademik')</title>

    <head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
</head>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* CSS KONSISTENSI & HEADER */
        .header { background-color: #333; color: white; padding: 1rem 0; border-bottom: 5px solid #F39C12; }
        .container-nav { max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: space-between; align-items: center; }
        .nav-links a { color: white; padding: 0.5rem 1rem; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .nav-links a:hover { color: #F39C12; }
        .content-area { padding: 2rem 1rem; background-color: #f4f4f4; min-height: calc(100vh - 60px); }

        /* CSS Dropdown BARU */
        .dropdown { position: relative; display: inline-block; margin-left: 1rem; }
        .dropdown-toggle {
            padding: 0.5rem 1rem;
            text-decoration: none !important;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            background-color: transparent !important; 
            border-radius: 0;
            color: white !important;
            font-size: 0.95em;
        }
        .dropdown-toggle:hover {
            color: #F39C12 !important;
        }
        .dropdown-menu {
            display: none; 
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1000;
            min-width: 200px;
            margin-top: 5px;
        }
        .dropdown:hover .dropdown-menu {
            display: block; 
        }
        .dropdown-item {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            font-weight: normal;
            transition: background-color 0.2s;
        }
        .dropdown-item:hover {
            background-color: #333;
        }
    </style>
    @stack('styles')
    @livewireStyles
</head>
<body class="antialiased bg-gray-100">
    {{-- HEADER NAVIGASI --}}
    <header class="header">
        <div class="container-nav">
            <div class="text-xl font-bold">
                Sistem Akademik
            </div>
            
            <nav class="nav-links flex items-center gap-1">
                <a href="{{ auth()->check() ? url('/dashboard') : url('/') }}">HOME</a> 
                <a href="{{ route('contact.form') }}">CONTACT</a>

                @auth
                    @php
                        $status = (auth()->user()->role === 'admin') ? 'Admin' : 'Mahasiswa';
                        $userName = Auth::user()->name;
                    @endphp
                    
                    @if ($status === 'Mahasiswa')
                        <a href="{{ url('/jadwal') }}">JADWAL</a>
                    @else 
                        <a href="{{ route('admin.jadwal.index') }}">EDIT JADWAL</a>
                        <a href="{{ route('admin.mahasiswa.index') }}">MAHASISWA</a>
                        <a href="{{ route('admin.dosen.index') }}">DOSEN</a>
                        <a href="{{ route('admin.matkul.index') }}">MATKUL</a>
                    @endif
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            {{ $userName }} ({{ $status }}) 
                            <span style="font-size: 0.7em; margin-left: 5px;">&#9660;</span>
                        </a>
                        
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profil</a>
                            <form method="POST" action="{{ route('logout') }}" style="display:block;">
                                @csrf
                                <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="dropdown-item">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    {{-- ISI KONTEN UTAMA --}}
    <main class="content-area">
        @yield('content')
    </main>

    {{-- Footer/Scripts Tambahan --}}
    @stack('scripts')
    @livewireScripts
</body>
</html>


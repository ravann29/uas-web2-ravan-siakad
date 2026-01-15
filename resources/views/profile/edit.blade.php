<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil | Sistem Akademik</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* --- CSS KONSISTENSI & HEADER --- */
        .header { background-color: #333; color: white; padding: 1rem 0; border-bottom: 5px solid #F39C12; }
        .container-nav { max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: space-between; align-items: center; }
        .nav-links a { color: white; padding: 0.5rem 1rem; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .nav-links a:hover { color: #F39C12; }
        
        /* CSS Dropdown */
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
        .dropdown-toggle:hover { color: #F39C12 !important; }
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
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-item {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: white !important;
            font-weight: normal;
            transition: background-color 0.2s;
        }
        .dropdown-item:hover { background-color: #444; }
    </style>
</head>
<body class="antialiased bg-gray-100">

    {{-- HEADER NAVIGASI --}}
    <header class="header">
        <div class="container-nav">
            <div class="text-xl font-bold">
                Sistem Akademik
            </div>
            
            <nav class="nav-links">
                <a href="{{ Auth::check() ? url('/dashboard') : url('/') }}">HOME</a> 
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

    {{-- KONTEN UTAMA --}}
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-1">Pengaturan Profil</h1>
                <p class="text-gray-600 text-sm">Perbarui data diri, foto, dan keamanan akun Anda</p>
            </div>

            {{-- SECTION 1: INFORMASI PROFIL (TERMASUK FOTO & PRODI) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h2 class="text-base font-semibold text-gray-900">Informasi Profil</h2>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    {{-- DI SINI KITA MENGIRIM DATA PROGRAM STUDI KE PARTIALS --}}
                    @include('profile.partials.update-profile-information-form', [
                        'programStudis' => \App\Models\ProgramStudi::orderBy('nama_prodi')->get()
                    ])
                </div>
            </div>

            {{-- SECTION 2: UPDATE PASSWORD --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h2 class="text-base font-semibold text-gray-900">Keamanan Password</h2>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- INFO BOX --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="ml-3 text-sm text-blue-700">
                        <strong>Tips:</strong> Gunakan foto profil resmi dengan format JPG/PNG maksimal 2MB.
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
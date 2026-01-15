<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kontak & Pengaduan | Sistem Akademik</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CSS yang Diperlukan untuk Header (TIDAK DIUBAH) */
        .header { background-color: #333; color: white; padding: 1rem 0; border-bottom: 5px solid #F39C12; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: space-between; align-items: center; }
        .nav-links a { color: white; padding: 0.5rem 1rem; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .nav-links a:hover { color: #F39C12; }
        
        /* CSS Dropdown (TIDAK DIUBAH) */
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
</head>
<body class="antialiased">
    
    <header class="header">
        <div class="container">
            <div class="text-xl font-bold">
                Sistem Akademik
            </div>
            
            <nav class="nav-links">
                
                {{-- Navigasi Umum --}}
                <a href="{{ Auth::check() ? url('/dashboard') : url('/') }}">HOME</a> 
                <a href="{{ route('contact.form') }}">CONTACT</a>

                @auth
                    @php
                        // Menentukan Status (Mahasiswa atau Admin)
                        $status = (auth()->user()->role === 'admin') ? 'Admin' : 'Mahasiswa';
                        $userName = Auth::user()->name;
                    @endphp
                    
                    {{-- Navigasi Khusus Role --}}
                    @if ($status === 'Mahasiswa')
                        <a href="{{ url('/jadwal') }}">JADWAL</a>
                    @else 
                        {{-- Navigasi Admin --}}
                        <a href="{{ route('admin.jadwal.index') }}">EDIT JADWAL</a>
                        <a href="{{ route('admin.mahasiswa.index') }}">MAHASISWA</a>
                        <a href="{{ route('admin.dosen.index') }}">DOSEN</a>
                        <a href="{{ route('admin.matkul.index') }}">MATKUL</a>
                    @endif
                    
                    {{-- DROPDOWN MENU BARU: NAMA (Status) --}}
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            {{ $userName }} ({{ $status }}) 
                            <span style="font-size: 0.7em; margin-left: 5px;">&#9660;</span>
                        </a>
                        
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                Edit Profil
                            </a>
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
                    
                @else
                    {{-- Tautan Login/Register untuk Pengguna Belum Login --}}
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-400">LOGIN</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary ml-4">REGISTER</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            
            {{-- HEADER SECTION --}}
            <div class="mb-8">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Kontak & Pengaduan</h1>
                    <p class="text-gray-600 text-sm">Sampaikan pertanyaan atau keluhan Anda mengenai jadwal akademik</p>
                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                {{-- Form Header --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h2 class="text-base font-semibold text-gray-900">Formulir Kontak & Pengaduan</h2>
                            <p class="text-gray-500 text-xs mt-0.5">Semua field wajib diisi</p>
                        </div>
                    </div>
                </div>

                {{-- Form Body --}}
                <form action="#" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        
                        {{-- NAMA LENGKAP --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   value="{{ Auth::check() ? Auth::user()->name : '' }}" 
                                   placeholder="Masukkan nama lengkap Anda"
                                   required>
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   value="{{ Auth::check() ? Auth::user()->email : '' }}" 
                                   placeholder="email@example.com"
                                   required>
                            <p class="mt-1.5 text-xs text-gray-500">Kami akan mengirim balasan ke alamat email ini</p>
                        </div>

                        {{-- SUBJEK --}}
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                Subjek Pengaduan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="subject" 
                                   id="subject" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   placeholder="Contoh: Bentrok Jadwal Mata Kuliah"
                                   required>
                        </div>

                        {{-- PESAN --}}
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Isi Pesan/Pengaduan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" 
                                      id="message" 
                                      rows="5" 
                                      class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                                      placeholder="Jelaskan detail pengaduan atau pertanyaan Anda..."
                                      required></textarea>
                            <p class="mt-1.5 text-xs text-gray-500">Minimum 20 karakter</p>
                        </div>

                    </div>

                    {{-- FORM ACTIONS --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ Auth::check() ? url('/dashboard') : url('/') }}" 
                               class="inline-flex items-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 transition-all duration-200"
                                    style="background-color: #F39C12;">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Kirim Pengaduan
                            </button>
                        </div>
                    </div>
                </form>

            </div>

            {{-- INFO BOX --}}
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Pengaduan akan ditinjau dalam waktu 1x24 jam</li>
                                <li>Pastikan email yang dimasukkan aktif untuk menerima balasan</li>
                                <li>Jelaskan masalah dengan detail agar dapat ditangani dengan cepat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
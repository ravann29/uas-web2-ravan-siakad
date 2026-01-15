<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mata Kuliah</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* CSS HEADER KONSISTENSI */
        .header { background-color: #333; color: white; padding: 1rem 0; border-bottom: 5px solid #F39C12; }
        .container-nav { max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: space-between; align-items: center; }
        .nav-links a { color: white; padding: 0.5rem 1rem; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .nav-links a:hover { color: #F39C12; }
        
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
            /* Latar belakang dropdown menu diubah menjadi gelap #333 */
            background-color: #333; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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
            /* Perbaikan: Menggunakan warna terang agar terlihat di latar belakang #333 */
            color: white; 
            font-weight: normal;
            transition: background-color 0.2s;
        }
        .dropdown-item:hover {
            /* Warna hover diubah agar kontras */
            background-color: #555; 
            color: #F39C12;
        }

        /* CSS TABEL JADWAL */
        table { width: 100%; border-collapse: collapse; margin-bottom: 25px; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; font-size: 0.85em; vertical-align: top; }
        th { background-color: #333; color: white; font-weight: bold; }
        
        /* CSS Perbaikan: Menjamin WAKTU tidak wrap */
        .nowrap-cell {
            white-space: nowrap; 
        }

        .header-purple { background-color: #5B2C6F; color: white; }
        .header-blue { background-color: #2E86C1; color: white; }
        .header-blue-dark { background-color: #1A5276; color: white; }
        .hari { background-color: #F39C12; color: white; font-size: 1.1em; font-weight: bold; padding: 10px; }
        .sub-header td { background-color: #E5E7E9; color: #555; font-size: 0.8em; border: none; padding: 5px 15px; }
        .highlight-green { background-color: #D4EFDF; font-weight: bold; color: #145A32; }
        .highlight-green td { border-color: #A9DFBF; }
        td i { font-size: 0.75em; display: block; margin-top: 2px; color: #666; }
        
        /* CSS TOMBOL AKSI */
        .action-buttons { margin-top: 8px; display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; }
        .action-button { 
            display: inline-flex;
            align-items: center;
            font-size: 0.7em; 
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
            transition: opacity 0.2s;
            font-weight: 500;
        }
        .action-edit { background-color: #E3F2FD; color: #1976D2; border: 1px solid #BBDEFB; }
        .action-delete { background-color: #FFEBEE; color: #C62828; border: 1px solid #FFCDD2; }
        .action-button:hover { opacity: 0.8; }
    </style>
</head>
<body class="antialiased bg-gray-50">

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
                        $jadwalRoute = ($status === 'Admin') ? route('admin.jadwal.index') : url('/jadwal');
                    @endphp
                    
                    @if ($status === 'Mahasiswa')
                        <a href="{{ $jadwalRoute }}">JADWAL</a>
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
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                Edit Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}" style="display:block;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: transparent; border: none; cursor: pointer;">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}">LOGIN</a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- KONTEN UTAMA --}}
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            {{-- HEADER SECTION --}}
            <div class="mb-8">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">JADWAL MATA KULIAH</h1>
                    <p class="text-gray-600 text-sm mb-2">Program S1 SI & BD, D3 KA</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $tahunAjarNama }}</p>
                </div>

                {{-- TOMBOL TAMBAH & ALERT SUCCESS --}}
                @auth
                    @if (auth()->user()->role == 'admin')
                        <div class="mt-6 text-center">
                            <a href="{{ route('admin.jadwal.create') }}"
                               class="inline-flex items-center px-6 py-2.5 text-white text-sm font-semibold rounded-lg shadow-sm transition-all duration-200 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400"
                               style="background-color: #F39C12;">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Jadwal Baru
                            </a>
                        </div>
                    @endif
                @endauth

                @if (session('success'))
                    <div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- TABEL JADWAL --}}
            {{-- PERBAIKAN: Mengganti $dataJadwal menjadi $jadwals --}}
            @if ($jadwals->isEmpty()) 
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Jadwal</h3>
                        <p class="text-gray-500">
                            Belum ada jadwal yang ditetapkan untuk Tahun Akademik Aktif ini.
                        </p>
                    </div>
                </div>
            @else
                {{-- PERBAIKAN: Mengganti $dataJadwal menjadi $jadwals --}}
                @foreach ($jadwals as $hari => $shiftsData) 
                <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <table>
                        <colgroup>
                            {{-- PENYESUAIAN WIDTH --}}
                            @foreach($shifts as $shiftName)
                                <col style="width:110px">   {{-- WAKTU: 110px --}}
                                <col style="width:300px">   {{-- MATKUL/DOSEN: 300px --}}
                                <col style="width:90px">    {{-- RUANGAN: 90px --}}
                            @endforeach
                        </colgroup>

                        @if ($loop->first)
                        <tr class="sub-header">
                            <td colspan="3" style="text-align:left;">Semester 3</td>
                            <td colspan="{{ count($shifts) * 3 - 3 }}" style="text-align:right;">15 September 2025</td>
                        </tr>
                        @endif
                        
                        <tr class="hari"><td colspan="{{ count($shifts) * 3 }}">{{ strtoupper($hari) }}</td></tr>
                        
                        <tr>
                            @foreach($shifts as $shiftName)
                                @php
                                    $headerClass = match($shiftName) {
                                        'S1 SI' => 'header-purple',
                                        'D3 KA' => 'header-blue-dark',
                                        default => 'header-blue',
                                    };
                                @endphp
                                <th class="{{ $headerClass }} nowrap-cell">WAKTU</th><th class="{{ $headerClass }}">{{ $shiftName }}</th><th class="{{ $headerClass }}">R</th>
                            @endforeach
                        </tr>

                        @php
                            $allTimes = $shiftsData->flatMap(fn($shift) => $shift->map(fn($item) => $item->waktu_mulai . '-' . $item->waktu_selesai))->unique()->sort()->values();
                        @endphp

                        @foreach ($allTimes as $timeRange)
                            @php
                                list($waktu_mulai, $waktu_selesai) = explode('-', $timeRange);
                                $isShalat = ($waktu_mulai == '12.00' && $waktu_selesai == '12.30') || ($waktu_mulai == '11.10' && $waktu_selesai == '13.00');
                            @endphp
                            
                            <tr @class(['highlight-green' => $isShalat])>
                                @foreach($shifts as $shiftName)
                                    @php
                                        $shiftItems = $shiftsData->get($shiftName, collect());
                                        $item = $shiftItems->first(fn($i) => $i->waktu_mulai == $waktu_mulai && $i->waktu_selesai == $waktu_selesai);
                                    @endphp
                                    
                                    {{-- Kolom WAKTU (menggunakan class nowrap-cell) --}}
                                    <td class="nowrap-cell">{{ $waktu_mulai }} - {{ $waktu_selesai }}</td>
                                    
                                    @if ($item)
                                        @if ($item->keterangan)
                                            <td colspan="2">{!! $item->keterangan !!}</td>
                                        @else
                                            <td>
                                                <div style="font-weight: 600; color: #1f2937;">{{ $item->mataKuliah->nama_mk }}</div>
                                                @if ($item->dosen)
                                                    <i style="color: #6b7280;">{{ $item->dosen->nama_dosen }}@if($item->dosen->gelar), {{ $item->dosen->gelar }}@endif</i>
                                                @endif

                                                @auth
                                                    @if (auth()->user()->role == 'admin')
                                                        <div class="action-buttons">
                                                            <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="action-button action-edit">
                                                                ✏️ Edit
                                                            </a>
                                                            <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Yakin hapus jadwal ini?')" class="action-button action-delete">
                                                                    🗑️ Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endauth
                                            </td>
                                            
                                            {{-- PERBAIKAN: Mengganti $item->ruang menjadi $item->ruangan --}}
                                            <td style="font-weight: 600;">{{ $item->ruangan ? $item->ruangan->nama_ruang : '-' }}</td> 
                                        @endif
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endforeach
            @endif

        </div>
    </div>
</body>
</html>
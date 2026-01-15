@extends('layouts.admin')

@section('title', 'Manajemen Dosen')

@section('content')
{{-- Kontainer Utama disesuaikan dengan Matkul --}}
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Manajemen Dosen</h1>
                    <p class="text-gray-600 text-sm">Kelola data dosen untuk sistem akademik dan penjadwalan</p>
                </div>
                {{-- TOMBOL TAMBAH DOSEN (Styling Matkul) --}}
                <a href="{{ route('admin.dosen.create') }}"
                   class="inline-flex items-center px-4 py-2.5 text-white text-sm font-semibold rounded-lg shadow-sm transition-all duration-200 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400"
                   style="background-color: #F39C12;">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Dosen
                </a>
            </div>
        </div>

        {{-- ALERT SUKSES (Styling Matkul) --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="ml-3 flex-shrink-0 inline-flex text-green-400 hover:text-green-600 focus:outline-none" onclick="this.parentElement.parentElement.remove()">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        {{-- STATS CARD (Total Dosen, menggunakan icon user-tie) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Dosen Terdaftar</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dosen->count() }}</p>
                    </div>
                </div>
            </div>
            
            {{-- Placeholder untuk Statistik Dosen lain (Misal: Dosen Aktif) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Dosen Aktif</p>
                        {{-- Anggap semua dosen aktif, atau ganti dengan logika filtering Anda --}}
                        <p class="text-2xl font-bold text-gray-900">{{ $dosen->count() }}</p> 
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9m10-2a2 2 0 00-2-2H9a2 2 0 00-2 2h10zM12 4v2"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total NIDN Terdaftar</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $dosen->count() }}</p> 
                    </div>
                </div>
            </div>
        </div>
        
        {{-- ALERT DATA KOSONG (Styling Matkul) --}}
        @if ($dosen->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Data Dosen</h3>
                    <p class="text-gray-500 mb-6 max-w-md">
                        Saat ini belum ada data Dosen yang terdaftar. Silakan tambahkan data Dosen untuk memulai manajemen.
                    </p>
                    <a href="{{ route('admin.dosen.create') }}"
                       class="inline-flex items-center px-5 py-2.5 text-white text-sm font-semibold rounded-lg shadow-sm transition-all duration-200 hover:opacity-90"
                       style="background-color: #F39C12;">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Dosen Pertama
                    </a>
                </div>
            </div>
        @else
            {{-- TABEL DATA (Styling Matkul) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        {{-- HEADER TABEL (Styling Matkul) --}}
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wide w-16">
                                    No
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                    NIDN
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                    Nama Dosen
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                    Gelar Dosen
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wide w-40">
                                    Email
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wide w-40">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        {{-- BODY TABEL --}}
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($dosen as $index => $dosen)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="inline-flex items-center text-sm font-medium text-gray-900">{{ $dosen->nidn }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $dosen->nama_dosen }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-500">{{ $dosen->gelar }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-sm text-gray-500">{{ $dosen->email }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            
                                            {{-- TOMBOL EDIT (Fixed dan Styling Matkul) --}}
                                            <a href="{{ route('admin.dosen.edit', $dosen) }}"
                                               class="inline-flex items-center p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors duration-150"
                                               title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            
                                            {{-- TOMBOL HAPUS (Fixed dan Styling Matkul) --}}
                                            <form id="delete-form-{{ $dosen->id }}" action="{{ route('admin.dosen.destroy', $dosen) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="#" 
                                            class="inline-flex items-center p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors duration-150"
                                            title="Hapus"
                                            onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus Dosen {{ $dosen->nidn }} - {{ $dosen->nama_dosen }}?')) { document.getElementById('delete-form-{{ $dosen->id }}').submit(); }">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- PAGINATION (Jika menggunakan paginate() di controller) --}}
            @if (method_exists($dosen, 'links'))
                <div class="mt-6">
                    {{ $dosen->links('pagination::tailwind') }}
                </div>
            @endif
        @endif

    </div>
</div>
@endsection
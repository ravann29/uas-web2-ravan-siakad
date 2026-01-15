@extends('layouts.admin')

@section('title', 'Manajemen Mahasiswa')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Manajemen Mahasiswa</h1>
                    <p class="text-gray-600 text-sm">Kelola database mahasiswa secara realtime</p>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Tombol Tambah --}}
                    <a href="{{ route('admin.mahasiswa.create') }}"
                       class="flex items-center justify-center px-6 h-10 text-white text-sm font-semibold rounded-lg shadow-md hover:opacity-90 transition-all"
                       style="background-color: #F39C12;">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>

        {{-- STATS CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Stat Total Mahasiswa --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Mahasiswa</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\User::where('role', 'Mahasiswa')->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Stat Mahasiswa Aktif --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Mahasiswa Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\User::where('role', 'Mahasiswa')->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Stat Program Studi --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"/></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Program Studi</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\ProgramStudi::count() ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- AREA TABEL (LIVEWIRE) --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @livewire('mahasiswa-table')
        </div>

    </div>
</div>
@endsection
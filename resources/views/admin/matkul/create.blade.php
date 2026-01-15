@extends('layouts.admin')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Tambah Mata Kuliah</h1>
                    <p class="text-gray-600 text-sm">Lengkapi formulir di bawah untuk menambahkan mata kuliah baru</p>
                </div>
                <a href="{{ route('admin.matkul.index') }}" 
                   class="inline-flex items-center px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            {{-- Form Header --}}
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h2 class="text-base font-semibold text-gray-900">Informasi Mata Kuliah</h2>
                        <p class="text-gray-500 text-xs mt-0.5">Data yang wajib diisi ditandai dengan tanda bintang (*)</p>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('admin.matkul.store') }}" method="POST" class="p-6">
                @csrf

                <div class="space-y-6">
                    
                    {{-- KODE MATA KULIAH --}}
                    <div>
                        <label for="kode_mk" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kode Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="kode_mk" 
                               id="kode_mk" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('kode_mk') border-red-500 ring-2 ring-red-200 @enderror" 
                               value="{{ old('kode_mk') }}" 
                               placeholder="Contoh: IF101"
                               required>
                        @error('kode_mk')
                            <div class="mt-2 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-500">Gunakan kode unik untuk identifikasi mata kuliah</p>
                    </div>

                    {{-- NAMA MATA KULIAH --}}
                    <div>
                        <label for="nama_mk" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nama_mk" 
                               id="nama_mk" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama_mk') border-red-500 ring-2 ring-red-200 @enderror" 
                               value="{{ old('nama_mk') }}" 
                               placeholder="Contoh: Algoritma dan Struktur Data"
                               required>
                        @error('nama_mk')
                            <div class="mt-2 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-500">Masukkan nama lengkap mata kuliah</p>
                    </div>

                    {{-- SKS --}}
                    <div>
                        <label for="sks" class="block text-sm font-semibold text-gray-700 mb-2">
                            SKS (Satuan Kredit Semester) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               name="sks" 
                               id="sks" 
                               min="1" 
                               max="6" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('sks') border-red-500 ring-2 ring-red-200 @enderror" 
                               value="{{ old('sks') ?? 3 }}" 
                               required>
                        @error('sks')
                            <div class="mt-2 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-500">Nilai SKS antara 1-6 kredit</p>
                    </div>

                </div>

                {{-- FORM ACTIONS --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.matkul.index') }}" 
                           class="inline-flex items-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 transition-all duration-200"
                                style="background-color: #F39C12;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Mata Kuliah
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
                            <li>Kode mata kuliah harus unik dan tidak boleh sama dengan yang sudah ada</li>
                            <li>Nama mata kuliah sebaiknya jelas dan deskriptif</li>
                            <li>SKS umumnya berkisar antara 2-4 kredit untuk mata kuliah reguler</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
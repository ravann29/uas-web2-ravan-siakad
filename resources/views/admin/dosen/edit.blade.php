@extends('layouts.admin')

@section('title', 'Edit Dosen: ' . $dosen->nama_dosen)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Edit Dosen</h1>
                    <p class="text-gray-600 text-sm">Perbarui informasi dosen <span class="font-semibold text-gray-900">{{ $dosen->nama_dosen }}</span></p>
                </div>
                <a href="{{ route('admin.dosen.index') }}" 
                   class="inline-flex items-center px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- ALERT VALIDASI ERROR --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada input:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            {{-- Form Header --}}
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h2 class="text-base font-semibold text-gray-900">Edit Informasi Dosen</h2>
                        <p class="text-gray-500 text-xs mt-0.5">Data yang wajib diisi ditandai dengan tanda bintang (*)</p>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('admin.dosen.update', $dosen->nidn) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    
                    {{-- NIDN --}}
                    <div>
                        <label for="nidn" class="block text-sm font-semibold text-gray-700 mb-2">
                            NIDN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nidn" 
                               id="nidn" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nidn') border-red-500 ring-2 ring-red-200 @enderror" 
                               value="{{ old('nidn', $dosen->nidn) }}" 
                               placeholder="Contoh: 0123456789"
                               maxlength="10"
                               required>
                        @error('nidn')
                            <div class="mt-2 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-500">Nomor Induk Dosen Nasional (10 digit)</p>
                    </div>

                    {{-- NAMA DOSEN --}}
                    <div>
                        <label for="nama_dosen" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Dosen <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nama_dosen" 
                               id="nama_dosen" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nama_dosen') border-red-500 ring-2 ring-red-200 @enderror" 
                               value="{{ old('nama_dosen', $dosen->nama_dosen) }}" 
                               placeholder="Contoh: Dr. Budi Santoso"
                               required>
                        @error('nama_dosen')
                            <div class="mt-2 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-500">Masukkan nama lengkap dosen</p>
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 ring-2 ring-red-200 @enderror" 
                               value="{{ old('email', $dosen->email) }}" 
                               placeholder="email@example.com"
                               required>
                        @error('email')
                            <div class="mt-2 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-500">Email untuk korespondensi resmi</p>
                    </div>

                    {{-- GELAR --}}
                    <div>
                        <label for="gelar" class="block text-sm font-semibold text-gray-700 mb-2">
                            Gelar Akademik
                        </label>
                        <input type="text" 
                               name="gelar" 
                               id="gelar" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('gelar') border-red-500 ring-2 ring-red-200 @enderror" 
                               value="{{ old('gelar', $dosen->gelar) }}" 
                               placeholder="Contoh: S.T., M.Kom., Dr.">
                        @error('gelar')
                            <div class="mt-2 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                        <p class="mt-1.5 text-xs text-gray-500">Opsional - kosongkan jika tidak ada</p>
                    </div>

                </div>

                {{-- FORM ACTIONS --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.dosen.index') }}" 
                           class="inline-flex items-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 transition-all duration-200"
                                style="background-color: #F39C12;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Perbarui Data Dosen
                        </button>
                    </div>
                </div>
            </form>

        </div>

        {{-- INFO BOX --}}
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Perhatian</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Pastikan NIDN tetap unik setelah diperbarui</li>
                            <li>Perubahan email akan mempengaruhi notifikasi yang dikirim</li>
                            <li>Periksa kembali semua data sebelum menyimpan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
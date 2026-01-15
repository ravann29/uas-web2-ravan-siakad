@extends('layouts.admin')

@section('title', 'Tambah Jadwal Baru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Tambah Jadwal Kuliah</h1>
                    <p class="text-gray-600 text-sm">Lengkapi formulir di bawah untuk menambahkan jadwal kuliah baru</p>
                </div>
                <a href="{{ route('admin.jadwal.index') }}" 
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
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h2 class="text-base font-semibold text-gray-900">Informasi Jadwal</h2>
                        <p class="text-gray-500 text-xs mt-0.5">Data yang wajib diisi ditandai dengan tanda bintang (*)</p>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('admin.jadwal.store') }}" method="POST" class="p-6">
                @csrf

                {{-- TAHUN AJAR DROPDOWN --}}
                <div class="mb-6">
                    <label for="tahun_ajar_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tahun Akademik <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="tahun_ajar_id" id="tahun_ajar_id" required
                                class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('tahun_ajar_id') border-red-500 ring-2 ring-red-200 @enderror">
                            <option value="">Pilih Tahun Akademik</option>
                            @foreach ($tahunAjars as $tahunAjar)
                                <option value="{{ $tahunAjar->id }}" {{ old('tahun_ajar_id') == $tahunAjar->id ? 'selected' : '' }}>
                                    {{ $tahunAjar->nama_tahun }} {{ $tahunAjar->aktif ? '(Aktif)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('tahun_ajar_id')
                        <div class="mt-1.5 flex items-start">
                            <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    {{-- MATA KULIAH --}}
                    <div>
                        <label for="mata_kuliah_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="mata_kuliah_id" id="mata_kuliah_id" required
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('mata_kuliah_id') border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach ($matkuls as $matkul)
                                    <option value="{{ $matkul->id }}" {{ old('mata_kuliah_id') == $matkul->id ? 'selected' : '' }}>
                                        [{{ $matkul->kode_mk }}] {{ $matkul->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('mata_kuliah_id')
                            <div class="mt-1.5 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- DOSEN PENGAMPU --}}
                    <div>
                        <label for="dosen_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Dosen Pengampu <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="dosen_id" id="dosen_id" required
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('dosen_id') border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Dosen</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                        [{{ $dosen->nidn }}] {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('dosen_id')
                            <div class="mt-1.5 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- RUANGAN --}}
                    <div>
                        <label for="ruang_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Ruangan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="ruang_id" id="ruang_id" required
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('ruang_id') border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Ruangan</option>
                                @foreach ($ruangans as $ruang)
                                    <option value="{{ $ruang->id }}" {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                        {{ $ruang->nama_ruang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('ruang_id')
                            <div class="mt-1.5 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- SHIFT/PROGRAM STUDI --}}
                    <div>
                        <label for="shift_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Shift/Program Studi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="shift_id" id="shift_id" required
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('shift_id') border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Shift</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->nama_shift }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('shift_id')
                            <div class="mt-1.5 flex items-start">
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- HARI --}}
                    <div>
                        <label for="hari" class="block text-sm font-semibold text-gray-700 mb-2">
                            Hari <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="hari" id="hari" required
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('hari') border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Hari</option>
                                <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                        </div>
                        @error('hari')
                            <div class="mt-1.5 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- WAKTU MULAI --}}
                    <div>
                        <label for="waktu_mulai" class="block text-sm font-semibold text-gray-700 mb-2">
                            Waktu Mulai
                        </label>
                        <div class="relative">
                            <input type="time" name="waktu_mulai" id="waktu_mulai" 
                                   value="{{ old('waktu_mulai') }}" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('waktu_mulai') border-red-500 ring-2 ring-red-200 @enderror">
                        </div>
                        @error('waktu_mulai')
                            <div class="mt-1.5 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- WAKTU SELESAI --}}
                    <div>
                        <label for="waktu_selesai" class="block text-sm font-semibold text-gray-700 mb-2">
                            Waktu Selesai
                        </label>
                        <div class="relative">
                            <input type="time" name="waktu_selesai" id="waktu_selesai" 
                                   value="{{ old('waktu_selesai') }}" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('waktu_selesai') border-red-500 ring-2 ring-red-200 @enderror">
                        </div>
                        @error('waktu_selesai')
                            <div class="mt-1.5 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="md:col-span-2">
                        <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Keterangan (Opsional)
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                                  class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('keterangan') border-red-500 ring-2 ring-red-200 @enderror"
                                  placeholder="Tambahkan catatan atau keterangan tambahan...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="mt-1.5 flex items-start">
                                <svg class="h-4 w-4 text-red-500 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 text-white text-base font-semibold rounded-lg shadow-md transition-all duration-200 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400"
                            style="background-color: #F39C12;">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Buat Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
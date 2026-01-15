@extends('layouts.admin')

@section('title', 'Edit Jadwal Kuliah')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Edit Jadwal Kuliah</h1>
                    <p class="text-gray-600 text-sm">Perbarui informasi jadwal mata kuliah <span class="font-semibold text-gray-900">{{ $jadwal->mataKuliah->nama_mk }}</span></p>
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
                    <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h2 class="text-base font-semibold text-gray-900">Edit Informasi Jadwal</h2>
                        <p class="text-gray-500 text-xs mt-0.5">Data yang wajib diisi ditandai dengan tanda bintang (*)</p>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    
                    {{-- TAHUN AJAR DROPDOWN --}}
                    <div>
                        <label for="tahun_ajar_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tahun Akademik <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="tahun_ajar_id" id="tahun_ajar_id" required
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('tahun_ajar_id') border-red-500 ring-2 ring-red-200 @enderror">
                                <option value="">Pilih Tahun Akademik</option>
                                @foreach ($tahunAjars as $tahunAjar)
                                    <option value="{{ $tahunAjar->id }}" {{ old('tahun_ajar_id', $jadwal->tahun_ajar_id) == $tahunAjar->id ? 'selected' : '' }}>
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

                    {{-- GRID 2 KOLOM --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- MATA KULIAH --}}
                        <div>
                            <label for="mata_kuliah_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Mata Kuliah <span class="text-red-500">*</span>
                            </label>
                            <select name="mata_kuliah_id" 
                                    id="mata_kuliah_id" 
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('mata_kuliah_id') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach ($matkuls as $matkul)
                                    <option value="{{ $matkul->id }}" {{ old('mata_kuliah_id', $jadwal->mata_kuliah_id) == $matkul->id ? 'selected' : '' }}>
                                        [{{ $matkul->kode_mk }}] {{ $matkul->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_kuliah_id')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- DOSEN --}}
                        <div>
                            <label for="dosen_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Dosen Pengampu <span class="text-red-500">*</span>
                            </label>
                            <select name="dosen_id" 
                                    id="dosen_id" 
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('dosen_id') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Pilih Dosen</option>
                                @foreach ($dosen as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_id', $jadwal->dosen_id) == $dosen->id ? 'selected' : '' }}>
                                        [{{ $dosen->nidn }}] {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
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
                            <select name="ruang_id" 
                                    id="ruang_id" 
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('ruang_id') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Pilih Ruangan</option>
                                @foreach ($ruangans as $ruang)
                                    <option value="{{ $ruang->id }}" {{ old('ruang_id', $jadwal->ruang_id) == $ruang->id ? 'selected' : '' }}>
                                        {{ $ruang->nama_ruang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ruang_id')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- SHIFT --}}
                        <div>
                            <label for="shift_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Shift/Program Studi <span class="text-red-500">*</span>
                            </label>
                            <select name="shift_id" 
                                    id="shift_id" 
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('shift_id') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Pilih Shift</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ old('shift_id', $jadwal->shift_id) == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->nama_shift }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift_id')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                        {{-- HARI --}}
                        <div>
                            <label for="hari" class="block text-sm font-semibold text-gray-700 mb-2">
                                Hari <span class="text-red-500">*</span>
                            </label>
                            <select name="hari" 
                                    id="hari" 
                                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('hari') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Pilih Hari</option>
                                <option value="Senin" {{ old('hari', $jadwal->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ old('hari', $jadwal->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ old('hari', $jadwal->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ old('hari', $jadwal->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ old('hari', $jadwal->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ old('hari', $jadwal->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                            @error('hari')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
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
                            <input type="time" 
                                   name="waktu_mulai" 
                                   id="waktu_mulai" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('waktu_mulai') border-red-500 ring-2 ring-red-200 @enderror" 
                                   value="{{ old('waktu_mulai', $jadwal->waktu_mulai) }}">
                            @error('waktu_mulai')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
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
                            <input type="time" 
                                   name="waktu_selesai" 
                                   id="waktu_selesai" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('waktu_selesai') border-red-500 ring-2 ring-red-200 @enderror" 
                                   value="{{ old('waktu_selesai', $jadwal->waktu_selesai) }}">
                            @error('waktu_selesai')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
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
                            <textarea name="keterangan" 
                                      id="keterangan" 
                                      rows="3"
                                      class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('keterangan') border-red-500 ring-2 ring-red-200 @enderror"
                                      placeholder="Tambahkan catatan atau keterangan tambahan...">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="mt-2 flex items-start">
                                    <svg class="h-4 w-4 text-red-500 mr-1.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-xs text-red-600 leading-tight">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- FORM ACTIONS --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.jadwal.index') }}" 
                           class="inline-flex items-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-400 transition-all duration-200"
                                style="background-color: #F39C12;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Simpan Perubahan
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
                            <li>Pastikan tidak ada jadwal bentrok untuk dosen, ruangan, dan shift yang sama</li>
                            <li>Waktu selesai harus lebih besar dari waktu mulai</li>
                            <li>Perubahan jadwal akan langsung terlihat oleh mahasiswa</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
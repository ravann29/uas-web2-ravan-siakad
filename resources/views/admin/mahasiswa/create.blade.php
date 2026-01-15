@extends('layouts.admin')

@section('title', 'Tambah Mahasiswa Baru')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        {{-- HEADER SECTION --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Tambah Mahasiswa Baru</h1>
                    <p class="text-gray-600 text-sm">Lengkapi formulir di bawah untuk mendaftarkan mahasiswa baru</p>
                </div>
                <a href="{{ route('admin.mahasiswa.index') }}" 
                   class="inline-flex items-center px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
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
            
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h2 class="text-base font-semibold text-gray-900">Informasi Mahasiswa</h2>
                        <p class="text-gray-500 text-xs mt-0.5">Data yang wajib diisi ditandai dengan tanda bintang (*)</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="space-y-6">

                    {{-- FOTO SECTION --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil (Ukuran 4x6) <span class="text-red-500">*</span></label>
                        
                        <div class="mb-4 flex items-center p-3 text-xs text-blue-800 border border-blue-200 rounded-lg bg-blue-50">
                            <svg class="flex-shrink-0 w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <p><span class="font-bold">Info:</span> Gunakan foto formal 4:6 (Maks 2MB).</p>
                        </div>

                        {{-- PREVIEW CONTAINER 4x6 --}}
                        <div class="mb-3 flex justify-center">
                            <div id="previewContainer" class="relative border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center shadow-inner" 
                                 style="width: 150px; height: 225px;">
                                
                                <img id="photoPreview" src="" class="w-full h-full object-cover hidden">
                                <div id="placeholderText" class="text-center p-4">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-[10px] text-gray-500 mt-2 uppercase tracking-widest font-bold">Preview 4x6</p>
                                </div>
                            </div>
                        </div>

                        <input type="file" name="photo" id="photoInput" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition-all cursor-pointer" 
                               required>
                        
                        <button type="button" id="removePhoto" class="mt-2 text-xs text-red-600 font-bold hidden hover:underline">
                            × HAPUS FOTO
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- NIM --}}
                        <div>
                            <label for="nim" class="block text-sm font-semibold text-gray-700 mb-2">NIM <span class="text-red-500">*</span></label>
                            <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 @error('nim') border-red-500 @enderror" 
                                   placeholder="Contoh: 202602001" required>
                        </div>

                        {{-- NAMA --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 @error('name') border-red-500 @enderror" 
                                   placeholder="Contoh: Ahmad Subardjo" required>
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 @error('email') border-red-500 @enderror" 
                               placeholder="mahasiswa@kampus.ac.id" required>
                    </div>

                    {{-- PROGRAM STUDI --}}
                    <div>
                        <label for="id_prodi" class="block text-sm font-semibold text-gray-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                        <select name="id_prodi" id="id_prodi" 
                                class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 @error('id_prodi') border-red-500 @enderror" required>
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach ($program_studi as $prodi)
                                <option value="{{ $prodi->id }}" {{ old('id_prodi') == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- FORM ACTIONS --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.mahasiswa.index') }}" 
                           class="inline-flex items-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white hover:opacity-90 transition-all duration-200"
                                style="background-color: #F39C12;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Mahasiswa
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- INFO BOX --}}
        <div class="mt-6 bg-orange-50 border border-orange-200 rounded-lg p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-orange-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="text-xs text-orange-700 space-y-1">
                    <p class="font-bold">Informasi Penting:</p>
                    <ul class="list-disc list-inside">
                        <li>Pastikan NIM belum pernah terdaftar sebelumnya.</li>
                        <li>Gunakan foto dengan latar belakang polos untuk keperluan administrasi.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const placeholderText = document.getElementById('placeholderText');
    const removeBtn = document.getElementById('removePhoto');
    const previewContainer = document.getElementById('previewContainer');

    photoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Error: File harus berupa gambar (JPG/PNG)!');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                photoPreview.src = e.target.result;
                photoPreview.classList.remove('hidden');
                placeholderText.classList.add('hidden');
                removeBtn.classList.remove('hidden');
                previewContainer.classList.add('border-solid');
                previewContainer.classList.remove('border-dashed');
            };
            reader.readAsDataURL(file);
        }
    });

    removeBtn.addEventListener('click', function () {
        photoInput.value = '';
        photoPreview.src = '';
        photoPreview.classList.add('hidden');
        placeholderText.classList.remove('hidden');
        previewContainer.classList.remove('border-solid');
        previewContainer.classList.add('border-dashed');
        this.classList.add('hidden');
    });
});
</script>
@endsection
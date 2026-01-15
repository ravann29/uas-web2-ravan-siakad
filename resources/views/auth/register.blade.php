<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-md w-full">

            {{-- HEADER --}}
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-1">Daftar Akun Baru</h1>
                <p class="text-gray-600 text-sm">Buat akun untuk mengakses Sistem Akademik</p>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                {{-- Form Header --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h2 class="text-base font-semibold text-gray-900">REGISTER</h2>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="p-6">
                    @csrf

                    <div class="space-y-6">

                        {{-- NAMA --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                                   value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" 
                                   value="{{ old('email') }}" placeholder="email@example.com" required>
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password *</label>
                                <input type="password" name="password" id="password" 
                                       class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi *</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>

                        {{-- PILIH ROLE --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Daftar Sebagai <span class="text-red-500">*</span></label>
                            <div class="flex gap-6 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="register_as" value="mahasiswa" class="text-blue-600" {{ old('register_as') == 'admin' ? '' : 'checked' }}>
                                    <span class="text-sm font-medium text-gray-700">Mahasiswa</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="register_as" value="admin" class="text-blue-600" {{ old('register_as') == 'admin' ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-gray-700">Admin</span>
                                </label>
                            </div>
                        </div>

                        {{-- MAHASISWA FIELDS --}}
                        <div id="mahasiswaFields" class="space-y-6">
                            {{-- FOTO MAHASISWA --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Foto Mahasiswa (Ukuran 4x6) <span class="text-red-500">*</span>
                                </label>

                                {{-- ALERT INFORMASI --}}
                                <div class="mb-4 flex items-center p-3 text-xs text-blue-800 border border-blue-200 rounded-lg bg-blue-50" role="alert">
                                    <svg class="flex-shrink-0 w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <p><span class="font-bold">Info:</span> Harap gunakan foto formal dengan perbandingan 4:6.</p>
                                </div>

                                {{-- PREVIEW BOX 4x6 --}}
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
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer">

                                <button type="button" id="removePhoto" class="mt-2 text-xs text-red-600 font-bold hidden hover:underline">
                                    × HAPUS FOTO
                                </button>
                                @error('photo')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                           class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi *</label>
                                    <select name="program_studi_id" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- Pilih Program Studi --</option>
                                        @foreach ($program_studi as $program_studi)
                                            <option value="{{ $program_studi->id }}" {{ old('program_studi_id') == $program_studi->id ? 'selected' : '' }}>
                                                {{ $program_studi->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- KODE ADMIN --}}
                        <div id="adminCodeWrapper" class="hidden">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kode Otoritas Admin <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="admin_code" value="{{ old('admin_code') }}"
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Masukkan Kode Admin Khusus">
                            <p class="mt-1.5 text-[10px] text-gray-500 italic">Hanya untuk staf akademik resmi.</p>
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                                Sudah punya akun?
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 rounded-lg shadow-sm text-sm font-bold text-white hover:opacity-90 transition-all" style="background-color: #F39C12;">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                REGISTER
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const roleRadios = document.querySelectorAll('input[name="register_as"]');
            const adminBox = document.getElementById('adminCodeWrapper');
            const mahasiswaBox = document.getElementById('mahasiswaFields');
            const photoInput = document.getElementById('photoInput');
            const photoPreview = document.getElementById('photoPreview');
            const placeholderText = document.getElementById('placeholderText');
            const removeBtn = document.getElementById('removePhoto');
            const previewContainer = document.getElementById('previewContainer');

            // 1. Fungsi Toggle Role
            function toggleFields() {
                const role = document.querySelector('input[name="register_as"]:checked').value;
                if (role === 'admin') {
                    adminBox.classList.remove('hidden');
                    mahasiswaBox.classList.add('hidden');
                } else {
                    adminBox.classList.add('hidden');
                    mahasiswaBox.classList.remove('hidden');
                }
            }

            roleRadios.forEach(r => r.addEventListener('change', toggleFields));
            toggleFields(); // Jalankan saat load pertama kali

            // 2. Fungsi Preview Foto
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

            // 3. Fungsi Hapus Foto
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
</x-guest-layout>
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Informasi Akun</h2>
        <p class="mt-1 text-sm text-gray-600">Perbarui foto profil, email, dan data akademik Anda.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- FOTO PROFIL --}}
        <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-lg border border-dashed border-gray-300">
            <div class="shrink-0">
                @if($user->photo)
                    <img id="preview" src="{{ asset('storage/' . $user->photo) }}" class="h-20 w-20 object-cover rounded-full ring-2 ring-orange-500">
                @else
                    <div class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <label class="block font-bold text-gray-800 text-sm mb-1">Foto Profil</label>
                <input name="photo" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" accept="image/*"/>
            </div>
        </div>

        {{-- NAMA --}}
        <div>
            <label class="block font-bold text-gray-800 text-sm">Nama Mahasiswa</label>
            <input type="text" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm text-gray-900 focus:border-orange-500 focus:ring-orange-500" value="{{ $user->name }}" disabled>
            <input type="hidden" name="name" value="{{ $user->name }}">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block font-bold text-gray-800 text-sm">Email</label>
            <input name="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:border-orange-500 focus:ring-orange-500" value="{{ old('email', $user->email) }}" required>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        @if($user->role !== 'admin')
            {{-- TANGGAL LAHIR --}}
            <div>
                <label class="block font-bold text-gray-800 text-sm">Tanggal Lahir</label>
                <input name="tanggal_lahir" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:border-orange-500 focus:ring-orange-500" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
            </div>

            {{-- PROGRAM STUDI --}}
            <div>
                <label class="block font-bold text-gray-800 text-sm">Program Studi</label>
                <select name="program_studi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:border-orange-500 focus:ring-orange-500">
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach($programStudis as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('program_studi_id', $user->program_studi_id) == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <button type="submit" style="background-color: #F39C12;" class="px-4 py-2 text-white font-bold rounded shadow hover:bg-orange-600 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>
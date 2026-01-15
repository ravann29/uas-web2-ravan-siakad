<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Perbarui Kata Sandi</h2>
        <p class="mt-1 text-sm text-gray-600">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block font-bold text-gray-800 text-sm">Kata Sandi Saat Ini</label>
            <input name="current_password" type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:border-orange-500 focus:ring-orange-500">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label class="block font-bold text-gray-800 text-sm">Kata Sandi Baru</label>
            <input name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:border-orange-500 focus:ring-orange-500">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block font-bold text-gray-800 text-sm">Konfirmasi Kata Sandi</label>
            <input name="password_confirmation" type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900 focus:border-orange-500 focus:ring-orange-500">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" style="background-color: #F39C12;" class="px-4 py-2 text-white font-bold rounded shadow hover:bg-orange-600 transition">
                Simpan Sandi Baru
            </button>
        </div>
    </form>
</section>
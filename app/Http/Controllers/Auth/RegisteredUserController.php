<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProgramStudi;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'program_studi' => ProgramStudi::orderBy('nama_prodi')->get()
        ]);
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Dasar
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role = 'mahasiswa'; // Default role
        $nim = null; // Default NIM kosong (untuk admin)

        // 2. Logika Penentuan Role Admin
        if ($request->register_as === 'admin') {
            if ($request->admin_code !== config('app.admin_code')) {
                return back()->withErrors([
                    'admin_code' => 'Kode admin tidak valid'
                ])->withInput();
            }
            $role = 'admin';
        }

        // 3. Validasi & Logika Khusus Mahasiswa (NIM Otomatis)
        if ($role === 'mahasiswa') {
            $request->validate([
                'photo' => ['required', 'image', 'max:2048'],
                'tanggal_lahir' => ['required', 'date'],
                'program_studi_id' => ['required', 'exists:program_studi,id'], 
            ]);

            // --- MULAI LOGIKA NIM OTOMATIS ---
            $prodi = ProgramStudi::findOrFail($request->program_studi_id);
            $tahun = date('Y'); 
            $kodeUnik = $prodi->kode_unik; // Contoh: 10, 20, 30

            // Hitung urutan pendaftar di prodi yang sama pada tahun yang sama
            $urutan = User::where('program_studi_id', $request->program_studi_id)
                          ->whereYear('created_at', $tahun)
                          ->count() + 1;

            $nomorUrut = str_pad($urutan, 2, '0', STR_PAD_LEFT);

            // Format: Tahun(4) + Wajib(0) + KodeUnik(2) + NomorUrut(2) = 9 Digit
            $nim = $tahun . "0" . $kodeUnik . $nomorUrut;
            // --- SELESAI LOGIKA NIM OTOMATIS ---
        }

        // 4. Handle Upload Foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('mahasiswa', 'public');
        }

        // 5. Simpan ke Database
        $user = User::create([
            'nim' => $nim, // Masukkan NIM hasil generate
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'photo' => $photoPath,
            'tanggal_lahir' => $request->tanggal_lahir,
            'program_studi_id' => $request->program_studi_id,
        ]);

        // 6. Spatie Role (Opsional)
        if (method_exists($user, 'syncRoles')) {
            $user->syncRoles([$role]);
        }

        event(new Registered($user));

        Auth::login($user);
        return redirect('/dashboard');
    }
}
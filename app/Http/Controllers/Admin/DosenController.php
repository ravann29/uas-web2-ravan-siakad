<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen; // Import Model yang benar
use Illuminate\Validation\Rule; // <-- PENTING: Untuk validasi unique

class DosenController extends Controller
{
    /**
     * Menampilkan daftar semua Dosen. (Index)
     */
    public function index()
    {
        try {
            // Mengambil semua data Dosen
            $dosens = Dosen::all(); 
        } catch (\Exception $e) {
            // Fail safe: kembalikan Collection kosong jika database/tabel tidak ditemukan
            $dosens = collect([]);
        }

        return view('admin.dosen.index', compact('dosens'));
    }

    // CREATE
    public function create() 
    { 
        return view('admin.dosen.create'); 
    }
    
    /**
     * Menyimpan data Dosen baru ke database. (Store)
     */
    public function store(Request $request) 
    { 
        // Validasi data
        $validatedData = $request->validate([
            'nidn' => ['required', 'string', 'max:10', 'min:5', Rule::unique('dosens', 'nidn')],
            'nama_dosen' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('dosens', 'email')],
            'gelar' => ['nullable', 'string', 'max:100'],
        ]);

        // Simpan ke Database
        Dosen::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen ' . $validatedData['nama_dosen'] . ' berhasil ditambahkan!');
    }

    // EDIT 
    public function edit(string $nidn) 
    { 
        // Mencari Dosen berdasarkan NIDN, jika tidak ada akan throw 404
        $dosen = Dosen::where('nidn', $nidn)->firstOrFail();
        return view('admin.dosen.edit', compact('dosen')); 
    }
    
    /**
     * Memperbarui data Dosen di database. (Update)
     */
    public function update(Request $request, string $nidn) 
    { 
        // Cari data Dosen yang akan diupdate
        $dosen = Dosen::where('nidn', $nidn)->firstOrFail();

        // Validasi data. Gunakan Rule::unique untuk mengabaikan NIDN dan Email dosen itu sendiri
        $validatedData = $request->validate([
            'nidn' => ['required', 'string', 'max:10', 'min:5', Rule::unique('dosens', 'nidn')->ignore($dosen->id)],
            'nama_dosen' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('dosens', 'email')->ignore($dosen->id)],
            'gelar' => ['nullable', 'string', 'max:100'],
        ]);
        
        // Update data
        $dosen->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen ' . $validatedData['nama_dosen'] . ' berhasil diperbarui!');
    }
    
    /**
     * Menghapus data Dosen dari database. (Destroy)
     */
    public function destroy(string $nidn) 
    { 
        // Cari data Dosen yang akan dihapus
        $dosen = Dosen::where('nidn', $nidn)->firstOrFail();
        $nama_dosen = $dosen->nama_dosen;
        
        // Hapus data
        $dosen->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen ' . $nama_dosen . ' berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliah; // Sesuaikan dengan nama model Anda

class MataKuliahController extends Controller
{
    /**
     * Menampilkan daftar semua Mata Kuliah. (READ - Index)
     */
    public function index()
    {
        $matkuls = MataKuliah::all();
        return view('admin.matkul.index', compact('matkuls'));
    }

    /**
     * Menampilkan form untuk membuat Mata Kuliah baru. (CREATE - Form)
     */
    public function create()
    {
        return view('admin.matkul.create');
    }

    /**
     * Menyimpan Mata Kuliah baru ke database. (CREATE - Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs|max:10', // Sesuaikan nama tabel jika berbeda
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
        ], [
            'kode_mk.unique' => 'Kode Mata Kuliah sudah terdaftar.',
            'required' => ':attribute wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
        ]);

        // 2. Simpan ke Database
        MataKuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
        ]);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit Mata Kuliah tertentu. (UPDATE - Form)
     * Ini adalah metode KRITIS agar form edit berfungsi.
     */
    public function edit(MataKuliah $matkul) // Menggunakan Route Model Binding
    {
        return view('admin.matkul.edit', compact('matkul'));
    }

    /**
     * Memperbarui Mata Kuliah di database. (UPDATE - Logic)
     * Ini adalah metode KRITIS agar update berfungsi.
     */
    public function update(Request $request, MataKuliah $matkul) // Menggunakan Route Model Binding
    {
        // 1. Validasi Data (kode_mk harus unik, kecuali untuk dirinya sendiri)
        $request->validate([
            'kode_mk' => 'required|max:10|unique:mata_kuliahs,kode_mk,' . $matkul->id,
            'nama_mk' => 'required|max:100',
            'sks' => 'required|integer|min:1|max:6',
        ], [
            'kode_mk.unique' => 'Kode Mata Kuliah sudah terdaftar.',
            'required' => ':attribute wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
        ]);

        // 2. Perbarui Data
        $matkul->update([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
        ]);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('admin.matkul.index')->with('success', 'Mata Kuliah berhasil diperbarui!');
    }

    /**
     * Menghapus Mata Kuliah dari database. (DELETE)
     */
    public function destroy(MataKuliah $matkul) // Menggunakan Route Model Binding
    {
        // Simpan nama/kode untuk pesan feedback
        $kode_mk = $matkul->kode_mk;
        
        // Hapus data
        $matkul->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.matkul.index')->with('success', "Mata Kuliah [$kode_mk] berhasil dihapus!");
    }
}
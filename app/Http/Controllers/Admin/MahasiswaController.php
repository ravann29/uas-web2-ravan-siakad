<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage; // Penting untuk urusan hapus file

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa dengan fitur search
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'mahasiswa')->with('programStudi');

        // Fitur Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $mahasiswas = $query->latest()->get();

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Form tambah mahasiswa
     */
    public function create()
    {
        $program_studi = ProgramStudi::all();
        return view('admin.mahasiswa.create', compact('program_studi'));
    }

    /**
     * Simpan data mahasiswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'              => 'required|string|max:20|unique:users,nim',
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->nim); // Default password adalah NIM
        $data['role']     = 'mahasiswa';

        // Logika Upload Foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $request->nim . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photos', $filename);
            $data['photo'] = $filename;
        }

        User::create($data);

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Mahasiswa baru berhasil ditambahkan.');
    }

    /**
     * Form edit mahasiswa
     */
    public function edit($id)
    {
        $mahasiswa = User::findOrFail($id);
        $program_studi = ProgramStudi::all(); 

        return view('admin.mahasiswa.edit', compact('mahasiswa', 'program_studi'));
    }

    /**
     * Update data mahasiswa
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = User::findOrFail($id);

        $request->validate([
            'nim'              => 'required|string|max:20|unique:users,nim,' . $id,
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $id,
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $data = [
            'nim'              => $request->nim,
            'name'             => $request->name,
            'email'            => $request->email,
            'program_studi_id' => $request->program_studi_id,
        ];

        // Logika Update Foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->photo) {
                Storage::delete('public/photos/' . $mahasiswa->photo);
            }

            // Upload foto baru
            $file = $request->file('photo');
            $filename = $request->nim . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photos', $filename);
            $data['photo'] = $filename;
        }

        $mahasiswa->update($data);

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa ' . $mahasiswa->name . ' berhasil diperbarui.');
    }

    /**
     * Hapus data mahasiswa
     */
    public function destroy($id)
    {
        $mahasiswa = User::findOrFail($id);

        // Hapus foto dari storage sebelum hapus data dari DB
        if ($mahasiswa->photo) {
            Storage::delete('public/photos/' . $mahasiswa->photo);
        }

        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    /**
     * Export & Import Excel
     */
    public function export() 
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function import(Request $request) 
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        Excel::import(new MahasiswaImport, $request->file('file'));
        
        return back()->with('success', 'Data mahasiswa berhasil diimport!');
    }
}
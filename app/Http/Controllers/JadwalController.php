<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataKuliah; 
use App\Models\Dosen;
use App\Models\Ruang; 
use App\Models\Shift;
use App\Models\TahunAjar; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load semua relasi dengan eager loading
        $jadwalData = Jadwal::with(['mataKuliah', 'dosen', 'ruangan', 'shift', 'tahunAjar']) 
            ->whereHas('shift') // Pastikan hanya ambil yang punya shift
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')") // Urutan hari yang benar
            ->orderBy('shift_id')
            ->get();
        
        // Ambil shifts dengan urutan yang benar
        $shifts = Shift::orderBy('id')->pluck('nama_shift')->toArray();
        
        // Ambil tahun ajar aktif
        $tahunAjarAktif = TahunAjar::where('aktif', 1)->first() ?? TahunAjar::first();
        $tahunAjarNama = $tahunAjarAktif ? $tahunAjarAktif->nama_tahun : 'Tahun Akademik Belum Ditetapkan';

        // Grouping dengan pengecekan null
        $jadwals = $jadwalData->groupBy('hari')->map(function ($itemsByDay) {
            return $itemsByDay->groupBy(function ($item) {
                return $item->shift ? $item->shift->nama_shift : 'Tanpa Shift';
            });
        });
        
        return view('jadwal.index', compact('jadwals', 'shifts', 'tahunAjarNama'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matkuls = MataKuliah::all();
        $dosens = Dosen::all();
        $ruangans = Ruang::all(); 
        $shifts = Shift::all();
        $tahunAjars = TahunAjar::all(); 
        
        return view('admin.jadwal.create', compact('matkuls', 'dosens', 'ruangans', 'shifts', 'tahunAjars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:dosens,id',
            'ruang_id' => 'required|exists:ruang,id',
            'shift_id' => 'required|exists:shifts,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'tahun_ajar_id' => 'required|exists:tahun_ajar,id',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
        ]);

        Jadwal::create($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        $jadwal->load(['mataKuliah', 'dosen', 'ruangan', 'shift', 'tahunAjar']); 
        return view('admin.jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $jadwal->load(['mataKuliah', 'dosen', 'ruangan', 'shift', 'tahunAjar']); 

        $matkuls = MataKuliah::all();
        $dosens = Dosen::all();
        $ruangans = Ruang::all();
        $shifts = Shift::all();
        $tahunAjars = TahunAjar::all();
        
        return view('admin.jadwal.edit', compact('jadwal', 'matkuls', 'dosens', 'ruangans', 'shifts', 'tahunAjars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:dosens,id',
            'ruang_id' => 'required|exists:ruang,id',
            'shift_id' => 'required|exists:shifts,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'tahun_ajar_id' => 'required|exists:tahun_ajar,id',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
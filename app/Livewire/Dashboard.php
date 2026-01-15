<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\ProgramStudi;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
        // Mengambil data prodi beserta jumlah mahasiswanya
        $prodiData = ProgramStudi::withCount('mahasiswa')->get();

        return view('livewire.dashboard', [
            'labels' => $prodiData->pluck('nama_prodi'), // Contoh: ['TI', 'SI']
            'values' => $prodiData->pluck('mahasiswa_count'), // Contoh: [120, 90]
            'totalMahasiswa' => User::where('role', 'mahasiswa')->count(),
        ]);

        date_default_timezone_set('Asia/Jakarta'); 
    
    return view('livewire.dashboard', [
        'labels' => ProgramStudi::pluck('nama_prodi'),
        'values' => ProgramStudi::withCount('mahasiswa')->pluck('mahasiswa_count'),
        'totalMahasiswa' => User::where('role', 'mahasiswa')->count(),
    ]);

    $prodi = \App\Models\ProgramStudi::withCount('mahasiswa')->get();

    return view('livewire.dashboard', [
        'labels' => $prodi->pluck('nama_prodi'),
        'values' => $prodi->pluck('mahasiswa_count'),
        'totalMahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
    ]);

    return view('livewire.dashboard', [
        'labels' => \App\Models\ProgramStudi::pluck('nama_prodi'),
        'values' => \App\Models\ProgramStudi::withCount('mahasiswa')->pluck('mahasiswa_count'),
        'totalMahasiswa' => \App\Models\User::where('role', 'mahasiswa')->count(),
    ]);
    }
}
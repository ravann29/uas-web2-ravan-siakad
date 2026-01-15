<?php
namespace App\Livewire;

use App\Models\User; // Ubah dari Mahasiswa ke User
use App\Models\ProgramStudi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class MahasiswaTable extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterProdi = '';
    public $fileImport;


    public function store()
{
    // ... proses simpan data ...
    $mhs = User::create();

    // Kirim notifikasi ke dashboard
    $this->dispatch('studentAdded', name: $mhs->name)->to(Dashboard::class);
    
    session()->flash('success', 'Mahasiswa berhasil ditambahkan.');
}
    public function printKTM($id)
{
    $mahasiswa = User::with('programStudi')->findOrFail($id);
    $pdf = Pdf::loadView('pdf.ktm', ['mhs' => $mahasiswa]);

    // Ukuran kartu standar (ISO 7810 ID-1) dalam milimeter dikonversi ke Points
    // 86mm x 54mm
    $pdf->setPaper([0, 0, 243.78, 153.07], 'portrait');

    return response()->streamDownload(function () use ($pdf) {
        echo $pdf->output();
    }, 'KTM-' . $mahasiswa->nim . '.pdf');
}

public function cetakKtm($id)
{
    $mahasiswa = \App\Models\User::findOrFail($id); // Sesuaikan model Anda
    
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.mahasiswa.cetak-ktm', compact('mahasiswa'));
    return $pdf->stream('KTM-' . $mahasiswa->nim . '.pdf');
}

    public function updatingSearch() { $this->resetPage(); }

    public function render()
{
    $user = \App\Models\User::query() 
        ->where('role', 'mahasiswa')
        ->when($this->search, function($query) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('nim', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->filterProdi, function($query) {
            $query->where('program_studi_id', $this->filterProdi);
        })
        ->with('programStudi')
        ->latest()
        ->paginate(10);

    return view('livewire.mahasiswa-table', [
        'mahasiswa' => $user, // Dikirim ke view dengan nama 'mahasiswas'
        'program_studi' => \App\Models\ProgramStudi::all()
    ]);
}

        public function deleteMahasiswa($id)
{
    // Cari data user (mahasiswa) berdasarkan ID
    $user = \App\Models\User::findOrFail($id);
    
    // Hapus foto dari storage jika ada
    if ($user->photo) {
        \Storage::disk('public')->delete($user->photo);
    }

    // Hapus data dari database
    $user->delete();

    // Opsional: Tambahkan notifikasi flash
    session()->flash('message', 'Data mahasiswa berhasil dihapus.');
}

public function import()
    {
        $this->validate([
            'fileImport' => 'required|mimes:xlsx,csv,xls|max:2048',
        ]);

        try {
            Excel::import(new MahasiswaImport, $this->fileImport);
            session()->flash('success', 'Data mahasiswa berhasil diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Baris " . $failure->row() . ": " . $failure->errors()[0];
            }
            session()->flash('import_errors', $errors);
        }

        $this->fileImport = null;
    }

    public function export()
    {
        // Contoh export sederhana langsung download
        return Excel::download(new MahasiswaExport, 'daftar-mahasiswa.xlsx');
    }

    
}
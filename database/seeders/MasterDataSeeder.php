<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Shift;
use App\Models\StatusMk;
use App\Models\TahunAjar;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        // 1. Status Mata Kuliah
        StatusMk::firstOrCreate(['nama_status' => 'Wajib']);
        StatusMk::firstOrCreate(['nama_status' => 'Pilihan']);

        
        // 2. Ruang
        Ruang::firstOrCreate(['nama_ruang' => 'Lab Jaringan', 'kapasitas' => '40']);
        Ruang::firstOrCreate(['nama_ruang' => 'A203', 'kapasitas' => '50']);
        Ruang::firstOrCreate(['nama_ruang' => 'A204', 'kapasitas' => '50']);
        Ruang::firstOrCreate(['nama_ruang' => 'A209', 'kapasitas' => '50']);
        Ruang::firstOrCreate(['nama_ruang' => 'A210', 'kapasitas' => '50']);
        Ruang::firstOrCreate(['nama_ruang' => 'A211', 'kapasitas' => '50']);
        Ruang::firstOrCreate(['nama_ruang' => 'B301', 'kapasitas' => '40']);
        Ruang::firstOrCreate(['nama_ruang' => 'B302', 'kapasitas' => '40']);
        Ruang::firstOrCreate(['nama_ruang' => 'B303', 'kapasitas' => '40']);


// 3. Dosen (Diperbaiki: Menambahkan NIDN unik dan Email)
Dosen::updateOrCreate([
    'nidn' => '0412038701', // NIDN Unik 1
    'nama_dosen' => 'Dr. Jajang Suherman', 
    'gelar' => 'M.A.B',
    'email' => 'jajang.suherman@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0415108003', // NIDN Unik 2
    'nama_dosen' => 'Badriyatul Huda', 
    'gelar' => 'S.E., M.M',
    'email' => 'badriyatul.huda@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0420017101', // NIDN Unik 3
    'nama_dosen' => 'Ir. Raden Heruandjaman', 
    'gelar' => '',
    'email' => 'raden.heruandjaman@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0411078502', // NIDN Unik 4
    'nama_dosen' => 'M. Fahmi Nugraha', 
    'gelar' => 'M.Kom',
    'email' => 'fahmi.nugraha@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0422057904', // NIDN Unik 5
    'nama_dosen' => 'Ayi Miftazul Mu’minin', 
    'gelar' => 'S.Kom., M.M',
    'email' => 'ayi.miftazul@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0417086801', // NIDN Unik 6
    'nama_dosen' => 'Ida Rapida, Dr.', 
    'gelar' => 'S.E., M.M',
    'email' => 'ida.rapida.dr@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0403067802', // NIDN Unik 7
    'nama_dosen' => 'Bambang Irawan', 
    'gelar' => 'S.S',
    'email' => 'bambang.irawan@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0428027705', // NIDN Unik 8
    'nama_dosen' => 'Dr. Latifah Wulandari', 
    'gelar' => 'S.E., M.M',
    'email' => 'latifah.wulandari@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0419047903', // NIDN Unik 9
    'nama_dosen' => 'M. Prakarsa', 
    'gelar' => 'S.T., M.Kom',
    'email' => 'm.prakarsa@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0425097402', // NIDN Unik 10
    'nama_dosen' => 'Utami Aryanti', 
    'gelar' => 'M.Kom',
    'email' => 'utami.aryanti@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0401116601', // NIDN Unik 11
    'nama_dosen' => 'Yelly A.M.S.', 
    'gelar' => 'Dra., M.Pd.',
    'email' => 'yelly.ams@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0410028104', // NIDN Unik 12
    'nama_dosen' => 'Sofia Dewi', 
    'gelar' => 'S.T., M.Kom',
    'email' => 'sofia.dewi@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0405078401', // NIDN Unik 13
    'nama_dosen' => 'Ricky Rohmanto', 
    'gelar' => 'M.Kom',
    'email' => 'ricky.rohmanto@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0417086802', // NIDN Unik 14 (Berbeda dengan no. 6)
    'nama_dosen' => 'Ida Rapida', 
    'gelar' => 'Dra., M.M',
    'email' => 'ida.rapida@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0420047303', // NIDN Unik 15
    'nama_dosen' => 'Miftahul Imtinah', 
    'gelar' => 'M.Ag',
    'email' => 'miftahul.imtinah@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0422057905', // NIDN Unik 16 (Berbeda dengan no. 5)
    'nama_dosen' => 'Ayi Mi\'razul Mu\'minin', 
    'gelar' => 'S.Kom., M.M',
    'email' => 'ayi.mirazul@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0413038601', // NIDN Unik 17
    'nama_dosen' => 'Hasti Pramesti Kusnara', 
    'gelar' => 'S.E., M.M',
    'email' => 'hasti.kusnara@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0425118702', // NIDN Unik 18
    'nama_dosen' => 'Iin', 
    'gelar' => 'M.Kom',
    'email' => 'iin@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0401017503', // NIDN Unik 19
    'nama_dosen' => 'M. Furqon', 
    'gelar' => 'M.Kom',
    'email' => 'm.furqon@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0428056001', // NIDN Unik 20
    'nama_dosen' => 'Dr. H. Sugiyanto', 
    'gelar' => 'SE., M.Sc',
    'email' => 'h.sugiyanto@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0402097702', // NIDN Unik 21
    'nama_dosen' => 'Tedi Budiman', 
    'gelar' => 'S.Si., M.Kom',
    'email' => 'tedi.budiman@univ.ac.id'
]);
Dosen::updateOrCreate([
    'nidn' => '0401116602', // NIDN Unik 22 (Berbeda dengan no. 11)
    'nama_dosen' => 'Yelly A.M. Salam', 
    'gelar' => 'Dra., M.M',
    'email' => 'yelly.salam@univ.ac.id'
]);

        
        // 4. Tahun Ajar
        TahunAjar::updateOrCreate(['nama_tahun' => 'SEMESTER GANJIL 2025/2026', 'aktif' => true]);
        
        // 5. Shift/Kelas
        Shift::updateOrCreate(['nama_shift' => 'S1 SI']);
        Shift::updateOrCreate(['nama_shift' => 'D3 KA']);
        Shift::updateOrCreate(['nama_shift' => 'S1 BD / A']);
        Shift::updateOrCreate(['nama_shift' => 'S1 BD / B']);

        // 6. Mata Kuliah (kode dan SKS diasumsikan)
        $wajibId = StatusMk::where('nama_status', 'Wajib')->first()->id;

        MataKuliah::updateOrCreate(['kode_mk' => 'SI301', 'nama_mk' => 'Analisa Proses Bisnis', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI302', 'nama_mk' => 'Instalasi Komputer dan Jaringan', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI303', 'nama_mk' => 'Bahasa Inggris II (For Business)', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'KA301', 'nama_mk' => 'Perpajakan', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'KA302', 'nama_mk' => 'Kewirausahaan', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'KA303', 'nama_mk' => 'Akuntansi Keuangan', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD301', 'nama_mk' => 'KPAM III (Etika Perkantoran)', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD302', 'nama_mk' => 'Pemrograman Web', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD303', 'nama_mk' => 'Studi Kelayakan Bisnis', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI304', 'nama_mk' => 'Pemrograman Java', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI305', 'nama_mk' => 'PL/SQL (Pemrog. Database)', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD304', 'nama_mk' => 'Pendidikan Kewarganegaraan', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD305', 'nama_mk' => 'Riset Teknologi Informasi', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD306', 'nama_mk' => 'Sistem Multimedia (Movie Maker)', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI306', 'nama_mk' => 'Pendidikan Agama Islam II', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'KA304', 'nama_mk' => 'Manajemen Bisnis (E-Business)', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI307', 'nama_mk' => 'Pemrograman WEB 2', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'KA305', 'nama_mk' => 'Sistem Informasi Manajemen (lanj.)', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD307', 'nama_mk' => 'E-Business (Digital Marketing)', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'BD308', 'nama_mk' => 'Sistem Basis Data', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'KA306', 'nama_mk' => 'Akuntansi Biaya', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI308', 'nama_mk' => 'Perilaku Organisasi', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'KA307', 'nama_mk' => 'Pemrograman WEB 1', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI309', 'nama_mk' => 'Pendidikan Anti Korupsi', 'sks' => 2, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'SI310', 'nama_mk' => 'Sistem Informasi Manajemen', 'sks' => 3, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'AGAMA', 'nama_mk' => 'Shalat Dzuhur', 'sks' => 0, 'status_mk_id' => $wajibId]);
        MataKuliah::updateOrCreate(['kode_mk' => 'AGAMA2', 'nama_mk' => 'Shalat Jumat', 'sks' => 0, 'status_mk_id' => $wajibId]);


    }
}
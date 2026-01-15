<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Shift;
use App\Models\TahunAjar;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil ID Master Data
        $tahunAjarId = TahunAjar::where('aktif', true)->first()->id;

        // Shift
        $shiftSI = Shift::where('nama_shift', 'S1 SI')->first()->id;
        $shiftKA = Shift::where('nama_shift', 'D3 KA')->first()->id;
        $shiftBDA = Shift::where('nama_shift', 'S1 BD / A')->first()->id;
        $shiftBDB = Shift::where('nama_shift', 'S1 BD / B')->first()->id;

        // Ruang
        $rLabJaringan = Ruang::where('nama_ruang', 'Lab Jaringan')->first()->id;
        $rA203 = Ruang::where('nama_ruang', 'A203')->first()->id;
        $rA204 = Ruang::where('nama_ruang', 'A204')->first()->id;
        $rA209 = Ruang::where('nama_ruang', 'A209')->first()->id;
        $rA210 = Ruang::where('nama_ruang', 'A210')->first()->id;
        $rA211 = Ruang::where('nama_ruang', 'A211')->first()->id;
        $rB301 = Ruang::where('nama_ruang', 'B301')->first()->id;
        $rB302 = Ruang::where('nama_ruang', 'B302')->first()->id;
        $rB303 = Ruang::where('nama_ruang', 'B303')->first()->id;
        $rA203A204 = Ruang::where('nama_ruang', 'A203')->first()->id; // Digunakan A203/A204

        // Dosen (Dibuat array untuk lookup)
        $dosen = Dosen::pluck('id', 'nama_dosen')->toArray();
        
        // Mata Kuliah (Dibuat array untuk lookup)
        $mk = MataKuliah::pluck('id', 'nama_mk')->toArray();


        // Fungsi helper untuk insert jadwal
        $insertJadwal = function ($hari, $mulai, $selesai, $mkName, $dosenName, $ruangName, $shiftId, $keterangan = null) use ($tahunAjarId, $mk, $dosen, $rLabJaringan, $rA203, $rA204, $rA209, $rA210, $rA211, $rB301, $rB302, $rB303, $rA203A204) {
            $ruangMap = [
                'Lab Jaringan' => $rLabJaringan,
                'A203' => $rA203,
                'A204' => $rA204,
                'A209' => $rA209,
                'A210' => $rA210,
                'A211' => $rA211,
                'B301' => $rB301,
                'B302' => $rB302,
                'B303' => $rB303,
                'A203-A204' => $rA203A204 // Menggunakan ID Ruang terdekat jika gabungan
            ];

            Jadwal::create([
                'hari' => $hari,
                'waktu_mulai' => $mulai,
                'waktu_selesai' => $selesai,
                'mata_kuliah_id' => $mk[$mkName] ?? null,
                'dosen_id' => $dosen[$dosenName] ?? null,
                'ruang_id' => $ruangMap[$ruangName] ?? null,
                'shift_id' => $shiftId,
                'tahun_ajar_id' => $tahunAjarId,
                'keterangan' => $keterangan,
            ]);
        };


        // --- DATA LENGKAP JADWAL ---

        // ========================== SENIN ==========================
        
        // S1 SI
        $insertJadwal('SENIN', '07.30', '10.00', 'Analisa Proses Bisnis', 'Dr. Jajang Suherman', 'Lab Jaringan', $shiftSI);
        $insertJadwal('SENIN', '10.10', '11.50', 'Instalasi Komputer dan Jaringan', 'Ayi Miftazul Mu’minin', 'Lab Jaringan', $shiftSI);
        $insertJadwal('SENIN', '13.00', '14.40', 'Bahasa Inggris II (For Business)', 'Bambang Irawan', 'Lab Jaringan', $shiftSI);
        
        // D3 KA
        $insertJadwal('SENIN', '08.30', '10.10', 'Perpajakan', 'Badriyatul Huda', 'A203', $shiftKA);
        $insertJadwal('SENIN', '10.10', '11.50', 'Kewirausahaan', 'Ida Rapida, Dr.', 'A210', $shiftKA);
        $insertJadwal('SENIN', '12.30', '13.20', 'Akuntansi Keuangan', 'Dr. Latifah Wulandari', 'A210', $shiftKA);

        // S1 BD / A
        $insertJadwal('SENIN', '09.10', '10.10', 'KPAM III (Etika Perkantoran)', 'Dr. Raden Heruandjaman', 'A209', $shiftBDA);
        $insertJadwal('SENIN', '10.10', '11.00', 'Pemrograman Web', 'M. Fahmi Nugraha', 'B303', $shiftBDA);
        $insertJadwal('SENIN', '12.30', '13.20', 'Pemrograman Web', 'M. Fahmi Nugraha', 'B303', $shiftBDA);

        // S1 BD / B
        $insertJadwal('SENIN', '07.30', '10.00', 'Pemrograman Web', 'M. Fahmi Nugraha', 'B303', $shiftBDB);
        $insertJadwal('SENIN', '10.10', '11.00', 'KPAM III (Etika Perkantoran)', 'Dr. Raden Heruandjaman', 'A209', $shiftBDB);
        $insertJadwal('SENIN', '13.00', '14.40', 'Studi Kelayakan Bisnis', 'Dr. Jajang Suherman', 'A209', $shiftBDB);
        
        // SHALAT DZUHUR SENIN
        $insertJadwal('SENIN', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftSI, 'Shalat Dzuhur');
        $insertJadwal('SENIN', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftKA, 'Shalat Dzuhur');
        $insertJadwal('SENIN', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDA, 'Shalat Dzuhur');
        $insertJadwal('SENIN', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDB, 'Shalat Dzuhur');


        // ========================== SELASA ==========================

        // S1 SI
        $insertJadwal('SELASA', '07.30', '10.00', 'Pemrograman Java', 'M. Prakarsa', 'B301', $shiftSI);
        $insertJadwal('SELASA', '10.10', '11.50', 'PL/SQL (Pemrog. Database)', 'Utami Aryanti', 'B301', $shiftSI);
        $insertJadwal('SELASA', '12.30', '13.20', 'PL/SQL (Pemrog. Database)', 'Utami Aryanti', 'B301', $shiftSI);
        
        // D3 KA
        // Baris D3 KA kosong (diabaikan)
        $insertJadwal('SELASA', '13.00', '15.00', 'KPAM III (Etika Perkantoran)', 'Ida Rapida', 'A203', $shiftKA);

        // S1 BD / A
        $insertJadwal('SELASA', '08.20', '10.00', 'Pendidikan Kewarganegaraan', 'Yelly A.M.S.', 'A204', $shiftBDA);
        $insertJadwal('SELASA', '10.10', '11.50', 'Studi Kelayakan Bisnis', 'Dr. Jajang Suherman', 'A204', $shiftBDA);
        $insertJadwal('SELASA', '12.30', '13.20', 'Riset Teknologi Informasi', 'Sofia Dewi', 'A204', $shiftBDA);

        // S1 BD / B
        $insertJadwal('SELASA', '07.30', '10.00', 'Riset Teknologi Informasi', 'Sofia Dewi', 'A211', $shiftBDB);
        $insertJadwal('SELASA', '10.10', '11.50', 'Sistem Multimedia (Movie Maker)', 'Ricky Rohmanto', 'B303', $shiftBDB);
        $insertJadwal('SELASA', '12.30', '13.20', 'Sistem Multimedia (Movie Maker)', 'Ricky Rohmanto', 'B303', $shiftBDB);
        
        // SHALAT DZUHUR SELASA
        $insertJadwal('SELASA', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftSI, 'Shalat Dzuhur');
        $insertJadwal('SELASA', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftKA, 'Shalat Dzuhur');
        $insertJadwal('SELASA', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDA, 'Shalat Dzuhur');
        $insertJadwal('SELASA', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDB, 'Shalat Dzuhur');


        // ========================== RABU ==========================

        // S1 SI
        $insertJadwal('RABU', '07.30', '09.10', 'Pendidikan Agama Islam II', 'Miftahul Imtinah', 'A209', $shiftSI);
        $insertJadwal('RABU', '09.20', '10.10', 'KPAM III (Etika Perkantoran)', 'Ida Rapida', 'A209', $shiftSI);
        $insertJadwal('RABU', '10.20', '12.00', 'Pemrograman WEB 2', 'Iin', 'B302', $shiftSI);
        $insertJadwal('RABU', '12.30', '13.20', 'Pemrograman WEB 2', 'Iin', 'B302', $shiftSI);
        
        // D3 KA
        $insertJadwal('RABU', '07.30', '10.00', 'Manajemen Bisnis (E-Business)', 'Ayi Mi\'razul Mu\'minin', 'A210', $shiftKA);
        $insertJadwal('RABU', '10.10', '11.50', 'Sistem Informasi Manajemen', 'M. Furqon', 'A210', $shiftKA);
        $insertJadwal('RABU', '12.30', '13.20', 'Sistem Informasi Manajemen (lanj.)', 'M. Furqon', 'A210', $shiftKA);

        // S1 BD / A
        $insertJadwal('RABU', '07.30', '10.00', 'E-Business (Digital Marketing)', 'Hasti Pramesti Kusnara', 'Lab Jaringan', $shiftBDA);
        $insertJadwal('RABU', '10.10', '11.50', 'Sistem Basis Data', 'Utami Aryanti', 'B301', $shiftBDA);

        // S1 BD / B
        $insertJadwal('RABU', '07.30', '10.00', 'Sistem Basis Data', 'Utami Aryanti', 'B302', $shiftBDB);
        $insertJadwal('RABU', '10.10', '11.50', 'E-Business (Digital Marketing)', 'Hasti Pramesti Kusnara', 'Lab Jaringan', $shiftBDB);
        
        // SHALAT DZUHUR RABU
        $insertJadwal('RABU', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftSI, 'Shalat Dzuhur');
        $insertJadwal('RABU', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftKA, 'Shalat Dzuhur');
        $insertJadwal('RABU', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDA, 'Shalat Dzuhur');
        $insertJadwal('RABU', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDB, 'Shalat Dzuhur');


        // ========================== KAMIS ==========================

        // S1 SI
        $insertJadwal('KAMIS', '10.10', '11.50', 'Sistem Informasi Manajemen', 'M. Furqon', 'A204', $shiftSI);
        $insertJadwal('KAMIS', '12.30', '13.10', 'Sistem Informasi Manajemen', 'M. Furqon', 'A204', $shiftSI);
        $insertJadwal('KAMIS', '13.20', '15.10', 'Perilaku Organisasi', 'Ida Rapida', 'A204', $shiftSI);
        $insertJadwal('KAMIS', '15.20', '17.00', 'Pendidikan Anti Korupsi', 'Yelly A.M. Salam', 'A204', $shiftSI);
        
        // D3 KA
        $insertJadwal('KAMIS', '07.30', '10.00', 'Akuntansi Biaya', 'Dr. H. Sugiyanto', 'A204', $shiftKA);
        $insertJadwal('KAMIS', '13.30', '16.00', 'Pemrograman WEB 1', 'Tedi Budiman', 'B301', $shiftKA);

        // S1 BD / A & S1 BD / B
        // Kosong di jam pagi
        
        // SHALAT DZUHUR KAMIS
        $insertJadwal('KAMIS', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftSI, 'Shalat Dzuhur');
        $insertJadwal('KAMIS', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftKA, 'Shalat Dzuhur');
        $insertJadwal('KAMIS', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDA, 'Shalat Dzuhur');
        $insertJadwal('KAMIS', '12.00', '12.30', 'Shalat Dzuhur', null, '-', $shiftBDB, 'Shalat Dzuhur');


        // ========================== JUMAT ==========================
        
        // D3 KA
        // Kosong di jam pagi
        
        // S1 BD / A
        $insertJadwal('JUMAT', '07.30', '10.00', 'Akuntansi Biaya', 'Dr. H. Sugiyanto', 'A203-A204', $shiftBDA);
        $insertJadwal('JUMAT', '13.00', '15.30', 'Sistem Multimedia (Movie Maker)', 'Ricky Rohmanto', 'B302', $shiftBDA);

        // S1 BD / B
        $insertJadwal('JUMAT', '07.30', '10.00', 'Akuntansi Biaya', 'Dr. H. Sugiyanto', 'A203-A204', $shiftBDB);
        $insertJadwal('JUMAT', '13.00', '15.30', 'Sistem Multimedia (Movie Maker)', 'Ricky Rohmanto', 'B302', $shiftBDB);
        
        // SHALAT JUMAT
        $insertJadwal('JUMAT', '11.10', '13.00', 'Shalat Jumat', null, '-', $shiftSI, 'Shalat Jumat');
        $insertJadwal('JUMAT', '11.10', '13.00', 'Shalat Jumat', null, '-', $shiftKA, 'Shalat Jumat');
        $insertJadwal('JUMAT', '11.10', '13.00', 'Shalat Jumat', null, '-', $shiftBDA, 'Shalat Jumat');
        $insertJadwal('JUMAT', '11.10', '13.00', 'Shalat Jumat', null, '-', $shiftBDB, 'Shalat Jumat');
    }
}
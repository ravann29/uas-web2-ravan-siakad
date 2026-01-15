<div class="space-y-8"> {{-- Container utama dengan jarak vertikal antar baris --}}

    {{-- BARIS 1: GRAFIK, JAM, DAN TOTAL --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Statistik (Lebar 2 kolom pada layar besar) --}}
        <div class="lg:col-span-2 glass-card p-6 shadow-sm border border-gray-100">
            <h3 class="font-bold mb-4 text-gray-700 flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>
                Statistik Mahasiswa
            </h3>
            <div style="height: 300px;" wire:ignore>
                <canvas id="permanentChart"></canvas>
            </div>
        </div>

        {{-- Waktu & Total (Dihimpit ke 1 kolom) --}}
        <div class="flex flex-col gap-6">
            {{-- Card Jam --}}
            <div class="glass-card text-center py-8 px-6 shadow-sm border border-gray-100" wire:poll.1s>
                <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-2">Waktu Lokal</h3>
                <div class="text-4xl font-mono font-black text-gray-800">
                    {{ now()->format('H:i:s') }}
                </div>
                <p class="text-gray-400 text-sm mt-1">{{ now()->format('d M Y') }}</p>
            </div>

            {{-- Card Total --}}
            <div class="glass-card text-center py-8 px-6 shadow-sm border border-gray-100">
                <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-2">Total Mahasiswa</h3>
                <div class="text-5xl font-black text-orange-500">
                    {{ $totalMahasiswa }}
                </div>
                <p class="text-gray-400 text-xs mt-2 italic">Data Terupdate</p>
            </div>
        </div>
    </div>

    {{-- BARIS 2: MENU NAVIGASI (Sesuai gambar Anda) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- Kolom Input --}}
        <div class="glass-card p-6 shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-3 border-b pb-3 text-sm uppercase tracking-wide">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Input Data Cepat
            </h3>
            <div class="space-y-3">
                <a href="{{ route('admin.jadwal.create') }}" class="nav-card group">
                    <div class="icon-box group-hover:bg-orange-500 group-hover:text-white transition-all">+</div>
                    <span class="font-medium">Tambah Jadwal Kuliah</span>
                </a>
                <a href="{{ route('admin.dosen.create') }}" class="nav-card group">
                    <div class="icon-box group-hover:bg-orange-500 group-hover:text-white transition-all">+</div>
                    <span class="font-medium">Tambah Data Dosen</span>
                </a>
                <a href="{{ route('admin.matkul.create') }}" class="nav-card group">
                    <div class="icon-box group-hover:bg-orange-500 group-hover:text-white transition-all">+</div>
                    <span class="font-medium">Tambah Mata Kuliah</span>
                </a>
            </div>
        </div>

        {{-- Kolom Manajemen --}}
        <div class="glass-card p-6 shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-3 border-b pb-3 text-sm uppercase tracking-wide">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                Manajemen Database
            </h3>
            <div class="space-y-3">
                <a href="{{ route('admin.mahasiswa.index') }}" class="nav-card group">
                    <div class="icon-box group-hover:bg-orange-500 group-hover:text-white transition-all text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <span class="font-medium">Data Mahasiswa</span>
                </a>
                <a href="{{ route('admin.jadwal.index') }}" class="nav-card group">
                    <div class="icon-box group-hover:bg-orange-500 group-hover:text-white transition-all text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="font-medium">Jadwal Kuliah</span>
                </a>
                <a href="{{ route('admin.dosen.index') }}" class="nav-card group">
                    <div class="icon-box group-hover:bg-orange-500 group-hover:text-white transition-all text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-medium">Data Dosen</span>
                </a>
            </div>
        </div>

    </div>
</div>

{{-- SCRIPT TETAP DI BAWAH --}}
<script>
    document.addEventListener('livewire:initialized', () => {
        let chartInstance = null;
        const renderChart = () => {
            const ctx = document.getElementById('permanentChart');
            if (!ctx) return;
            if (chartInstance) { chartInstance.destroy(); }

            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @js($labels),
                    datasets: [{
                        label: 'Mahasiswa per Prodi',
                        data: @js($values),
                        backgroundColor: '#F39C12',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: true
                }
            });
        };
        renderChart();
        Livewire.on('refreshChart', () => { renderChart(); });
    });
</script>
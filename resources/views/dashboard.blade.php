<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Mahasiswa | Sistem Akademik</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CSS Konsistensi */
        .header { background-color: #333; color: white; padding: 1rem 0; border-bottom: 5px solid #F39C12; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: space-between; align-items: center; }
        .nav-links a { color: white; padding: 0.5rem 1rem; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .nav-links a:hover { color: #F39C12; }
        .content-area { padding: 3rem 1rem; min-height: calc(100vh - 60px); background-color: #f0f0f0; }
        html { scroll-behavior: smooth; }
        
        /* CSS Dropdown */
        .dropdown { position: relative; display: inline-block; margin-left: 1rem; }
        .dropdown-toggle { padding: 0.5rem 1rem; text-decoration: none !important; font-weight: 600; cursor: pointer; white-space: nowrap; background-color: transparent !important; color: white !important; font-size: 0.95em; }
        .dropdown-toggle:hover { color: #F39C12 !important; }
        .dropdown-menu { display: none; position: absolute; right: 0; top: 100%; background-color: #333; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 4px; z-index: 1000; min-width: 200px; margin-top: 5px; }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-item { display: block; padding: 10px 15px; text-decoration: none; color: white; font-weight: normal; transition: background-color 0.2s; }
        .dropdown-item:hover { background-color: #444; color: #F39C12; }

        /* Dashboard Professional Layout */
        .dashboard-container { max-width: 1200px; margin: 0 auto; }
        
        .welcome-card {
            background: linear-gradient(135deg, #333 0%, #444 100%);
            border-radius: 12px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 4px solid #F39C12;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .welcome-card h1 { font-size: 1.8rem; font-weight: 700; margin: 0; }
        .welcome-card p { font-size: 1rem; opacity: 0.8; margin-top: 5px; }

        .realtime-info { text-align: right; border-left: 2px solid rgba(243, 156, 18, 0.5); padding-left: 20px; }
        #clock { font-size: 1.8rem; font-weight: 800; color: #F39C12; display: block; }
        #date { font-size: 0.85rem; opacity: 0.8; text-transform: uppercase; letter-spacing: 1px; }

        /* Layout Grids */
        .main-grid { display: grid; grid-template-columns: 1fr 350px; gap: 2rem; align-items: start; }
        @media (max-width: 992px) { .main-grid { grid-template-columns: 1fr; } }

        /* Section Styling */
        .section-card { background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); margin-bottom: 2rem; }
        .section-header { border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; margin-bottom: 1.5rem; display: flex; align-items: center; }
        .section-header h2 { font-size: 1.2rem; font-weight: 700; color: #333; margin: 0; text-transform: uppercase; letter-spacing: 1px; }

        /* Info List */
        .info-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; }
        .info-item { display: flex; flex-direction: column; }
        .info-label { font-size: 0.75rem; color: #888; text-transform: uppercase; font-weight: 600; }
        .info-value { font-size: 1.1rem; color: #333; font-weight: 700; margin-top: 2px; }

        /* Quick Actions */
        .action-buttons { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .action-btn {
            display: flex; align-items: center; padding: 1rem; background: #fdfdfd; border: 1px solid #eee;
            border-radius: 8px; text-decoration: none; color: #444; font-weight: 600; transition: all 0.2s ease;
        }
        .action-btn:hover { background: #F39C12; color: white; border-color: #F39C12; transform: translateY(-2px); }
        .action-btn svg { width: 20px; height: 20px; margin-right: 0.8rem; }

        /* Announcement Sidebar */
        .announcement-item { padding: 1rem 0; border-bottom: 1px solid #f5f5f5; }
        .announcement-item:last-child { border-bottom: none; }
        .announcement-date { font-size: 0.7rem; color: #F39C12; font-weight: 700; }
        .announcement-title { font-size: 0.95rem; font-weight: 600; color: #333; margin: 5px 0; display: block; }
    </style>
</head>
<body class="antialiased">
    
    <header class="header">
        <div class="container">
            <div class="text-xl font-bold">Sistem Akademik</div>
            <nav class="nav-links">
                <a href="{{ url('/dashboard') }}">HOME</a> 
                <a href="{{ route('contact.form') }}">CONTACT</a>
                @auth
                    <a href="{{ url('/jadwal') }}">JADWAL</a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            {{ Auth::user()->name }} (Mahasiswa)
                            <span style="font-size: 0.7em; margin-left: 5px;">&#9660;</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">Logout</a>
                            </form>
                        </div>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    <div class="content-area">
        <div class="dashboard-container">
            
            <div class="welcome-card">
                <div>
                    <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
                    <p>Sistem Informasi Akademik Terpadu Universitas Maju</p>
                </div>
                <div class="realtime-info">
                    <span id="date">Memuat Tanggal...</span>
                    <span id="clock">00:00:00</span>
                </div>
            </div>

            <div class="main-grid">
                <div class="content-main">
                    
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Informasi Akademik</h2>
                        </div>
                        <div class="info-list">
                            <div class="info-item">
                                <span class="info-label">Nomor Induk Mahasiswa</span>
                                <span class="info-value">{{ Auth::user()->nim ?? Auth::user()->id }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Program Studi</span>
                                <span class="info-value">{{ Auth::user()->programStudi->nama_prodi ?? 'Teknik Informatika' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status Akademik</span>
                                <span class="info-value" style="color: #27ae60;">Aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <h2>Layanan Mahasiswa</h2>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ url('/jadwal') }}" class="action-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Jadwal Perkuliahan
                            </a>
                            <a href="{{ route('mahasiswa.print_ktm', Auth::user()->id) }}" class="action-btn" target="_blank">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                Cetak Kartu Mahasiswa
                            </a>
                            <a href="{{ route('profile.edit') }}" class="action-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Pengaturan Profil
                            </a>
                            <a href="{{ route('contact.form') }}" class="action-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Layanan Bantuan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="content-sidebar">
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Pengumuman</h2>
                        </div>
                        <div class="announcement-list">
                            <div class="announcement-item">
                                <span class="announcement-date">15 JANUARI 2026</span>
                                <a href="#" class="announcement-title">Panduan Registrasi Semester Genap 2025/2026</a>
                            </div>
                            <div class="announcement-item">
                                <span class="announcement-date">10 JANUARI 2026</span>
                                <a href="#" class="announcement-title">Pemberitahuan Pelaksanaan Ujian Susulan</a>
                            </div>
                            <div class="announcement-item">
                                <span class="announcement-date">05 JANUARI 2026</span>
                                <a href="#" class="announcement-title">Jadwal Pengisian KRS Online Tahap I</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('date').textContent = now.toLocaleDateString('id-ID', options);
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>
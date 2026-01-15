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
        .content-area { padding: 4rem 1rem; min-height: calc(100vh - 60px); background-color: #f0f0f0; }
        html { scroll-behavior: smooth; }
        /* CSS Dropdown BARU */
        .dropdown { position: relative; display: inline-block; margin-left: 1rem; }
        .dropdown-toggle {
            padding: 0.5rem 1rem;
            text-decoration: none !important;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            background-color: transparent !important; 
            border-radius: 0;
            color: white !important;
            font-size: 0.95em;
        }
        .dropdown-toggle:hover {
            color: #F39C12 !important;
        }
        .dropdown-menu {
            display: none; 
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1000;
            min-width: 200px;
            margin-top: 5px;
        }
        .dropdown:hover .dropdown-menu {
            display: block; 
        }
        .dropdown-item {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            font-weight: normal;
            transition: background-color 0.2s;
        }
        .dropdown-item:hover {
            background-color: #333;
        }

        /* CSS Dashboard Professional */
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, #333 0%, #444 100%);
            border-radius: 12px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 4px solid #F39C12;
        }
        
        .welcome-card h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .welcome-card p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.8rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #F39C12;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-card h3 {
            font-size: 0.9rem;
            color: #666;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
        }
        
        .quick-actions {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        
        .quick-actions h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
        }
        
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            padding: 1.2rem;
            background: #f9f9f9;
            border: 2px solid #ddd;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            background: #F39C12;
            color: white;
            border-color: #F39C12;
            transform: translateX(5px);
        }
        
        .action-btn svg {
            width: 24px;
            height: 24px;
            margin-right: 0.8rem;
        }
    </style>
</head>
<body class="antialiased">
    
    <header class="header">
        <div class="container">
            <div class="text-xl font-bold">
                Sistem Akademik
            </div>
            
            <nav class="nav-links">
                
                <a href="{{ Auth::check() ? url('/dashboard') : url('/') }}">HOME</a> 
                <a href="{{ route('contact.form') }}">CONTACT</a>

                @auth
                    @php
                        $status = (auth()->user()->role === 'admin') ? 'Admin' : 'Mahasiswa';
                        $userName = Auth::user()->name;
                    @endphp
                    
                    {{-- Navigasi Mahasiswa --}}
                    <a href="{{ url('/jadwal') }}">JADWAL</a>
                    
                    {{-- DROPDOWN MENU BARU --}}
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            {{ $userName }} ({{ $status }})
                            <span style="font-size: 0.7em; margin-left: 5px;">&#9660;</span>
                        </a>
                        
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Edit Profil</a>
                            <form method="POST" action="{{ route('logout') }}" style="display:block;">
                                @csrf
                                <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="dropdown-item">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    <div class="content-area">
        <div class="dashboard-container">
            
            <!-- Welcome Card -->
            <div class="welcome-card">
                <h1>Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p>Semoga hari Anda menyenangkan. Kelola jadwal perkuliahan Anda dengan mudah.</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #FFF3E0; color: #F39C12;">
                        📚
                    </div>
                    <h3>Total Mata Kuliah</h3>
                    <div class="value">8</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #F5F5F5; color: #555;">
                        📅
                    </div>
                    <h3>Jadwal Hari Ini</h3>
                    <div class="value">3</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #FFF3E0; color: #F39C12;">
                        ✅
                    </div>
                    <h3>Kehadiran</h3>
                    <div class="value">94%</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #F5F5F5; color: #555;">
                        🎯
                    </div>
                    <h3>IPK Semester</h3>
                    <div class="value">3.75</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2>Aksi Cepat</h2>
                <div class="action-buttons">
                    <a href="{{ url('/jadwal') }}" class="action-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Lihat Jadwal
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="action-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Edit Profil
                    </a>
                    
                    <a href="{{ route('contact.form') }}" class="action-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Hubungi Admin
                    </a>
                    
                    <a href="#" class="action-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Unduh Transkrip
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
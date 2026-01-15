<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Akademik</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CSS yang Diperlukan untuk Header (TIDAK DIUBAH) */
        .header { background-color: #333; color: white; padding: 1rem 0; border-bottom: 5px solid #F39C12; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; display: flex; justify-content: space-between; align-items: center; }
        .nav-links a { color: white; padding: 0.5rem 1rem; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .nav-links a:hover { color: #F39C12; }
        
        /* CSS Dropdown (TIDAK DIUBAH) */
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

        /* ========== STYLING BARU DIMULAI DI SINI ========== */
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        
        /* Hero Section dengan Gradient Modern */
        .hero {
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2d3748 0%, #F39C12 50%, #e67e22 100%);
            overflow: hidden;
            padding: 4rem 1rem;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: movePattern 30s linear infinite;
        }
        
        @keyframes movePattern {
            0% { transform: translate(0, 0); }
            100% { transform: translate(60px, 60px); }
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 900px;
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 12px rgba(0,0,0,0.2);
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.35rem;
            color: rgba(255,255,255,0.95);
            margin-bottom: 2.5rem;
            font-weight: 300;
            text-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #F39C12 0%, #e67e22 100%);
            color: white;
            padding: 1rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(243, 156, 18, 0.5);
        }
        
        /* Features Section */
        .features {
            padding: 5rem 1rem;
            background: linear-gradient(to bottom, #f8f9fa, #ffffff);
        }
        
        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #718096;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.12);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #F39C12 0%, #e67e22 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            color: #2d3748;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
        
        .feature-card p {
            color: #718096;
            line-height: 1.7;
            font-size: 1rem;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 5rem 1rem;
            background: linear-gradient(135deg, #2d3748 0%, #333 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zm10 8c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm40 40c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .cta-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        
        .cta-section p {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 2rem;
        }
        
        .cta-section a {
            display: inline-block;
            background: linear-gradient(135deg, #F39C12 0%, #e67e22 100%);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
        }
        
        .cta-section a:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(243, 156, 18, 0.6);
        }
        
        /* Footer */
        .footer {
            background-color: #2d3748;
            color: #cbd5e0;
            padding: 3rem 1rem 1.5rem;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer p {
            margin-bottom: 0.5rem;
        }
        
        .footer-links {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #4a5568;
        }
        
        .footer-links a {
            color: #F39C12;
            text-decoration: none;
            margin: 0 1rem;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: #e67e22;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero p { font-size: 1.1rem; }
            .section-title { font-size: 2rem; }
            .features-grid { grid-template-columns: 1fr; }
            .cta-section h2 { font-size: 2rem; }
        }
    </style>
</head>
<body class="antialiased">
    
    {{-- HEADER NAVIGASI --}}
    <header class="header">
        <div class="container">
            <div class="text-xl font-bold">
                Sistem Akademik
            </div>
            
            <nav class="nav-links">
                <a href="{{ Auth::check() ? url('/dashboard') : url('/') }}">HOME</a> 
                <a href="{{ route('contact.form') }}">CONTACT</a>
                
                @if (Route::has('login'))
                    @auth
                        @php
                            $status = (auth()->user()->role === 'admin') ? 'Admin' : 'Mahasiswa';
                            $userName = Auth::user()->name;
                        @endphp
                        
                        @if ($status === 'Mahasiswa')
                            <a href="{{ url('/jadwal') }}">JADWAL</a>
                        @else 
                            <a href="{{ route('admin.jadwal.index') }}">EDIT JADWAL</a>
                            <a href="{{ route('admin.mahasiswa.index') }}">MAHASISWA</a>
                            <a href="{{ route('admin.dosen.index') }}">DOSEN</a>
                            <a href="{{ route('admin.matkul.index') }}">MATKUL</a>
                        @endif
                        
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
                                        class="dropdown-item">Logout</a>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-400">LOGIN</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary ml-4">REGISTER</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    {{-- HERO SECTION --}}
    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di Pendaftaran Mahasiswa Baru</h1>
            <p>Wujudkan impian masa depanmu bersama kami. Proses pendaftaran yang mudah, cepat, dan transparan kini hadir dalam satu genggaman.</p>
            
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">Masuk ke Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">Daftar Sekarang</a>
            @endauth
        </div>
    </section>

    {{-- FEATURES SECTION --}}
    <section class="features">
        <div class="features-container">
            <h2 class="section-title">Mengapa Memilih Kami?</h2>
            <p class="section-subtitle">
                Kami menyediakan kemudahan akses pendidikan bagi seluruh calon mahasiswa berprestasi
            </p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📝</div>
                    <h3>Pendaftaran Online</h3>
                    <p>Daftar kapan saja dan di mana saja tanpa perlu datang ke kampus di tahap awal.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Proses Cepat</h3>
                    <p>Verifikasi data yang efisien dan sistematis memastikan proses seleksi berjalan lancar.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">📄</div>
                    <h3>E-Dokumen</h3>
                    <p>Unggah seluruh kelengkapan berkas secara digital tanpa repot mencetak dokumen fisik.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Notifikasi Real-time</h3>
                    <p>Dapatkan status kelulusan dan informasi pendaftaran langsung melalui dashboard akun Anda.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Data Terjamin</h3>
                    <p>Keamanan data pribadi Anda adalah prioritas utama kami dalam sistem pendaftaran ini.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>Layanan Bantuan</h3>
                    <p>Tim admin kami siap membantu setiap kendala teknis yang Anda hadapi selama pendaftaran.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="cta-section">
        <div class="cta-content">
            <h2>Butuh Informasi Lebih Lanjut?</h2>
            <p>Jangan ragu untuk menghubungi tim pendaftaran kami. Kami siap menjawab segala pertanyaan Anda mengenai program studi dan biaya pendidikan.</p>
            <a href="{{ route('contact.form') }}">Hubungi Kami</a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-content">
            <p><strong>Pendaftaran Mahasiswa Baru</strong></p>
            <p>Membangun generasi cerdas dan inovatif untuk masa depan bangsa</p>
            
            <div class="footer-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('contact.form') }}">Contact</a>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </div>
            
            <p style="margin-top: 2rem; font-size: 0.9rem; color: #a0aec0;">
                &copy; {{ date('Y') }} Pendaftaran Mahasiswa Baru. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdownMenu = document.getElementById('userDropdown');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            const menu = document.getElementById('userDropdown');
            if (dropdown && !dropdown.contains(event.target)) {
                if(menu) menu.style.display = 'none';
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Setup Halaman & Reset */
        @page { 
            margin: 0; 
            size: 86mm 54mm; /* Ukuran standar ID Card (CR80) */
        }
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            line-height: 1;
        }

        .card {
            width: 86mm;
            height: 54mm;
            background-color: #ea580c;
            position: relative;
            overflow: hidden;
            color: white;
            background-image: linear-gradient(145deg, #ea580c 0%, #9a3412 100%);
        }

        /* Dekorasi Background */
        .circle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 1;
        }

        /* Header */
        .header {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 6px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 2;
        }
        
        .univ-name {
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 1px;
            margin: 0;
            text-transform: uppercase;
        }

        .card-type {
            font-size: 7px;
            font-weight: normal;
            letter-spacing: 2px;
            opacity: 0.9;
            text-transform: uppercase;
        }

        /* Foto Mahasiswa */
        .photo-box {
            position: absolute;
            top: 18mm;
            left: 6mm;
            width: 23mm;
            height: 29mm;
            border: 2px solid white;
            border-radius: 2px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
            z-index: 2;
            background-color: #f3f4f6;
        }
        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Informasi Mahasiswa */
        .info {
            position: absolute;
            top: 18mm;
            left: 33mm;
            right: 6mm;
            z-index: 2;
        }
        .label { 
            font-size: 6px; 
            opacity: 0.8; 
            margin-bottom: 1px; 
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .value { 
            font-size: 10px; 
            font-weight: bold; 
            margin-bottom: 6px; 
            text-transform: uppercase;
            color: #ffffff;
            word-wrap: break-word;
        }

        /* Prodi Badge */
        .prodi {
            background: #ffffff;
            color: #9a3412;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 7px;
            font-weight: 900;
            display: inline-block;
            margin-top: 2px;
            text-transform: uppercase;
        }

        /* QR CODE CONTAINER */
        .qr-container {
            position: absolute;
            bottom: 4mm;
            right: 6mm;
            text-align: center;
            z-index: 2;
        }
        .qr-bg {
            background: white;
            padding: 4px;
            border-radius: 4px;
            display: inline-block;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            line-height: 0; /* Penting untuk menghilangkan celah bawah gambar */
        }
        .qr-bg img {
            width: 14mm; 
            height: 14mm;
            display: block;
        }
        .nim-text {
            color: white;
            font-size: 7px;
            margin-top: 4px;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="circle" style="width: 120px; height: 120px; top: -30px; right: -30px;"></div>
        <div class="circle" style="width: 80px; height: 80px; bottom: -20px; left: -20px;"></div>

        <div class="header">
            <div class="univ-name">UNIVERSITAS MAJU</div>
            <div class="card-type">Kartu Tanda Mahasiswa</div>
        </div>

        <div class="photo-box">
            @php
                $photoPath = public_path('storage/' . $mhs->photo);
            @endphp
            @if($mhs->photo && file_exists($photoPath))
                <img src="{{ $photoPath }}">
            @else
                <div style="padding-top: 40%; text-align: center; color: #999; font-size: 8px;">FOTO 3X4</div>
            @endif
        </div>

        <div class="info">
            <div class="label">NAMA MAHASISWA</div>
            <div class="value">{{ $mhs->name }}</div>

            <div class="label">NOMOR INDUK MAHASISWA</div>
            <div class="value">{{ $mhs->nim }}</div>

            <div class="label">PROGRAM STUDI</div>
            <div class="prodi">
                {{ $mhs->programStudi->nama_prodi ?? 'UMUM' }}
            </div>
        </div>

        <div class="qr-container">
            <div class="qr-bg">
                {{-- PERBAIKAN: Menggunakan SVG Base64 (Tanpa Imagick) --}}
                <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->margin(0)->generate($mhs->nim)) }}">
            </div>
            <div class="nim-text">{{ $mhs->nim }}</div>
        </div>
    </div>
</body>
</html>
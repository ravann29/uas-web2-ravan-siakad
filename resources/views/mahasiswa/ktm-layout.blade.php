<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { size: 86mm 54mm; margin: 0; }
        body { margin: 0; padding: 0; font-family: 'Helvetica', sans-serif; line-height: 1.2; }
        .card {
            width: 86mm;
            height: 54mm;
            background-color: #ea580c;
            background-image: linear-gradient(145deg, #ea580c 0%, #9a3412 100%);
            position: relative;
            overflow: hidden;
            color: white;
        }
        .circle { position: absolute; background: rgba(255, 255, 255, 0.1); border-radius: 50%; }
        .header { background-color: rgba(0, 0, 0, 0.2); padding: 6px 12px; border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .univ-name { font-size: 11px; font-weight: 900; }
        .card-type { font-size: 7px; letter-spacing: 2px; text-transform: uppercase; opacity: 0.9; }
        .photo-box {
            position: absolute;
            top: 18mm;
            left: 6mm;
            width: 23mm;
            height: 29mm;
            border: 2px solid white;
            background-color: #f3f4f6;
            overflow: hidden;
            display: block;
        }
        .info { position: absolute; top: 18mm; left: 33mm; right: 5mm; }
        .label { font-size: 6px; opacity: 0.8; margin-bottom: 1px; font-weight: bold; }
        .value { font-size: 10px; font-weight: bold; margin-bottom: 6px; text-transform: uppercase; }
        .prodi-badge { background: white; color: #9a3412; padding: 2px 5px; border-radius: 3px; font-size: 7px; font-weight: 900; display: inline-block; }
        .qr-container { position: absolute; bottom: 4mm; right: 6mm; text-align: center; }
        .qr-white-bg { background: white; padding: 3px; border-radius: 3px; line-height: 0; display: inline-block; }
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
                $imageData = null;
                
                // Cek beberapa kemungkinan path lokasi foto
                $possiblePaths = [
                    public_path('storage/' . $mhs->photo),
                    storage_path('app/public/' . $mhs->photo),
                    public_path($mhs->photo)
                ];

                foreach ($possiblePaths as $path) {
                    if ($mhs->photo && file_exists($path) && is_file($path)) {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $imageData = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        break; // Stop jika sudah ketemu
                    }
                }
            @endphp

            @if($imageData)
                <img src="{{ $imageData }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="padding-top: 40%; text-align: center; color: #ccc;">
                    <span style="font-size: 20px; font-weight: bold; display: block;">{{ substr($mhs->name, 0, 1) }}</span>
                    <span style="font-size: 7px;">NO PHOTO</span>
                </div>
            @endif
        </div>

        <div class="info">
            <div class="label">NAMA MAHASISWA</div>
            <div class="value">{{ $mhs->name }}</div>

            <div class="label">NOMOR INDUK MAHASISWA</div>
            <div class="value">{{ $mhs->nim ?? $mhs->id }}</div>

            <div class="label">PROGRAM STUDI</div>
            <div class="prodi-badge">
                {{ $mhs->programStudi->nama_prodi ?? 'UMUM' }}
            </div>
        </div>

        <div class="qr-container">
            <div class="qr-white-bg">
                <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->size(50)->margin(0)->generate($mhs->nim ?? $mhs->id)) }}" style="width: 12mm; height: 12mm;">
            </div>
            <div style="font-size: 7px; margin-top: 3px; font-weight: bold;">{{ $mhs->nim ?? $mhs->id }}</div>
        </div>
    </div>
</body>
</html>
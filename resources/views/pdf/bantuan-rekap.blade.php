<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 22mm 18mm; }
        body { font-family: "Times New Roman", Times, serif; font-size: 12px; color: #111; }

        .header-table { width: 100%; margin-bottom: 20px; border-bottom: 2px solid #000; }
        .header-table td { vertical-align: top; border: none !important; font-size: 14px; }
        .logo { width: 120px; }
        .instansi-info { text-align: center; font-size: 11px; line-height: 1.4; }

        .title { text-align: center; margin: 10px 0 16px; font-weight: bold; text-decoration: underline; }
        .meta { font-size: 11px; color: #444; margin-bottom: 10px; }

        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; vertical-align: top; }
        thead th { background: #f0f0f0; }

        .left { text-align: left; }
        .right { text-align: right; }
        .muted { color: #555; }
        .footer { margin-top: 32px; text-align: right; font-size: 12px; }
    </style>
</head>
<body>
    {{-- Header --}}
    <table class="header-table">
        <tr>
            <td class="logo">
                <img src="file://{{ public_path('logo.PNG') }}" alt="Logo" style="width: 100px;">
            </td>
            <td class="instansi-info">
                <strong>RELAWAN ODGJ BATURRADEN </strong><br>
                Desa Kemutug Kidul, Gg Banowati No. 17 RT 04/RW 03<br>
                Kec.Baturaden. Kab.Banyumas. Jawa Tengah. Indonesia 53151<br>
                Phone : 0856-4767-5444<br>
            </td>
        </tr>
    </table>

    {{-- Title --}}
    <div class="title">REKAP PENDAFTARAN LAYANAN</div>
    <div class="meta">Dicetak: {{ $meta['dicetak'] ?? now()->format('d/m/Y H:i') }}</div>

    {{-- Ringkasan --}}
    <table style="margin-bottom:16px;">
        <thead>
            <tr>
                <th class="left">Jenis Layanan</th>
                <th class="right">Jumlah Data</th>
            </tr>
        </thead>
        <tbody>
            @forelse($perJenis as $jenis => $r)
                <tr>
                    <td class="left">{{ $jenis }}</td>
                    <td class="right">{{ $r['count'] }}</td>
                </tr>
            @empty
                <tr><td colspan="2" class="center muted">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Detail --}}
    <table>
        <thead>
            <tr>
                <th style="width:25mm;">Tanggal</th>
                <th style="width:35mm;">Nama</th>
                <th style="width:35mm;">Jenis Layanan</th>
                <th style="width:50mm;">Alamat</th>
                <th style="width:50mm;">Keluhan</th>
                <th style="width:30mm;">Kontak</th>
                <th style="width:25mm;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bantuans as $b)
                <tr>
                    <td>{{ $b->tanggal ? \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') : '-' }}</td>
                    <td class="left">{{ $b->nama }}</td>
                    <td class="left">{{ optional($b->jenisBantuan)->name ?? '—' }}</td>
                    <td class="left">{{ $b->alamat }}</td>
                    <td class="left">{{ $b->keluhan }}</td>
                    <td>{{ $b->kontak }}</td>
                    <td>{{ ucfirst($b->status ?? '-') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="center muted">Tidak ada data layanan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>Purwokerto, {{ now()->translatedFormat('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
    </div>

    {{-- Nomor Halaman --}}
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", null, 9, [0,0,0]);
        }
    </script>
</body>
</html>

@php
    function rupiah($n) { return 'Rp ' . number_format($n ?? 0, 0, ',', '.'); }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 22mm 18mm; }
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            color: #111;
        }

        /* Header */
        .header-table {
            width: 100%;
            margin-bottom: 20px;
            border: none;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header-table td {
            vertical-align: top;
            border: none !important;
            font-size: 14px;
        }
        .logo { width: 120px; }
        .instansi-info {
            text-align: center;
            font-size: 11px;
            line-height: 1.4;
        }

        /* Meta & title */
        .meta { font-size: 11px; color: #444; margin-top: -10px; margin-bottom: 10px; }
        .title {
            text-align: center;
            margin: 10px 0 16px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* Tables (global) */
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; vertical-align: top; }
        thead th { background: #f0f0f0; }

        /* Utility */
        .right { text-align: right; }
        .left { text-align: left; }
        .center { text-align: center; }
        .muted { color: #555; }
        .mb-12 { margin-bottom: 12px; }
        .mb-16 { margin-bottom: 16px; }
        .w-50 { width: 50%; }

        /* Two-column grid using tables for PDF robustness */
        .grid { width: 100%; border: none; border-collapse: separate; }
        .grid td { border: none; padding: 0; }

        /* Footer signature */
        .footer {
            margin-top: 32px;
            width: 100%;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>
    {{-- Header: Logo + Instansi Info --}}
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

    {{-- Title & meta --}}
    <div class="title">REKAP PENGGALANGAN DONASI</div>
    <div class="meta">Dicetak: {{ $meta['dicetak'] ?? now()->format('d/m/Y H:i') }}</div>

    {{-- Ringkasan (2 kolom) --}}
    <table class="grid mb-16">
        <tr>
            <td class="w-50" style="padding-right: 8px;">
                <table>
                    <tbody>
                        <tr>
                            <th class="left">Total Data</th>
                            <td class="right">{{ $totalRecords }}</td>
                        </tr>
                        <tr>
                            <th class="left">Total Donatur (non-anonim)</th>
                            <td class="right">{{ $totalDonatur }}</td>
                        </tr>
                        <tr>
                            <th class="left">Total Uang</th>
                            <td class="right">{{ rupiah($totalUang) }}</td>
                        </tr>
                        <tr>
                            <th class="left">Total Item (qty)</th>
                            <td class="right">{{ $totalItems }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class="w-50" style="padding-left: 8px;">
                <table>
                    <thead>
                        <tr>
                            <th>Tujuan</th>
                            <th class="right"># Data</th>
                            <th class="right">Uang</th>
                            <th class="right">Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($perTujuan as $tujuan => $r)
                            <tr>
                                <td class="left">{{ $tujuan }}</td>
                                <td class="right">{{ $r['count'] }}</td>
                                <td class="right">{{ rupiah($r['total_uang']) }}</td>
                                <td class="right">{{ $r['total_item'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="center muted">Tidak ada data tujuan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    {{-- Tabel detail semua data --}}
    <table>
        <thead>
            <tr>
                <th style="width: 26mm;">Tanggal</th>
                <th style="width: 38mm;">Donatur</th>
                <th style="width: 20mm;">Tipe</th>
                <th style="width: 36mm;">Tujuan</th>
                <th>Rincian</th>
                <th style="width: 30mm;">Kontak</th>
            </tr>
        </thead>
        <tbody>
        @forelse($donasis as $d)
            @php
                $tgl = $d->date ? \Carbon\Carbon::parse($d->date)->format('d/m/Y') : '-';
                $donatur = $d->is_anonymous ? 'Anonim' : ($d->name ?? '-');
                $tujuan = optional($d->tujuanDonasi)->name ?? '—';

                // Uang / Barang / Jasa
                $rincian = '';
                if ($d->type === 'Materi') {
                    $money = $d->money instanceof \Illuminate\Support\Collection ? $d->money->first() : $d->money;
                    $rincian = 'Uang: ' . rupiah($money->total ?? 0);
                } else {
                    $bagian = [];
                    if ($d->items && $d->items->count()) {
                        $bagian[] = 'Barang: ' . $d->items->map(function($i){
                            $sat = optional($i->satuan)->name;
                            return $i->name.' ('.$i->qty.($sat ? ' '.$sat : '').')';
                        })->implode(', ');
                    }
                    if ($d->jasa && $d->jasa->count()) {
                        $bagian[] = 'Jasa: ' . $d->jasa->map(fn($j) => trim(strip_tags($j->description_jasa)))->implode(' | ');
                    }
                    $rincian = $bagian ? implode(' — ', $bagian) : '—';
                }
                $kontak = $d->phone ?? '-';
            @endphp
            <tr>
                <td>{{ $tgl }}</td>
                <td class="left">{{ $donatur }}</td>
                <td>{{ $d->type ?? '-' }}</td>
                <td class="left">{{ $tujuan }}</td>
                <td class="left">{!! nl2br(e($rincian)) !!}</td>
                <td>{{ $kontak }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="center muted">Tidak ada data donasi.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Footer / Tanda tangan --}}
    <div class="footer">
        <p>Purwokerto, {{ now()->translatedFormat('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
    </div>

    {{-- Nomor halaman --}}
    <script type="text/php">
        if (isset($pdf)) {
            // Sesuaikan posisi bila margin diubah
            $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", null, 9, [0,0,0]);
        }
    </script>
</body>
</html>

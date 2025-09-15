@php
    function rupiah($n) { return 'Rp ' . number_format($n ?? 0, 0, ',', '.'); }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Rekap Donasi</title>
<style>
    @page { margin: 22mm 18mm; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
    h1 { font-size: 18px; margin: 0 0 6px; }
    .muted { color: #555; }
    .mb-6 { margin-bottom: 18px; }
    .mb-4 { margin-bottom: 12px; }
    .mb-2 { margin-bottom: 8px; }
    .grid { display: table; width: 100%; }
    .col { display: table-cell; vertical-align: top; }
    .w-50 { width: 50%; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #444; padding: 6px; vertical-align: top; }
    thead tr { background: #f0f0f0; }
    .right { text-align: right; }
    .center { text-align: center; }
    .small { font-size: 11px; }
</style>
</head>
<body>
    <h1>Rekap Penggalangan Donasi</h1>
    <div class="muted mb-6">Dicetak: {{ $meta['dicetak'] ?? now()->format('d/m/Y H:i') }}</div>

    {{-- Ringkasan --}}
    <div class="grid mb-6">
        <div class="col w-50">
            <table>
                <tr><th>Total Data</th><td class="right">{{ $totalRecords }}</td></tr>
                <tr><th>Total Donatur (non-anonim)</th><td class="right">{{ $totalDonatur }}</td></tr>
                <tr><th>Total Uang</th><td class="right">{{ rupiah($totalUang) }}</td></tr>
                <tr><th>Total Item (qty)</th><td class="right">{{ $totalItems }}</td></tr>
            </table>
        </div>
        <div class="col w-50">
            <table>
                <thead><tr><th>Tujuan</th><th class="right"># Data</th><th class="right">Uang</th><th class="right">Item</th></tr></thead>
                <tbody>
                @forelse($perTujuan as $tujuan => $r)
                    <tr>
                        <td>{{ $tujuan }}</td>
                        <td class="right">{{ $r['count'] }}</td>
                        <td class="right">{{ rupiah($r['total_uang']) }}</td>
                        <td class="right">{{ $r['total_item'] }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="center small muted">Tidak ada data tujuan</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

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
                <td>{{ $donatur }}</td>
                <td>{{ $d->type ?? '-' }}</td>
                <td>{{ $tujuan }}</td>
                <td>{!! nl2br(e($rincian)) !!}</td>
                <td>{{ $kontak }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="center small muted">Tidak ada data donasi.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Nomor halaman --}}
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", null, 9, [0,0,0]);
        }
    </script>
</body>
</html>

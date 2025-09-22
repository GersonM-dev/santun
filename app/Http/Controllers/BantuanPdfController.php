<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BantuanPdfController extends Controller
{
    public function rekap(Request $request)
    {
        // Ambil semua data Bantuan dengan relasi JenisBantuan
        $bantuans = Bantuan::with(['jenisBantuan:id,name'])
            ->orderByDesc('tanggal')
            ->get();

        // Hitung metrik ringkas
        $totalRecords = $bantuans->count();
        $perJenis = $bantuans->groupBy(fn($b) => optional($b->jenisBantuan)->name ?? '—')
            ->map(fn($group) => [
                'count' => $group->count(),
            ])->sortKeys();

        $meta = [
            'dicetak' => Carbon::now()->timezone('Asia/Jakarta')->format('d/m/Y H:i'),
        ];

        // Buat PDF
        $pdf = Pdf::loadView('pdf.bantuan-rekap', [
                'bantuans'     => $bantuans,
                'totalRecords' => $totalRecords,
                'perJenis'     => $perJenis,
                'meta'         => $meta,
            ])
            ->setPaper('a4', 'portrait');

        $filename = 'rekap-bantuan-' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }
}

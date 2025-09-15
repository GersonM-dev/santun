<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonasiPdfController extends Controller
{
    public function rekap(Request $request)
    {
        // Ambil SEMUA data + relasi yang dibutuhkan
        $donasis = Donasi::with([
            'tujuanDonasi:id,name',
            'items.satuan:id,name',
            'money',    // bisa hasOne/hasMany (repeater)
            'jasa',
        ])
        ->orderByDesc('date')
        ->get();

        // Helper: total uang per donasi (support hasOne/hasMany/nullable)
        $moneyOf = function ($d) {
            if ($d->type !== 'Materi') return 0;
            $rel = $d->money ?? null;

            if ($rel instanceof \Illuminate\Support\Collection) {
                $first = $rel->first();
                return (float) ($first->total ?? 0);
            }
            return (float) ($rel->total ?? 0);
        };

        // METRIK RINGKAS
        $totalRecords = $donasis->count();
        $totalUang    = $donasis->sum(fn($d) => $moneyOf($d));
        $totalItems   = $donasis->sum(function ($d) {
            return ($d->items ? $d->items->sum('qty') : 0);
        });
        $totalDonatur = $donasis
            ->filter(fn($d) => ! $d->is_anonymous)
            ->unique(fn($d) => ($d->name ?? '') . '|' . ($d->phone ?? ''))
            ->count();

        // Rekap per tujuan
        $perTujuan = $donasis->groupBy(fn($d) => optional($d->tujuanDonasi)->name ?? '—')
            ->map(function ($group) use ($moneyOf) {
                return [
                    'count'      => $group->count(),
                    'total_uang' => $group->sum(fn($d) => $moneyOf($d)),
                    'total_item' => $group->sum(fn($d) => $d->items ? $d->items->sum('qty') : 0),
                ];
            })->sortKeys();

        $meta = [
            'dicetak' => Carbon::now()->timezone('Asia/Jakarta')->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('pdf.donasi-rekap', [
                'donasis'     => $donasis,
                'totalRecords'=> $totalRecords,
                'totalUang'   => $totalUang,
                'totalItems'  => $totalItems,
                'totalDonatur'=> $totalDonatur,
                'perTujuan'   => $perTujuan,
                'meta'        => $meta,
            ])
            ->setPaper('a4', 'portrait');

        $filename = 'rekap-donasi-' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }
}

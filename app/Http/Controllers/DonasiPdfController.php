<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Carbon\Carbon;
use Illuminate\Http\Response;
use setasign\Fpdi\Fpdi;

class DonasiPdfController extends Controller
{
    public function show(Donasi $record)
    {
        // Lokasi template
        $templatePath = storage_path('app/templates/Template laporan.pdf');
        if (! file_exists($templatePath)) {
            abort(404, 'Template PDF tidak ditemukan di: ' . $templatePath);
        }

        // Siapkan data ringkas
        Carbon::setLocale('id');
        $tanggal = $record->date ? Carbon::parse($record->date)->translatedFormat('d F Y') : '-';
        $tujuan  = optional($record->tujuanDonasi)->name ?? '-';

        // Ringkas detail sesuai tipe
        $detail = '-';
        if ($record->type === 'Materi') {
            // Jika relasi "money" berupa koleksi (repeater), ambil item pertama:
            $money = is_iterable($record->money ?? null)
                ? collect($record->money)->first()
                : ($record->money ?? null);

            if ($money) {
                $detail = 'Donasi Uang: Rp ' . number_format($money->total, 0, ',', '.');
            }
        } else {
            // Non Materi: gabungkan items / jasa
            $itemsText = '';
            if ($record->items && count($record->items)) {
                $itemsText = collect($record->items)->map(function ($i) {
                    $sat = optional($i->satuan)->name;
                    return $i->name . ' (' . $i->qty . ($sat ? ' ' . $sat : '') . ')';
                })->implode(', ');
            }

            $jasaText = '';
            if ($record->jasa && count($record->jasa)) {
                $jasaText = collect($record->jasa)->map(function ($j) {
                    // description_jasa kemungkinan rich text, hilangkan tag
                    return trim(strip_tags((string) $j->description_jasa));
                })->implode(' | ');
            }

            $parts = array_filter([
                $itemsText ? ('Barang: ' . $itemsText) : null,
                $jasaText ? ('Jasa: ' . $jasaText) : null,
            ]);
            $detail = count($parts) ? implode(' — ', $parts) : '-';
        }

        $catatan = $record->catatan ? trim(strip_tags((string) $record->catatan)) : '-';

        // ===== Render ke template dengan FPDI =====
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($templatePath);
        $tpl = $pdf->importPage(1);
        // 210 = lebar A4 dalam mm; sesuaikan jika template kamu bukan A4
        $pdf->useTemplate($tpl, 0, 0, 210);

        $pdf->SetFont('Helvetica', '', 11);
        $pdf->SetTextColor(0, 0, 0);

        // TODO: SESUAIKAN KOORDINAT BERIKUT DENGAN POSISI PADA TEMPLATE PDF-MU
        // Tips: print dulu lalu koreksi X/Y sampai pas.
        $left = 25;      // margin kiri
        $y    = 70;      // start tinggi
        $gap  = 7;       // jarak baris

        // Nama / Anonim
        $pdf->SetXY($left, $y);
        $pdf->Write(6, utf8_decode($record->is_anonymous ? 'Anonim' : ($record->name ?? '-')));

        // Telepon
        $y += $gap;
        $pdf->SetXY($left, $y);
        $pdf->Write(6, utf8_decode($record->phone ?? '-'));

        // Tanggal Donasi
        $y += $gap;
        $pdf->SetXY($left, $y);
        $pdf->Write(6, utf8_decode($tanggal));

        // Tipe & Tujuan
        $y += $gap;
        $pdf->SetXY($left, $y);
        $pdf->Write(6, utf8_decode('Tipe: ' . ($record->type ?? '-')));

        $y += $gap;
        $pdf->SetXY($left, $y);
        $pdf->Write(6, utf8_decode('Tujuan: ' . $tujuan));

        // Detail Donasi (uang/barang/jasa)
        $y += $gap + 2;
        $pdf->SetXY($left, $y);
        $pdf->MultiCell(0, 6, utf8_decode($detail));

        // Catatan
        if ($catatan && $catatan !== '-') {
            $y = $pdf->GetY() + 3;
            $pdf->SetXY($left, $y);
            $pdf->MultiCell(0, 6, utf8_decode('Catatan: ' . $catatan));
        }

        // Output sebagai respons
        $filename = 'Donasi-' . ($record->id ?? 'dok') . '.pdf';
        $content  = $pdf->Output('S'); // string

        return new Response($content, 200, [
            'Content-Type' => 'application/pdf',
            // 'inline' agar tampil di tab baru; pakai 'attachment' bila mau paksa download
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
        ]);
    }
}

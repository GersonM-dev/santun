{{-- resources/views/pages/info-donasi.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Informasi Donasi</h1>

    @if($mode === 'materi')
        <h2>Donasi Materi</h2>
        <p>Donasi materi adalah bantuan berupa uang atau barang bernilai ekonomis yang digunakan untuk mendukung kegiatan dan layanan kemanusiaan Relawan ODGJ Baturaden. Bantuan ini menjadi sumber penting untuk menyediakan kebutuhan pasien ODGJ, mendukung pendidikan anak kurang mampu, dan membantu masyarakat yang mengalami kesulitan hidup.</p>
        <ul>
            <li><strong>Donasi Uang:</strong> Dapat disalurkan tunai atau transfer bank. Dana digunakan untuk biaya operasional, perawatan pasien, perlengkapan kesehatan, dukungan pendidikan, dan kegiatan sosial lainnya.</li>
            <li><strong>Donasi Barang:</strong> Berupa kebutuhan pokok, perlengkapan kesehatan, pakaian layak pakai, perlengkapan sekolah, dan barang bermanfaat lainnya.</li>
        </ul>
        <p>Rekening donasi: <strong>Bank BRI – No. Rekening 12345678 – a.n. Muhajianto</strong>.</p>
    @elseif($mode === 'non-materi')
        <h2>Donasi Non‑Materi</h2>
        <p>Donasi non‑materi adalah dukungan dalam bentuk tenaga, waktu, pemikiran, atau keahlian. Walau tidak berwujud fisik, kontribusi ini memberikan dampak nyata dan berkelanjutan bagi penerima manfaat.</p>
        <ul>
            <li><strong>Tenaga:</strong> Membantu di lapangan, mendampingi pasien ODGJ, atau menyalurkan bantuan.</li>
            <li><strong>Waktu:</strong> Berpartisipasi dalam kunjungan pasien, pendampingan belajar, atau kegiatan sosial.</li>
            <li><strong>Pemikiran:</strong> Memberi ide dan saran untuk pengembangan program.</li>
            <li><strong>Keahlian:</strong> Menyumbangkan kemampuan khusus seperti konseling, pelatihan, atau layanan kesehatan.</li>
        </ul>
    @else
        <p>Pilih tipe donasi yang sesuai: <strong>Materi</strong> atau <strong>Non‑Materi</strong>. Setelah memilih, Anda akan melihat penjelasan singkat sesuai pilihan.</p>
    @endif

    <a href="{{ route('formdonasi', $mode) }}" class="btn btn-primary mt-3">Lanjut ke Form Donasi</a>
</div>
@endsection

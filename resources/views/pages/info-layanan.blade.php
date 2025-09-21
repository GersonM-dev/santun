{{-- resources/views/pages/info-layanan.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Informasi Layanan</h1>

    @switch($layananSlug)
        @case('kesehatan-jiwa')
            <h2>Bantuan Khusus Kesehatan Jiwa</h2>
            <p>Relawan ODGJ Baturaden menyediakan layanan bantuan khusus bagi masyarakat yang membutuhkan pendampingan dan penanganan Orang Dengan Gangguan Jiwa (ODGJ). Layanan ini diperuntukkan bagi keluarga atau individu yang mengalami kesulitan dalam mengelola kondisi gangguan jiwa. Pendaftaran dilakukan secara online, mengisi data pelapor, kondisi pasien, dan lokasi. Informasi dijamin kerahasiaannya.</p>
            @break

        @case('pendidikan')
            <h2>Bantuan Pendidikan</h2>
            <p>Program Bantuan Pendidikan mendukung anak‑anak dari keluarga kurang mampu melalui bantuan perlengkapan sekolah, biaya pendidikan, atau pendampingan belajar. Pendaftaran dapat dilakukan secara online dengan melampirkan data pendukung seperti keterangan sekolah atau kondisi ekonomi.</p>
            @break

        @case('sosial-umum')
            <h2>Bantuan Sosial Umum</h2>
            <p>Layanan Bantuan Sosial Umum mencakup bantuan untuk lansia terlantar, korban bencana, pendampingan sosial, dan bantuan darurat lainnya. Pendaftaran online memungkinkan masyarakat mengajukan bantuan dengan mudah; data diverifikasi sebelum bantuan disalurkan.</p>
            @break

        @default
            <p>Pilih salah satu jenis layanan untuk melihat penjelasan lengkap. Tersedia layanan <strong>Kesehatan Jiwa</strong>, <strong>Pendidikan</strong>, dan <strong>Sosial Umum</strong>.</p>
    @endswitch

    <a href="{{ route('formlayanan', $layananSlug) }}" class="btn btn-primary mt-3">Lanjut ke Form Layanan</a>
</div>
@endsection

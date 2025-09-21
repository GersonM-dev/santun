@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    {{-- Tampilkan gambar penuh dari koleksi kegiatan jika tersedia --}}
    @if(isset($kegiatanImages) && count($kegiatanImages) > 0)
    <div class="w-full mb-6">
        <img src="{{ asset('storage/' . $kegiatanImages[0]->gambar) }}" alt="{{ $kegiatanImages[0]->name }}" class="w-full h-80 object-cover rounded-lg shadow-md" />
    </div>
    @endif

    {{-- Informasi layanan berdasarkan slug --}}
    <div class="space-y-4">
        @switch($layananSlug)
            @case('kesehatan-jiwa')
                <h1 class="text-2xl font-bold mb-2">Pendaftaran Layanan Bantuan Khusus Kesehatan Jiwa (ODGJ)</h1>
                <p>Relawan ODGJ Baturaden menyediakan layanan bantuan khusus bagi masyarakat yang membutuhkan pendampingan dan penanganan terhadap Orang Dengan Gangguan Jiwa (ODGJ). Layanan ini ditujukan untuk membantu keluarga atau individu yang mengalami kesulitan dalam mengelola kondisi gangguan jiwa.</p>
                <p>Pendaftaran layanan ini terbuka bagi:</p>
                <ul class="list-disc list-inside">
                    <li>Keluarga atau kerabat yang memiliki anggota dengan kondisi gangguan jiwa.</li>
                    <li>Masyarakat umum yang menemukan kasus ODGJ di lingkungan sekitarnya.</li>
                </ul>
                <p>Pendaftaran layanan ini dapat dilakukan secara online melalui website ini dengan mengisi formulir pendaftaran yang tersedia. Informasi yang dibutuhkan mencakup identitas pelapor, kondisi pasien, dan lokasi tempat tinggal. Setelah pendaftaran dikirimkan, tim relawan akan melakukan verifikasi dan menghubungi pelapor untuk tindak lanjut.</p>
                <p>Kami menjamin setiap informasi yang diberikan akan dijaga kerahasiaannya dan digunakan hanya untuk keperluan pelayanan. Dengan sistem pendaftaran ini, kami berharap proses penanganan pasien ODGJ menjadi lebih cepat, tepat, dan terkoordinasi.</p>
                @break
            @case('pendidikan')
                <h1 class="text-2xl font-bold mb-2">Pendaftaran Layanan Bantuan Pendidikan</h1>
                <p>Relawan ODGJ Baturaden juga peduli terhadap akses pendidikan, khususnya bagi anak-anak dari keluarga kurang mampu. Melalui program Bantuan Pendidikan, kami berupaya memberikan dukungan agar anak-anak tetap bisa melanjutkan pendidikan mereka dengan layak.</p>
                <p>Pendaftaran layanan ini mencakup:</p>
                <ul class="list-disc list-inside">
                    <li>Bantuan perlengkapan sekolah seperti seragam, tas, dan alat tulis.</li>
                    <li>Bantuan biaya pendidikan untuk siswa kurang mampu.</li>
                    <li>Pendampingan belajar atau program dukungan non-formal.</li>
                </ul>
                <p>Bagi masyarakat yang ingin mengajukan bantuan pendidikan, pendaftaran dapat dilakukan melalui website ini dengan mengisi formulir pendaftaran dan melampirkan data pendukung. Tim kami akan melakukan verifikasi dan seleksi berdasarkan kebutuhan dan ketersediaan bantuan.</p>
                @break
            @case('sosial-umum')
                <h1 class="text-2xl font-bold mb-2">Pendaftaran Layanan Bantuan Sosial Umum</h1>
                <p>Layanan Bantuan Sosial Umum merupakan bentuk kepedulian Relawan ODGJ Baturaden terhadap masyarakat yang membutuhkan uluran tangan, terutama dalam kondisi darurat atau kesulitan ekonomi. Layanan ini mencakup berbagai bentuk bantuan di luar penanganan ODGJ.</p>
                <p>Pendaftaran layanan ini terbuka bagi:</p>
                <ul class="list-disc list-inside">
                    <li>Keluarga — bantuan untuk lansia terlantar.</li>
                    <li>Korban kecelakaan atau bencana.</li>
                    <li>Pendampingan sosial dan kebutuhan mendesak lainnya.</li>
                </ul>
                <p>Melalui pendaftaran online, masyarakat dapat mengajukan permohonan bantuan dengan mudah. Tim relawan akan melakukan verifikasi dan tindak lanjut sesuai jenis bantuan yang dibutuhkan.</p>
                @break
            @default
                <h1 class="text-2xl font-bold mb-2">Pendaftaran Layanan</h1>
                <p>Pilih salah satu jenis layanan untuk melihat detailnya.</p>
        @endswitch
        <a href="{{ route('formlayanan', $layananSlug) }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lanjut ke Form Layanan</a>
    </div>

    {{-- Carousel gambar kegiatan --}}
    @if(isset($kegiatanImages) && count($kegiatanImages) > 1)
    <div class="mt-8">
        <div id="kegiatanCarousel" class="relative overflow-hidden rounded-lg shadow-md">
            @foreach($kegiatanImages as $index => $kg)
                <div class="carousel-item @if($index !== 0) hidden @endif">
                    <img src="{{ asset('storage/' . $kg->gambar) }}" alt="{{ $kg->name }}" class="w-full h-64 object-cover" />
                    <div class="absolute bottom-4 left-4 bg-white bg-opacity-70 p-2 rounded text-sm font-medium">
                        {{ $kg->name }}
                    </div>
                </div>
            @endforeach
            <button id="prevKgBtn" type="button" class="absolute top-1/2 left-2 -translate-y-1/2 bg-black/50 text-white p-1 rounded-full hover:bg-black/70">‹</button>
            <button id="nextKgBtn" type="button" class="absolute top-1/2 right-2 -translate-y-1/2 bg-black/50 text-white p-1 rounded-full hover:bg-black/70">›</button>
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('#kegiatanCarousel .carousel-item');
    if (!items.length) return;
    let idx = 0;
    function show(i) {
        items.forEach((el, k) => el.classList.toggle('hidden', k !== i));
    }
    const prevBtn = document.getElementById('prevKgBtn');
    const nextBtn = document.getElementById('nextKgBtn');
    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            idx = (idx - 1 + items.length) % items.length;
            show(idx);
        });
        nextBtn.addEventListener('click', () => {
            idx = (idx + 1) % items.length;
            show(idx);
        });
    }
    setInterval(() => {
        idx = (idx + 1) % items.length;
        show(idx);
    }, 5000);
});
</script>
@endsection
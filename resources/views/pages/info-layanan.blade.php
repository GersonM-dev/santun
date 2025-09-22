@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">

    <section class="flex flex-col justify-between gap-6 sm:gap-10 md:gap-16 lg:flex-row p-4 rounded-lg">
        <!-- content - start -->
        <div class="flex flex-col justify-center ms-12 sm:text-center lg:py-12 lg:text-left xl:w-5/12 xl:py-24">
            @switch($layananSlug)
                @case('kesehatan-jiwa')
                    <h1 class="mb-4 text-xl font-bold text-left text-gray-700 leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                        Pendaftaran Layanan Bantuan Khusus Kesehatan Jiwa (ODGJ)
                    </h1>
                    <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-6 xl:text-md max-w-lg">
                        Relawan ODGJ Baturaden menyediakan layanan bantuan khusus bagi masyarakat yang membutuhkan pendampingan
                        dan penanganan terhadap Orang Dengan Gangguan Jiwa (ODGJ).
                    </p>
                    <p class="leading-relaxed text-left text-gray-600 max-w-lg">
                        Layanan ini ditujukan untuk membantu keluarga atau individu yang mengalami kesulitan dalam
                        mengelola kondisi gangguan jiwa. Pendaftaran terbuka bagi keluarga/kerabat dan masyarakat yang
                        menemukan kasus ODGJ di lingkungan sekitarnya. Setelah formulir dikirim, tim akan melakukan
                        verifikasi dan menghubungi pelapor untuk tindak lanjut.
                    </p>
                    @break

                @case('pendidikan')
                    <h1 class="mb-4 text-xl font-bold text-left text-gray-700 leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                        Pendaftaran Layanan Bantuan Pendidikan
                    </h1>
                    <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-6 xl:text-md max-w-lg">
                        Kami peduli terhadap akses pendidikan, khususnya bagi anak-anak dari keluarga kurang mampu.
                    </p>
                    <ul class="mb-3 list-disc pl-5 text-left text-gray-600 leading-relaxed max-w-lg">
                        <li>Bantuan perlengkapan sekolah (seragam, tas, alat tulis).</li>
                        <li>Bantuan biaya pendidikan untuk siswa kurang mampu.</li>
                        <li>Pendampingan belajar / dukungan non-formal.</li>
                    </ul>
                    <p class="leading-relaxed text-left text-gray-600 max-w-lg">
                        Ajukan bantuan melalui formulir pendaftaran dan lampirkan data pendukung. Tim kami akan
                        melakukan verifikasi dan seleksi berdasarkan kebutuhan serta ketersediaan bantuan.
                    </p>
                    @break

                @case('sosial-umum')
                    <h1 class="mb-4 text-xl font-bold text-left text-gray-700 leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                        Pendaftaran Layanan Bantuan Sosial Umum
                    </h1>
                    <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-6 xl:text-md max-w-lg">
                        Bentuk kepedulian Relawan ODGJ Baturaden terhadap kebutuhan sosial di masyarakat.
                    </p>
                    <ul class="mb-3 list-disc pl-5 text-left text-gray-600 leading-relaxed max-w-lg">
                        <li>Bantuan untuk lansia terlantar.</li>
                        <li>Dukungan untuk korban kecelakaan atau bencana.</li>
                        <li>Pendampingan sosial dan kebutuhan mendesak lainnya.</li>
                    </ul>
                    <p class="leading-relaxed text-left text-gray-600 max-w-lg">
                        Ajukan permohonan bantuan secara online. Tim akan melakukan verifikasi dan tindak lanjut sesuai
                        jenis bantuan yang dibutuhkan.
                    </p>
                    @break

                @default
                    <h1 class="mb-4 text-xl font-bold text-left text-gray-700 leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                        Selangkah Lebih Dekat <br> Menuju Kepedulian Nyata
                    </h1>
                    <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-12 xl:text-md max-w-lg">
                        Pilih salah satu jenis layanan untuk melihat detail dan mengisi formulir pendaftaran.
                    </p>
            @endswitch

            <a href="{{ route('formlayanan', $layananSlug) }}"
               class="mt-6 inline-block rounded bg-blue-600 px-5 py-2.5 font-medium text-white hover:bg-blue-700">
                Lanjut ke Form Layanan
            </a>
        </div>
        <!-- content - end -->

        <!-- carousel image - start -->
        <div class="h-48 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:h-auto xl:w-5/12 relative mb-4">
            <div id="carousel-images" class="h-full w-full relative">
                @if(isset($kegiatanImages) && count($kegiatanImages) > 0)
                    @foreach($kegiatanImages as $i => $kg)
                        <img
                            src="{{ asset('storage/' . $kg->gambar) }}"
                            alt="{{ $kg->name }}"
                            class="carousel-img absolute inset-0 h-full w-full object-cover object-center transition-opacity duration-700 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
                            style="z-index: {{ count($kegiatanImages) - $i }};"
                            loading="lazy"
                        />
                    @endforeach
                @else
                    {{-- Placeholder jika belum ada gambar --}}
                    <div class="absolute inset-0 grid place-content-center text-gray-400">
                        <div class="text-sm">Belum ada dokumentasi kegiatan</div>
                    </div>
                @endif
            </div>

            {{-- optional label on top-left of carousel --}}
            @if(isset($kegiatanImages) && count($kegiatanImages) > 0)
                <div class="pointer-events-none absolute left-2 top-2 rounded bg-white/70 px-2 py-1 text-xs font-medium shadow">
                    Kegiatan Terbaru
                </div>
            @endif
        </div>
        <!-- carousel image - end -->
    </section>

    {{-- (Optional) Caption strip under carousel for active image name --}}
    @if(isset($kegiatanImages) && count($kegiatanImages) > 0)
        <div class="mt-2 text-sm text-gray-600">
            <span id="carousel-caption">{{ $kegiatanImages[0]->name }}</span>
        </div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const imgs = Array.from(document.querySelectorAll('#carousel-images .carousel-img'));
    if (!imgs.length) return;

    const captionEl = document.getElementById('carousel-caption');
    let idx = 0;

    function show(i) {
        imgs.forEach((img, k) => {
            img.classList.toggle('opacity-100', k === i);
            img.classList.toggle('opacity-0',   k !== i);
        });
        if (captionEl) captionEl.textContent = imgs[i].getAttribute('alt') || '';
    }

    // Auto-rotate every 5s
    setInterval(() => {
        idx = (idx + 1) % imgs.length;
        show(idx);
    }, 5000);
});
</script>
@endsection

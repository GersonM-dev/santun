@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">

    <section class="flex flex-col justify-between gap-6 sm:gap-10 md:gap-16 lg:flex-row p-4 rounded-lg">
        <!-- content - start -->
        <div class="flex flex-col justify-center ms-12 sm:text-center lg:py-12 lg:text-left xl:w-5/12 xl:py-24">
            @if($mode === 'materi')
                <h1 class="mb-4 text-left text-gray-700 text-xl font-bold leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                    Informasi Donasi Materi
                </h1>
                <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-6 xl:text-md max-w-lg">
                    Donasi materi adalah bantuan berupa uang atau barang bernilai ekonomis untuk mendukung layanan kemanusiaan Relawan ODGJ Baturaden.
                </p>
                <p class="leading-relaxed text-left text-gray-600 max-w-lg">
                    <strong>Donasi Uang:</strong> dapat disalurkan tunai atau transfer bank untuk biaya operasional, perawatan pasien, pengadaan perlengkapan kesehatan, dukungan pendidikan, dan kegiatan sosial lainnya.
                    <br><em>Rekening: Bank BRI — No. 12345678 — a.n. Muhajianto</em>
                </p>
                <p class="mt-3 leading-relaxed text-left text-gray-600 max-w-lg">
                    <strong>Donasi Barang:</strong> kebutuhan pokok, perlengkapan kesehatan, pakaian layak pakai, perlengkapan sekolah, dll.
                    Donasi dapat dikirim ke: Relawan ODGJ Baturaden, Desa Kemutug Kidul, Gg. Banowati No. 17, RT 04/RW 03, Kec. Baturaden, Kab. Banyumas, Jawa Tengah.
                </p>
            @elseif($mode === 'non-materi')
                <h1 class="mb-4 text-left text-gray-700 text-xl font-bold leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                    Informasi Donasi Non&nbsp;Materi
                </h1>
                <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-6 xl:text-md max-w-lg">
                    Donasi non-materi berupa tenaga, waktu, pemikiran, atau keahlian yang berdampak besar bagi keberlangsungan kegiatan sosial.
                </p>
                <ul class="mb-3 list-disc pl-5 text-left text-gray-600 leading-relaxed max-w-lg">
                    <li><strong>Tenaga:</strong> membantu di lapangan, mendampingi pasien ODGJ, menyalurkan bantuan.</li>
                    <li><strong>Waktu:</strong> ikut kunjungan pasien, pendampingan belajar, kegiatan sosial.</li>
                    <li><strong>Pemikiran:</strong> ide & saran pengembangan program.</li>
                    <li><strong>Keahlian:</strong> konseling, pelatihan, layanan kesehatan, dsb.</li>
                </ul>
                <p class="leading-relaxed text-left text-gray-600 max-w-lg">
                    Partisipasi Anda menjadi bagian penting untuk membangun masyarakat yang lebih peduli dan saling mendukung.
                </p>
            @else
                <h1 class="mb-4 text-left text-gray-700 text-xl font-bold leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                    Selangkah Lebih Dekat <br> Menuju Kepedulian Nyata
                </h1>
                <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-12 xl:text-md max-w-lg">
                    Pilih jenis donasi: <strong>Materi</strong> atau <strong>Non-Materi</strong>. Setelah memilih, Anda akan melihat penjelasan singkat sesuai pilihan.
                </p>
            @endif

            <a href="{{ route('formdonasi', $mode) }}"
               class="mt-6 inline-block rounded bg-blue-600 px-5 py-2.5 font-medium text-white hover:bg-blue-700">
                Lanjut ke Form Donasi
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
                    <div class="absolute inset-0 grid place-content-center text-gray-400">
                        <div class="text-sm">Belum ada dokumentasi kegiatan</div>
                    </div>
                @endif
            </div>

            @if(isset($kegiatanImages) && count($kegiatanImages) > 1)
                <!-- nav arrows -->
                <button id="prevDonasiBtn" type="button"
                        class="absolute top-1/2 left-2 -translate-y-1/2 rounded-full bg-black/50 p-1 text-white hover:bg-black/70"
                        aria-label="Sebelumnya">‹</button>
                <button id="nextDonasiBtn" type="button"
                        class="absolute top-1/2 right-2 -translate-y-1/2 rounded-full bg-black/50 p-1 text-white hover:bg-black/70"
                        aria-label="Berikutnya">›</button>
            @endif

            @if(isset($kegiatanImages) && count($kegiatanImages) > 0)
                <div class="pointer-events-none absolute left-2 top-2 rounded bg-white/70 px-2 py-1 text-xs font-medium shadow">
                    Dokumentasi Kegiatan
                </div>
            @endif
        </div>
        <!-- carousel image - end -->
    </section>

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
    const prevBtn = document.getElementById('prevDonasiBtn');
    const nextBtn = document.getElementById('nextDonasiBtn');

    let idx = 0;

    function show(i) {
        imgs.forEach((img, k) => {
            img.classList.toggle('opacity-100', k === i);
            img.classList.toggle('opacity-0',   k !== i);
        });
        if (captionEl) captionEl.textContent = imgs[i].getAttribute('alt') || '';
    }

    if (prevBtn && nextBtn && imgs.length > 1) {
        prevBtn.addEventListener('click', () => {
            idx = (idx - 1 + imgs.length) % imgs.length;
            show(idx);
        });
        nextBtn.addEventListener('click', () => {
            idx = (idx + 1) % imgs.length;
            show(idx);
        });
    }

    if (imgs.length > 1) {
        setInterval(() => {
            idx = (idx + 1) % imgs.length;
            show(idx);
        }, 5000);
    }
});
</script>
@endsection

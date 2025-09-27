@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="flex flex-col justify-between gap-6 sm:gap-10 md:gap-16 lg:flex-row p-4 rounded-lg">
        <!-- content - start -->
        <div class="flex flex-col justify-center ms-12 sm:text-center lg:py-12 lg:text-left xl:w-5/12 xl:py-24">
            <h1 class="mb-4 text-xl font-bold text-left text-gray-700 leading-tight sm:text-2xl md:mb-8 md:text-5xl">
                Selangkah Lebih Dekat <br> Menuju Kepedulian Nyata
            </h1>
            <p class="hidden md:block mb-8 leading-relaxed text-left text-gray-500 md:mb-12 xl:text-md max-w-lg">
                Mari wujudkan transparansi dan kemudahan dalam aksi sosial melalui SANTUN - Sistem Informasi Terpadu untuk
                Relawan ODGJ Baturaden.
            </p>
        </div>
        <!-- content - end -->

        <!-- carousel image - start -->
        <div class="h-48 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:h-auto xl:w-5/12 relative mb-4">
            <div id="carousel-images" class="h-full w-full relative">
                <img src="{{ asset('image/1.jpg') }}"
                    class="carousel-img absolute inset-0 h-full w-full object-cover object-center opacity-100 transition-opacity duration-700"
                    style="z-index:2" alt="Photo 1" loading="lazy" />
                <img src="{{ asset('image/2.jpg') }}"
                    class="carousel-img absolute inset-0 h-full w-full object-cover object-center opacity-0 transition-opacity duration-700"
                    style="z-index:1" alt="Photo 2" loading="lazy" />
                <img src="{{ asset('image/5.jpg') }}"
                    class="carousel-img absolute inset-0 h-full w-full object-cover object-center opacity-0 transition-opacity duration-700"
                    style="z-index:0" alt="Photo 3" loading="lazy" />
            </div>
        </div>
        <!-- carousel image - end -->
    </section>

    <!-- Tentang Kami -->
    <section class="py-8 sm:py-12 lg:py-16">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="grid items-center gap-8 lg:grid-cols-2">
                <!-- Kiri: Gambar/Logo -->
                <div class="flex justify-center">
                    <img src="{{ asset('logo.PNG') }}" alt="Relawan ODGJ Baturraden"
                        class="w-72 h-72 object-contain sm:w-80 sm:h-80" loading="lazy" />
                </div>

                <!-- Kanan: Teks & Fitur -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Tentang Kami</h2>

                    <p class="mt-4 max-w-2xl text-gray-600 leading-relaxed">
                        Relawan ODGJ Baturraden adalah organisasi sosial yang bergerak di bidang kesehatan jiwa, pendidikan,
                        dan sosial kemasyarakatan, berlokasi di Desa Kemutug Kidul, Banyumas. Kami mendampingi pasien ODGJ,
                        membantu lansia dan korban kecelakaan, serta mendukung pendidikan anak-anak kurang mampu.
                    </p>
                    <p class="mt-3 max-w-2xl text-gray-600 leading-relaxed">
                        Sejak tahun 2009, kami hadir untuk menjembatani empati dan aksi nyata—mengajak masyarakat
                        bersama-sama merawat, menyembuhkan, dan memberdayakan mereka yang terlupakan.
                    </p>

                    <!-- Fitur -->
                    <div class="mt-6 space-y-4">
                        <!-- Item 1 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 ring-1 ring-blue-100">
                                <!-- Icon form/layanan -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M6 2a2 2 0 0 0-2 2v16l4-2 4 2 4-2 4 2V4a2 2 0 0 0-2-2H6z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Pendaftaran Layanan Bantuan</div>
                                <div class="text-sm text-gray-500">Pendaftaran layanan bantuan kesehatan jiwa (ODGJ),
                                    pendidikan dan sosial.</div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 ring-1 ring-cyan-100">
                                <!-- Icon donasi -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M12 21s-8-4.438-8-11a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 6.562-8 11-8 11z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Penggalangan Donasi</div>
                                <div class="text-sm text-gray-500">Donasi Materi dan Non-Materi.</div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="mt-8 border-t border-blue-200 pt-4">
                        <a href="{{ route('about') }}"
                            class="inline-flex items-center gap-2 font-medium text-blue-700 hover:text-blue-800">
                            Pelajari lebih lanjut tentang perjuangan kami
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Kegiatan Sosial -->
    <div class="py-6 sm:py-8 lg:py-12 mt-6 rounded-lg">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-6 flex items-end justify-between gap-4">
                <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl">Kegiatan Sosial</h2>
                <a href="{{ route('kegiatan') }}"
                    class="inline-block rounded-lg border bg-white px-4 py-2 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:px-8 md:py-3 md:text-base">
                    Show more
                </a>
            </div>

            <div
                class="grid gap-x-4 gap-y-6 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4 mt-6 border-t border-gray-400 pt-6">
                @foreach($kegiatans as $kegiatan)
                    <div>
                        <a href="{{ route('kegiatan.detail', ['id' => $kegiatan->id]) }}"
                            class="group mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3">
                            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" loading="lazy" alt="{{ $kegiatan->name }}"
                                class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                        </a>
                        <div class="flex flex-col">
                            <span class="text-gray-500">{{ \Carbon\Carbon::parse($kegiatan->date)->format('d M Y') }}</span>
                            <div class="text-lg font-bold text-gray-800 lg:text-xl">
                                {{ $kegiatan->name }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Layanan Bantuan -->
    <div class="py-6 sm:py-8 lg:py-12 border-t border-gray-400 mt-6 rounded-lg">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-5 md:mb-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Layanan Bantuan</h2>

                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                    Masyarakat dapat mendaftar berbagai layanan bantuan yang tersedia, mulai dari kesehatan jiwa,
                    pendidikan, hingga bantuan sosial umum. Kami siap mendampingi dan membantu setiap kebutuhan dengan penuh
                    kepedulian.
                </p>
            </div>
            <!-- text - end -->

            <div class="grid gap-6 sm:grid-cols-3">
                <!-- product - start -->
                <a href="{{ route('info.layanan', 'kesehatan-jiwa') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="{{ asset('odgj.PNG') }}" loading="lazy" alt="Bantuan Khusus Kesehatan Jiwa"
                        class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                    <div
                        class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                    </div>

                    <div class="relative flex flex-col">
                        <span class="text-gray-300">Bantuan Khusus Kesehatan Jiwa</span>
                    </div>
                </a>
                <!-- product - end -->

                <!-- product - start -->
                <a href="{{ route('info.layanan', 'pendidikan') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="{{ asset('pendidikan.PNG') }}" loading="lazy" alt="Bantuan Pendidikan"
                        class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                    <div
                        class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                    </div>

                    <div class="relative flex flex-col">
                        <span class="text-gray-300">Bantuan Pendidikan</span>
                    </div>
                </a>
                <!-- product - end -->

                <!-- product - start -->
                <a href="{{ route('info.layanan', 'sosial-umum') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="{{ asset('sosial.PNG') }}" loading="lazy" alt="Bantuan Sosial Umum"
                        class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                    <div
                        class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                    </div>

                    <div class="relative flex flex-col">
                        <span class="text-gray-300">Bantuan Sosial Umum</span>
                    </div>
                </a>
                <!-- product - end -->
            </div>
        </div>
    </div>

    <!-- Penggalangan Donasi -->
    <div class=" py-6 sm:py-8 lg:py-12 border-t border-gray-400 mt-6 rounded-lg">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-5 md:mb-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Penggalangan Donasi</h2>

                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                    Mari berkontribusi untuk kebaikan bersama melalui penggalangan donasi. Dukungan Anda, baik berupa uang,
                    barang, maupun tenaga, akan sangat berarti dalam membantu ODGJ serta masyarakat yang membutuhkan. Setiap
                    donasi yang terkumpul akan disalurkan secara transparan dan tepat sasaran, agar kebaikan bisa dirasakan
                    langsung oleh mereka yang membutuhkan.
                </p>
            </div>
            <!-- text - end -->

            <div class="grid gap-6 sm:grid-cols-2">
                <!-- product - start -->
                <a href="{{ route('info.donasi', 'materi') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="{{ asset('donasi materi.PNG') }}" loading="lazy" alt="Photo by Fakurian Design"
                        class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                    <div
                        class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                    </div>

                    <div class="relative flex flex-col">
                        <span class="text-gray-300">Donasi Materi</span>
                    </div>
                </a>
                <!-- product - end -->

                <!-- product - start -->
                <a href="{{ route('info.donasi', 'non-materi') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="{{ asset('donasi non-materi.PNG') }}" loading="lazy" alt="Photo by Fakurian Design"
                        class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                    <div
                        class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50">
                    </div>

                    <div class="relative flex flex-col">
                        <span class="text-gray-300">Donasi Non Materi</span>
                    </div>
                </a>
                <!-- product - end -->
            </div>
        </div>
    </div>

    <!-- Catatan Donasi -->
    <div class="py-6 sm:py-8 lg:py-12 mb-4">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl xl:mb-12">Catatan Donasi</h2>

            @if ($donasiCatatan->isNotEmpty())
                <div class="relative">
                    <button id="donasi-prev" type="button" aria-label="Donasi sebelumnya"
                        class="absolute left-0 top-1/2 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow transition hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-cyan-500 sm:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <div id="donasi-slider" class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-2 pl-1 pr-1 sm:pl-12 sm:pr-12 lg:pb-4">
                        @foreach ($donasiCatatan as $donasi)
                            @php
                                $displayName = $donasi->is_anonymous ? 'Donatur Anonim' : ($donasi->name ?: 'Donatur');
                                $tanggal = $donasi->date ? \Carbon\Carbon::parse($donasi->date) : $donasi->created_at;
                                $displayDate = optional($tanggal)->translatedFormat('d F Y');
                                $tujuan = $donasi->tujuanDonasi?->name;
                                $typeLabel = $donasi->type;
                                $catatan = trim((string) $donasi->catatan);
                            @endphp

                            <div class="flex min-w-[17rem] flex-shrink-0 flex-col gap-3 rounded-lg border bg-white p-4 shadow-sm transition hover:shadow-md sm:min-w-[20rem] md:p-6 snap-start">
                                <div>
                                    <span class="block text-sm font-bold md:text-base">{{ $displayName }}</span>
                                    @if ($displayDate)
                                        <span class="block text-sm text-gray-500">{{ $displayDate }}</span>
                                    @endif

                                    <div class="mt-2 flex flex-wrap gap-2 text-xs text-gray-500">
                                        @if ($typeLabel)
                                            <span class="rounded-full bg-cyan-50 px-2 py-1 font-medium text-cyan-600">{{ $typeLabel }}</span>
                                        @endif
                                        @if ($tujuan)
                                            <span class="rounded-full bg-gray-100 px-2 py-1">{{ $tujuan }}</span>
                                        @endif
                                    </div>
                                </div>

                                <p class="text-gray-600">
                                    {{ $catatan !== '' ? \Illuminate\Support\Str::limit($catatan, 200) : 'Tidak ada catatan tambahan.' }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <button id="donasi-next" type="button" aria-label="Donasi selanjutnya"
                        class="absolute right-0 top-1/2 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 shadow transition hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-cyan-500 sm:flex">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            @else
                <div class="flex flex-col items-center justify-center gap-2 rounded-lg border border-dashed p-6 text-center text-gray-500">
                    <span class="text-lg font-medium">Catatan donasi belum tersedia.</span>
                    <p class="text-sm">Jadilah yang pertama menyampaikan pesan kebaikan melalui donasi Anda.</p>
                </div>
            @endif
        </div>
    </div>

    
<!-- Carousel Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = document.querySelectorAll('#carousel-images .carousel-img');
            let current = 0;
            setInterval(() => {
                images[current].classList.remove('opacity-100');
                images[current].classList.add('opacity-0');
                current = (current + 1) % images.length;
                images[current].classList.remove('opacity-0');
                images[current].classList.add('opacity-100');
            }, 3500); // Change image every 3.5 seconds

            const donasiSlider = document.getElementById('donasi-slider');
            const donasiPrev = document.getElementById('donasi-prev');
            const donasiNext = document.getElementById('donasi-next');

            if (donasiSlider && donasiPrev && donasiNext) {
                const toggleButtonState = (button, disabled) => {
                    button.disabled = disabled;
                    button.classList.toggle('opacity-40', disabled);
                    button.classList.toggle('cursor-not-allowed', disabled);
                    button.classList.toggle('pointer-events-none', disabled);
                };

                const updateDonasiNavState = () => {
                    const maxScrollLeft = donasiSlider.scrollWidth - donasiSlider.clientWidth;
                    const disablePrev = donasiSlider.scrollLeft <= 0;
                    const disableNext = donasiSlider.scrollLeft >= (maxScrollLeft - 1);
                    toggleButtonState(donasiPrev, disablePrev || maxScrollLeft <= 0);
                    toggleButtonState(donasiNext, disableNext || maxScrollLeft <= 0);
                };

                const scrollAmount = () => Math.max(donasiSlider.clientWidth * 0.9, 200);
                const smoothScroll = (offset) => {
                    donasiSlider.scrollBy({ left: offset, behavior: 'smooth' });
                };

                donasiPrev.addEventListener('click', () => smoothScroll(-scrollAmount()));
                donasiNext.addEventListener('click', () => smoothScroll(scrollAmount()));

                const onScroll = () => window.requestAnimationFrame(updateDonasiNavState);
                donasiSlider.addEventListener('scroll', onScroll, { passive: true });
                window.addEventListener('resize', updateDonasiNavState);
                updateDonasiNavState();
            }
        });
    </script>
@endsection

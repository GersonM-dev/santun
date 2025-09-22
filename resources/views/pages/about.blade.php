@extends('layouts.app')

@section('content')
    <section class="py-10 sm:py-14 lg:py-16">
        @php
            /** @var \App\Models\AboutUs|null $about */
            $about = $about ?? \App\Models\AboutUs::query()->first();
            $title = $about->title ?? 'Tentang Kami';
            $logo = asset('logo.PNG'); // logo always first
            $struktur = !empty($about?->struktur) ? asset('storage/' . $about->struktur) : null;

            // STATIC Street View embed (as requested)
            $STATIC_EMBED = 'https://www.google.com/maps/embed?pb=!4v1758514234476!6m8!1m7!1sOr70pVQso5ZZA_ukU3lnLw!2m2!1d-7.344459464030086!2d109.2388455258094!3f239.71447180589035!4f-14.754068982584883!5f0.4000000000000002';
        @endphp

        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">

            {{-- 1) LOGO (Top, centered) --}}
            <section class="py-8 sm:py-12 lg:py-16">
                <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                    <div class="grid items-center gap-8 lg:grid-cols-2">
                        <!-- Kiri: Gambar/Logo -->
                        <div class="flex justify-center">
                            <img src="{{ $logo }}" alt="Relawan ODGJ Baturraden"
                                 class="w-72 h-72 object-contain sm:w-80 sm:h-80" loading="lazy" />
                        </div>

                        <!-- Kanan: Teks & Fitur -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Tentang Kami</h2>

                            <p class="mt-4 max-w-2xl text-gray-600 leading-relaxed">
                                Relawan ODGJ Baturraden adalah organisasi sosial yang bergerak di bidang kesehatan jiwa,
                                pendidikan,
                                dan sosial kemasyarakatan, berlokasi di Desa Kemutug Kidul, Banyumas. Kami mendampingi
                                pasien ODGJ,
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
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 ring-1 ring-blue-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
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
                                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 ring-1 ring-cyan-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2) CONTENT ROW: Left = Visi & Misi, Right = Struktur --}}
            <div class="mt-10 grid items-start gap-10 lg:grid-cols-2">
                <!-- Left: Visi & Misi (dynamic, justified) -->
                <div>
                    @if(!empty($about?->visi))
                        <h3 class="mt-6 text-xl font-semibold text-gray-900">Visi</h3>
                        <div class="mt-2 text-gray-700 leading-relaxed text-justify">
                            {!! $about->visi !!}
                        </div>
                    @endif

                    @if(!empty($about?->misi))
                        <h3 class="mt-6 text-xl font-semibold text-gray-900">Misi</h3>
                        <div class="mt-2 text-gray-700 leading-relaxed text-justify">
                            {!! $about->misi !!}
                        </div>
                    @endif
                </div>

                <!-- Right: Struktur image (dynamic) with title ABOVE -->
                <div class="flex justify-center lg:justify-end">
                    @if($struktur)
                        <figure class="w-full max-w-xl">
                            <figcaption class="mb-4 text-center lg:text-right text-2xl font-semibold text-gray-900">
                                Struktur Organisasi
                            </figcaption>
                            <div class="rounded-2xl bg-white p-4 shadow-lg ring-1 ring-gray-200">
                                <img src="{{ $struktur }}" alt="Struktur Organisasi"
                                     class="h-[28rem] w-auto max-w-full object-contain" loading="lazy" />
                            </div>
                        </figure>
                    @else
                        <div class="rounded-xl border border-dashed p-8 text-gray-400">
                            Belum ada gambar struktur.
                        </div>
                    @endif
                </div>
            </div>

            {{-- 3) MAP (Centered, static embed) with title ABOVE --}}
            <div class="mt-12 flex justify-center">
                <div class="w-full max-w-4xl">
                    <h3 class="mb-4 text-center text-2xl font-semibold text-gray-900">Lokasi</h3>
                    <div class="overflow-hidden rounded-lg border">
                        <div class="aspect-video">
                            <iframe src="{{ $STATIC_EMBED }}" class="h-full w-full border-0" allowfullscreen loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

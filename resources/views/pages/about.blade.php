@extends('layouts.app')

@section('content')
    @php
        // Pakai $about dari controller jika ada; jika belum, ambil entri tunggal langsung dari model.
        /** @var \App\Models\AboutUs|null $about */
        $about = $about ?? \App\Models\AboutUs::query()->first();
    @endphp

    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-md px-4 md:px-8">

            {{-- Judul --}}
            <h1 class="mb-4 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-6">
                {{ $about?->title ?? 'Tentang Kami' }}
            </h1>

            @if(! $about)
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-yellow-700">
                    Belum ada data <em>About Us</em>. Silakan isi dari panel admin (Filament).
                </div>
            @else
                {{-- Struktur Organisasi (Gambar) --}}
                @if(!empty($about->struktur))
                    <div class="relative mb-8 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:mb-10">
                        <img
                            src="{{ asset('storage/'.$about->struktur) }}"
                            loading="lazy"
                            alt="Struktur Organisasi"
                            class="h-full w-full max-h-[560px] bg-white object-contain"
                        />
                    </div>
                @endif

                {{-- Visi --}}
                @if(!empty($about->visi))
                    <h2 class="mb-2 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4">Visi</h2>
                    <div class="mb-6 text-gray-600 sm:text-lg md:mb-8">
                        {!! $about->visi !!}
                    </div>
                @endif

                {{-- Misi --}}
                @if(!empty($about->misi))
                    <h2 class="mb-2 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4">Misi</h2>
                    <div class="mb-6 text-gray-600 sm:text-lg md:mb-8">
                        {!! $about->misi !!}
                    </div>
                @endif

                {{-- Alamat (Link Google Maps / Embed jika sudah berupa link embed) --}}
                @if(!empty($about->alamat))
                    <h2 class="mb-2 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4">Alamat</h2>

                    <p class="mb-4 text-gray-600 sm:text-lg">
                        <a href="{{ $about->alamat }}" target="_blank" rel="noopener"
                           class="text-indigo-600 underline hover:text-indigo-700">
                            Buka di Google Maps
                        </a>
                    </p>

                    @php
                        // Jika alamat sudah berupa URL embed Maps, tampilkan iframe.
                        $isEmbed = str_contains($about->alamat, 'google') && str_contains($about->alamat, 'maps') && str_contains($about->alamat, 'embed');
                    @endphp

                    @if($isEmbed)
                        <div class="aspect-video w-full overflow-hidden rounded-lg border">
                            <iframe
                                src="{{ $about->alamat }}"
                                class="h-full w-full border-0"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @endif
                @endif
            @endif

        </div>
    </div>
@endsection

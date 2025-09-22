@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\AboutUs|null $about */
        $about = $about ?? \App\Models\AboutUs::query()->first();

        // STATIC MAPS (embed + optional "open in maps" link)
    $STATIC_EMBED = 'https://www.google.com/maps/embed?pb=!4v1758514234476!6m8!1m7!1sOr70pVQso5ZZA_ukU3lnLw!2m2!1d-7.344459464030086!2d109.2388455258094!3f239.71447180589035!4f-14.754068982584883!5f0.4000000000000002';
    $STATIC_VIEW  = 'https://www.google.com/maps?q=-7.344459464030086,109.2388455258094';
    @endphp

    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-md px-4 md:px-8">

            {{-- Judul (dynamic) --}}
            <h1 class="mb-4 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-6">
                {{ $about?->title ?? 'Tentang Kami' }}
            </h1>

            @if(! $about)
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-yellow-700">
                    Belum ada data <em>About Us</em>. Silakan isi dari panel admin.
                </div>
            @else
                {{-- Struktur Organisasi (dynamic) --}}
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

                {{-- Visi (dynamic) --}}
                @if(!empty($about->visi))
                    <h2 class="mb-2 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4">Visi</h2>
                    <div class="mb-6 text-gray-600 sm:text-lg md:mb-8">
                        {!! $about->visi !!}
                    </div>
                @endif

                {{-- Misi (dynamic) --}}
                @if(!empty($about->misi))
                    <h2 class="mb-2 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4">Misi</h2>
                    <div class="mb-6 text-gray-600 sm:text-lg md:mb-8">
                        {!! $about->misi !!}
                    </div>
                @endif

                {{-- Alamat: STATIC EMBED ONLY --}}
                <h2 class="mb-2 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4">Alamat</h2>
                <div class="aspect-video w-full overflow-hidden rounded-lg border">
                    <iframe
                        src="{{ $STATIC_EMBED }}"
                        class="h-full w-full border-0"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                {{-- Optional: link ke Google Maps (pakai link statis; atau ganti ke $about->alamat jika ingin) --}}
                <p class="mt-3 text-sm text-gray-600">
                    <a href="{{ $STATIC_VIEW }}" target="_blank" rel="noopener"
                       class="text-indigo-600 underline hover:text-indigo-700">
                        Buka di Google Maps
                    </a>
                </p>
            @endif

        </div>
    </div>
@endsection

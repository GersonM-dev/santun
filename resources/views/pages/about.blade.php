@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\AboutUs|null $about */
        $about = $about ?? \App\Models\AboutUs::query()->first();

        // Helper: build an embed URL from any address/link
        $toEmbed = function (?string $raw): ?string {
            if (! $raw) return null;
            $raw = trim($raw);

            // If it's already an embed URL, keep it
            if (str_contains($raw, 'google') && str_contains($raw, 'maps') && str_contains($raw, 'embed')) {
                return $raw;
            }

            // If URL has @lat,long (e.g., .../@-7.123,109.456,17z)
            if (preg_match('~@(-?\d+\.\d+),\s*(-?\d+\.\d+)~', $raw, $m)) {
                return 'https://www.google.com/maps?q=' . $m[1] . ',' . $m[2] . '&z=15&output=embed';
            }

            // If URL has query params (?q= or ?query=)
            if (filter_var($raw, FILTER_VALIDATE_URL)) {
                $parts = parse_url($raw);
                if (!empty($parts['query'])) {
                    parse_str($parts['query'], $q);
                    $target = $q['q'] ?? $q['query'] ?? null;
                    if ($target) {
                        return 'https://www.google.com/maps?q=' . urlencode($target) . '&output=embed';
                    }
                }
            }

            // Fallback: treat as free-text address
            return 'https://www.google.com/maps?q=' . urlencode($raw) . '&output=embed';
        };

        $embedSrc = $toEmbed($about?->alamat ?? null);
    @endphp

    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-md px-4 md:px-8">

            {{-- Judul --}}
            <h1 class="mb-4 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-6">
                {{ $about?->title ?? 'Tentang Kami' }}
            </h1>

            @if(! $about)
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-yellow-700">
                    Belum ada data <em>About Us</em>. Silakan isi dari panel admin.
                </div>
            @else
                {{-- Struktur Organisasi --}}
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

                {{-- Alamat: ALWAYS EMBED --}}
                @if($embedSrc)
                    <h2 class="mb-2 text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4">Alamat</h2>

                    <div class="aspect-video w-full overflow-hidden rounded-lg border">
                        <iframe
                            src="{{ $embedSrc }}"
                            class="h-full w-full border-0"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    {{-- Optional: link ke Maps asli --}}
                    <p class="mt-3 text-sm text-gray-600">
                        <a href="{{ $about->alamat }}" target="_blank" rel="noopener"
                           class="text-indigo-600 underline hover:text-indigo-700">
                           Buka di Google Maps
                        </a>
                    </p>
                @endif
            @endif

        </div>
    </div>
@endsection

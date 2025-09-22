@extends('layouts.app')

@section('content')
<section class="py-10 sm:py-14 lg:py-16">
  @php
      /** @var \App\Models\AboutUs|null $about */
      $about = $about ?? \App\Models\AboutUs::query()->first();

      $title = $about->title ?? 'Tentang Kami';
      $img   = !empty($about?->struktur)
                 ? asset('storage/'.$about->struktur)
                 : asset('logo.PNG'); // fallback ke logo

      // Ambil ringkasannya (hilangkan tag HTML dari RichEditor)
      $visiExcerpt = trim(\Illuminate\Support\Str::words(strip_tags($about->visi ?? ''), 60, '…'));
      $misiExcerpt = trim(\Illuminate\Support\Str::words(strip_tags($about->misi ?? ''), 40, '…'));
  @endphp

  <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
    <div class="grid items-center gap-10 lg:grid-cols-2">
      <!-- Kiri: Gambar/Logo/Struktur (dynamic) -->
      <div class="flex justify-center">
        <div class="rounded-2xl bg-white p-4 shadow-lg ring-1 ring-gray-200">
          <img
            src="{{ $img }}"
            alt="{{ $title }}"
            class="h-72 w-72 object-contain sm:h-80 sm:w-80"
            loading="lazy"
          />
        </div>
      </div>

      <!-- Kanan: Teks & Fitur (dynamic excerpts + justified) -->
      <div>
        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">{{ $title }}</h2>

        @if($visiExcerpt || $misiExcerpt)
          @if($visiExcerpt)
            <p class="mt-5 max-w-2xl text-gray-700 leading-relaxed text-justify">
              {{ $visiExcerpt }}
            </p>
          @endif

          @if($misiExcerpt)
            <p class="mt-3 max-w-2xl text-gray-700 leading-relaxed text-justify">
              {{ $misiExcerpt }}
            </p>
          @endif
        @else
          {{-- Fallback jika belum ada konten --}}
          <p class="mt-5 max-w-2xl text-gray-700 leading-relaxed text-justify">
            Relawan ODGJ Baturraden adalah organisasi sosial yang bergerak di bidang kesehatan jiwa,
            pendidikan, dan sosial kemasyarakatan. Kami mengundang Anda untuk mengenal kami lebih dekat.
          </p>
        @endif

        <!-- Fitur -->
        <div class="mt-8 grid gap-5 sm:grid-cols-2">
          <!-- Item 1 -->
          <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 ring-1 ring-blue-100">
              <!-- Icon form/layanan -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M6 2a2 2 0 0 0-2 2v16l4-2 4 2 4-2 4 2V4a2 2 0 0 0-2-2H6z" />
              </svg>
            </div>
            <div>
              <div class="font-semibold text-gray-900">Pendaftaran Layanan Bantuan</div>
              <div class="text-sm text-gray-600 leading-relaxed text-justify">
                Layanan bantuan kesehatan jiwa (ODGJ), pendidikan, dan sosial.
              </div>
            </div>
          </div>

          <!-- Item 2 -->
          <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 ring-1 ring-cyan-100">
              <!-- Icon donasi -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 21s-8-4.438-8-11a5 5 0 0 1 9-3 5 5 0 0 1 9 3c0 6.562-8 11-8 11z" />
              </svg>
            </div>
            <div>
              <div class="font-semibold text-gray-900">Penggalangan Donasi</div>
              <div class="text-sm text-gray-600 leading-relaxed text-justify">
                Donasi materi & non-materi untuk mendukung program sosial berkelanjutan.
              </div>
            </div>
          </div>
        </div>

        <!-- CTA -->
        <div class="mt-10 border-t border-gray-200 pt-5">
          <a href="{{ route('about') }}"
             class="inline-flex items-center gap-2 font-medium text-blue-700 hover:text-blue-800">
            Pelajari lebih lanjut tentang perjuangan kami
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

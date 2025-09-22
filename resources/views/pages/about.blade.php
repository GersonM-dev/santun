@extends('layouts.app')

@section('content')
<section class="py-10 sm:py-14 lg:py-16">
  @php
      /** @var \App\Models\AboutUs|null $about */
      $about    = $about ?? \App\Models\AboutUs::query()->first();
      $title    = $about->title ?? 'Tentang Kami';
      $logo     = asset('logo.PNG'); // logo always first
      $struktur = !empty($about?->struktur) ? asset('storage/'.$about->struktur) : null;

      // STATIC Street View embed (as requested)
      $STATIC_EMBED = 'https://www.google.com/maps/embed?pb=!4v1758514234476!6m8!1m7!1sOr70pVQso5ZZA_ukU3lnLw!2m2!1d-7.344459464030086!2d109.2388455258094!3f239.71447180589035!4f-14.754068982584883!5f0.4000000000000002';
  @endphp

  <div class="mx-auto max-w-screen-2xl px-4 md:px-8">

    {{-- 1) LOGO (Top, centered) --}}
    <div class="flex justify-center">
      <img
        src="{{ $logo }}"
        alt="{{ $title }}"
        class="h-28 w-auto sm:h-32"
        loading="lazy"
      />
    </div>

    {{-- 2) CONTENT ROW: Left = Visi & Misi, Right = Struktur --}}
    <div class="mt-10 grid items-start gap-10 lg:grid-cols-2">
      <!-- Left: Visi & Misi (dynamic, justified) -->
      <div>
        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">{{ $title }}</h2>

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

      <!-- Right: Struktur image (dynamic) -->
      <div class="flex justify-center lg:justify-end">
        @if($struktur)
          <div class="rounded-2xl bg-white p-4 shadow-lg ring-1 ring-gray-200">
            <img
              src="{{ $struktur }}"
              alt="Struktur Organisasi"
              class="h-[28rem] w-auto max-w-full object-contain"
              loading="lazy"
            />
          </div>
        @else
          <div class="rounded-xl border border-dashed p-8 text-gray-400">
            Belum ada gambar struktur.
          </div>
        @endif
      </div>
    </div>

    {{-- 3) MAP (Centered, static embed) --}}
    <div class="mt-12 flex justify-center">
      <div class="w-full max-w-4xl overflow-hidden rounded-lg border">
        <div class="aspect-video">
          <iframe
            src="{{ $STATIC_EMBED }}"
            class="h-full w-full border-0"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

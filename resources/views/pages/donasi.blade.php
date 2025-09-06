@extends('layouts.app')
@section('content')
    <!-- Penggalangan Donasi -->
    <div class="mb-4 py-6 sm:py-8 lg:py-12 border-t border-gray-400 mt-6">
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
                <a href="{{ route('formdonasi', 'materi') }}"
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
                <a href="{{ route('formdonasi', 'non-materi') }}"
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
@endsection
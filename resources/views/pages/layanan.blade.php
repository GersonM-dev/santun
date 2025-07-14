@extends('layouts.app')
@section('content')
    <!-- Layanan Bantuan -->
    <div class="bg-white py-6 sm:py-8 lg:py-12 border-t border-gray-400 mt-6">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-5 md:mb-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Layanan Bantuan</h2>

                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                    Kami menyediakan berbagai layanan bantuan sosial, mulai dari donasi, pendidikan, kesehatan, hingga
                    dukungan khusus untuk ODGJ dan masyarakat yang membutuhkan.
                </p>
            </div>
            <!-- text - end -->

            <div class="grid gap-6 sm:grid-cols-3">
                <!-- product - start -->
                <a href="{{ route('formlayanan') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1620243318482-fdd2affd7a38?auto=format&q=75&fit=crop&w=750"
                        loading="lazy" alt="Photo by Fakurian Design"
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
                <a href="{{ route('formlayanan') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1620241608701-94ef138c7ec9?auto=format&q=75&fit=crop&w=750"
                        loading="lazy" alt="Photo by Fakurian Design"
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
                <a href="{{ route('formlayanan') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1620243318482-fdd2affd7a38?auto=format&q=75&fit=crop&w=750"
                        loading="lazy" alt="Photo by Fakurian Design"
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
@endsection
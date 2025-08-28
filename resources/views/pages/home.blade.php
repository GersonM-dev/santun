@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="flex flex-col justify-between gap-6 sm:gap-10 md:gap-16 lg:flex-row">
        <!-- content - start -->
        <div class="flex flex-col justify-center ms-12 sm:text-center lg:py-12 lg:text-left xl:w-5/12 xl:py-24">
            <h1 class="mb-8 text-xl font-bold text-justify text-black sm:text-xl md:mb-12 md:text-3xl">
                Mari bersama berbagi kebaikan, saling mendukung, dan memberi harapan baru lewat Relawan ODGJ Baturraden</h1>
            <p class="mb-8 leading-relaxed text-justify text-gray-500 md:mb-12 xl:text-md">
                Dengan semangat kepedulian, Relawan ODGJ Baturraden berkomitmen untuk memberikan layanan sosial,
                pendampingan, dan aksi nyata yang transparan serta berkelanjutan. Melalui SANTUN (Sistem Informasi Terpadu
                untuk Relawan ODGJ Baturraden), kami hadir untuk memudahkan Anda dalam berkontribusi, berdonasi, maupun
                mendaftar layanan sosial secara cepat, transparan, dan terpercaya.
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

    <!-- Kegiatan Sosial -->
    <div class="bg-white py-6 sm:py-8 lg:py-12 mt-6">
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
    <div class="bg-white py-6 sm:py-8 lg:py-12 border-t border-gray-400 mt-6">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-5 md:mb-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Layanan Bantuan</h2>

                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                    Masyarakat dapat mendaftar berbagai layanan bantuan yang tersedia, mulai dari kesehatan jiwa, pendidikan, hingga bantuan sosial umum. Kami siap mendampingi dan membantu setiap kebutuhan dengan penuh kepedulian.
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

    <!-- Penggalangan Donasi -->
    <div class="bg-white py-6 sm:py-8 lg:py-12 border-t border-gray-400 mt-6">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-5 md:mb-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Penggalangan Donasi</h2>

                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                    Mari berkontribusi untuk kebaikan bersama melalui penggalangan donasi. Dukungan Anda, baik berupa uang, barang, maupun tenaga, akan sangat berarti dalam membantu ODGJ serta masyarakat yang membutuhkan. Setiap donasi yang terkumpul akan disalurkan secara transparan dan tepat sasaran, agar kebaikan bisa dirasakan langsung oleh mereka yang membutuhkan.
                </p>
            </div>
            <!-- text - end -->

            <div class="grid gap-6 sm:grid-cols-2">
                <!-- product - start -->
                <a href="{{ route('formdonasi') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1620243318482-fdd2affd7a38?auto=format&q=75&fit=crop&w=750"
                        loading="lazy" alt="Photo by Fakurian Design"
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
                <a href="{{ route('formdonasi') }}"
                    class="group relative flex h-80 items-end overflow-hidden rounded-lg bg-gray-100 p-4 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1620241608701-94ef138c7ec9?auto=format&q=75&fit=crop&w=750"
                        loading="lazy" alt="Photo by Fakurian Design"
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

    <!-- Contact Us -->
    <!-- <div class="bg-white py-12 px-4 md:px-8 border-t border-gray-400 mt-6">
                <div class="mx-auto max-w-2xl rounded-2xl shadow-xl/30 bg-white p-8 md:p-12">
                    <div class="mb-8 text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Contact Us</h2>
                        <p class="text-gray-500 text-base md:text-lg">
                            Ada pertanyaan, saran, atau ingin berkolaborasi? Silakan isi form berikut atau hubungi kami secara
                            langsung.
                        </p>
                    </div>
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-gray-700 mb-1 font-medium">Nama</label>
                            <input type="text" id="name" name="name" required
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 transition" />
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 mb-1 font-medium">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 transition" />
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 mb-1 font-medium">Pesan</label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 transition resize-none"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full rounded-xl bg-indigo-500 py-3 text-lg font-semibold text-white shadow transition hover:bg-indigo-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 active:bg-indigo-700">
                            Kirim Pesan
                        </button>
                    </form>
                    <div class="mt-10 text-center text-gray-500 text-sm">
                        <div>
                            <span class="font-medium text-gray-700">Email:</span> info@namadomainanda.com
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">WhatsApp:</span> 0812-xxxx-xxxx
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Alamat:</span> Jl. Sosial No. 10, Jakarta
                        </div>
                    </div>
                </div>
            </div> -->

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
        });
    </script>
@endsection
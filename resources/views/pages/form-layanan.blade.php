@extends('layouts.app')

@section('content')
    <!-- Modal: Info Layanan -->
    <div id="layananModal" class="fixed inset-0 z-50 pointer-events-none flex items-center justify-center">
        <!-- backdrop (doesn't block scroll/touch) -->
        <div class="absolute inset-0 bg-gray-900/20 backdrop-blur-sm pointer-events-none"></div>

        <!-- panel (interactive) -->
        <div class="pointer-events-auto bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 p-6 md:p-8 relative">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Informasi Layanan</h3>
                <button type="button" id="layananModalClose"
                    class="h-8 w-8 rounded-full bg-gray-100 hover:bg-gray-200 grid place-items-center">✕</button>
            </div>

            {{-- Content wrapper (long content scrolls) --}}
            <div class="prose max-w-none text-gray-700 md:max-h-[65vh] overflow-y-auto space-y-4">
                {{-- Kesehatan Jiwa --}}
                @if(($layananSlug ?? null) === 'kesehatan-jiwa')
                    <h4 class="text-lg font-semibold">Bantuan Khusus Kesehatan Jiwa</h4>
                    <p>Relawan ODGJ Baturaden menyediakan layanan bantuan khusus bagi masyarakat yang membutuhkan pendampingan
                        dan penanganan terhadap Orang Dengan Gangguan Jiwa (ODGJ). Layanan ini ditujukan untuk membantu keluarga
                        atau individu yang mengalami kesulitan dalam mengelola kondisi gangguan jiwa.</p>
                    <p><strong>Pendaftaran layanan ini terbuka bagi:</strong></p>
                    <ul class="list-disc pl-6">
                        <li>Keluarga atau kerabat yang memiliki anggota dengan kondisi gangguan jiwa.</li>
                        <li>Masyarakat umum yang menemukan kasus ODGJ di lingkungan sekitarnya.</li>
                    </ul>
                    <p>Pendaftaran layanan ini dapat dilakukan secara online melalui website ini, dengan mengisi formulir
                        pendaftaran yang tersedia. Informasi yang dibutuhkan mencakup identitas pelapor, kondisi pasien, dan
                        lokasi tempat tinggal. Setelah pendaftaran dikirimkan, tim relawan akan melakukan verifikasi dan
                        menghubungi pelapor untuk tindak lanjut.</p>
                    <p>Kami menjamin setiap informasi yang diberikan akan dijaga kerahasiaannya dan digunakan hanya untuk
                        keperluan pelayanan. Dengan sistem pendaftaran ini, kami berharap proses penanganan pasien ODGJ menjadi
                        lebih cepat, tepat, dan terkoordinasi.</p>

                    {{-- Pendidikan --}}
                @elseif(($layananSlug ?? null) === 'pendidikan')
                    <h4 class="text-lg font-semibold">Bantuan Pendidikan</h4>
                    <p>Relawan ODGJ Baturaden tidak hanya fokus pada penanganan kesehatan jiwa, tetapi juga memiliki kepedulian
                        tinggi terhadap akses pendidikan, khususnya bagi anak-anak dari keluarga kurang mampu. Melalui program
                        Bantuan Pendidikan, kami berupaya memberikan dukungan agar anak-anak tetap bisa melanjutkan pendidikan
                        mereka dengan layak.</p>
                    <p><strong>Pendaftaran layanan ini mencakup:</strong></p>
                    <ul class="list-disc pl-6">
                        <li>Bantuan perlengkapan sekolah (seragam, tas, alat tulis)</li>
                        <li>Bantuan biaya pendidikan untuk siswa kurang mampu</li>
                        <li>Pendampingan belajar atau program dukungan non-formal</li>
                    </ul>
                    <p>Bagi masyarakat yang ingin mengajukan bantuan pendidikan, kini dapat melakukan pendaftaran secara
                        langsung melalui website ini. Cukup dengan mengisi formulir pendaftaran yang tersedia dan melampirkan
                        data pendukung, seperti keterangan sekolah atau kondisi ekonomi keluarga.</p>
                    <p>Tim kami akan melakukan verifikasi dan seleksi berdasarkan kebutuhan dan ketersediaan bantuan. Kami
                        memastikan setiap proses dilakukan secara transparan dan objektif. Dengan adanya sistem pendaftaran ini,
                        diharapkan proses penyaluran bantuan menjadi lebih tertata, adil, dan tepat sasaran, serta dapat
                        mendorong semangat belajar generasi muda di tengah keterbatasan.</p>

                    {{-- Sosial Umum --}}
                @elseif(($layananSlug ?? null) === 'sosial-umum')
                    <h4 class="text-lg font-semibold">Bantuan Sosial Umum</h4>
                    <p>Layanan Bantuan Sosial Umum merupakan bentuk kepedulian Relawan ODGJ Baturaden terhadap masyarakat yang
                        membutuhkan uluran tangan, terutama dalam kondisi darurat atau kesulitan ekonomi. Layanan ini mencakup
                        berbagai bentuk bantuan di luar penanganan ODGJ.</p>
                    <p><strong>Pendaftaran layanan ini terbuka bagi:</strong></p>
                    <ul class="list-disc pl-6">
                        <li>Keluarga — bantuan untuk lansia terlantar</li>
                        <li>Bantuan kepada korban kecelakaan atau bencana</li>
                        <li>Pendampingan sosial dan kebutuhan mendesak lainnya</li>
                    </ul>
                    <p>Melalui fitur pendaftaran online, masyarakat kini dapat mengajukan permohonan bantuan dengan lebih mudah,
                        cukup dengan mengisi formulir yang tersedia di website ini. Setelah data dikirimkan, tim relawan akan
                        melakukan verifikasi dan tindak lanjut sesuai jenis bantuan yang dibutuhkan.</p>
                    <p>Kami berkomitmen untuk memberikan respon yang cepat, data yang transparan, serta layanan yang manusiawi
                        dan tepat sasaran. Setiap informasi yang diberikan oleh pemohon akan dijaga kerahasiaannya dan hanya
                        digunakan untuk keperluan pendataan dan tindak lanjut layanan.</p>
                    <p>Dengan adanya sistem pendaftaran ini, diharapkan proses pemberian bantuan dapat berjalan lebih efisien,
                        terorganisir, dan menjangkau lebih banyak masyarakat yang membutuhkan.</p>

                    {{-- Default --}}
                @else
                    <p>Pilih salah satu jenis layanan di atas untuk melihat detailnya. Setelah memilih, lengkapi formulir
                        pendaftaran di bawah ini.</p>
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" id="layananModalOk"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg">
                    Saya Mengerti
                </button>
            </div>
        </div>
    </div>

    {{-- Modal script (background remains scrollable) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slug = @json($layananSlug ?? 'default');
            const modal = document.getElementById('layananModal');
            const btnX = document.getElementById('layananModalClose');
            const btnOk = document.getElementById('layananModalOk');
            const key = 'layanan_modal_seen_' + slug;

            function openModal() {
                if (!modal) return;
                modal.classList.remove('hidden');
                // DO NOT lock scroll: no overflow-hidden on html/body
            }
            function closeModal() {
                modal.classList.add('hidden');
                try { sessionStorage.setItem(key, '1'); } catch (e) { }
            }

            try {
                // if (!sessionStorage.getItem(key) && slug !== 'default') openModal();
            } catch (e) { openModal(); }

            btnX?.addEventListener('click', closeModal);
            btnOk?.addEventListener('click', closeModal);
            // No click-backdrop close because backdrop is non-interactive (keeps background scrollable)
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
        });
    </script>



    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-md p-4 md:p-8 rounded-xl shadow-xl/30">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Ajukan Pendaftaran Layanan
                </h2>
                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                    Isi form berikut untuk mengajukan pendaftaran layanan. Tim kami akan segera memproses pendaftaran Anda.
                </p>
            </div>
            <!-- text - end -->

            <!-- form - start -->
            <form action="#" method="POST" class="mx-auto grid max-w-screen-md gap-4">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="nama" class="mb-2 block text-sm text-gray-800 font-medium">Nama<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label for="date_birth" class="mb-2 block text-sm text-gray-800 font-medium">Tanggal Lahir<span
                            class="text-red-500">*</span></label>
                    <input type="date" id="date_birth" name="date_birth" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <!-- Jenis Bantuan -->
                <div>
                    <label for="id_jenisBantuan" class="mb-2 block text-sm text-gray-800 font-medium">
                        Jenis Bantuan <span class="text-red-500">*</span>
                    </label>
                    <select id="id_jenisBantuan" name="id_jenisBantuan" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                        <option value="">-- Pilih Jenis Bantuan --</option>
                        @foreach($jenisBantuanList as $jenis)
                            <option value="{{ $jenis->id }}" {{ (string) old('id_jenisBantuan', $prefillJenisId) === (string) $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_jenisBantuan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kontak -->
                <div>
                    <label for="kontak" class="mb-2 block text-sm text-gray-800 font-medium">Kontak<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="kontak" name="kontak" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                </div>

                <!-- Keluhan -->
                <div class="sm:col-span-2">
                    <label for="keluhan" class="mb-2 block text-sm text-gray-800 font-medium">Keluhan<span
                            class="text-red-500">*</span></label>
                    <textarea id="keluhan" name="keluhan" rows="4" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring resize-none"></textarea>
                </div>

                <!-- Alamat -->
                <div class="sm:col-span-2">
                    <label for="alamat" class="mb-2 block text-sm text-gray-800 font-medium">Alamat<span
                            class="text-red-500">*</span></label>
                    <textarea id="alamat" name="alamat" rows="3" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring resize-none"></textarea>
                </div>

                <!-- Hidden Status -->
                <input type="hidden" name="status" value="belum diproses">

                <!-- Hidden Tanggal -->
                <input type="hidden" name="tanggal" value="{{ now()->format('Y-m-d') }}">

                <div class="flex items-center justify-between sm:col-span-2">
                    <button type="submit"
                        class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">
                        Ajukan Bantuan
                    </button>
                    <span class="text-sm text-gray-500">*Wajib diisi</span>
                </div>
            </form>
            <!-- form - end -->
        </div>
    </div>
    {{-- Script to handle show/hide of Materi/Non Materi --}}
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#2563eb', // Tailwind indigo-600
                });
            });
        </script>
    @endif
@endsection
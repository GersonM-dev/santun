@extends('layouts.app')

@section('content')
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-md p-4 md:p-8 rounded-xl shadow-xl/30">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">Ajukan Permohonan Bantuan
                </h2>
                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">
                    Isi form berikut untuk mengajukan permohonan bantuan. Tim kami akan segera memproses permohonan Anda.
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
                    <label for="id_jenisBantuan" class="mb-2 block text-sm text-gray-800 font-medium">Jenis Bantuan<span
                            class="text-red-500">*</span></label>
                    <select id="id_jenisBantuan" name="id_jenisBantuan" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                        <option value="">-- Pilih Jenis Bantuan --</option>
                        @foreach($jenisBantuanList as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                        @endforeach
                    </select>
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
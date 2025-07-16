@extends('layouts.app')

@section('content')
    <div class="bg-white py-8">
        <div class="mx-auto max-w-lg p-4 md:p-8 rounded-xl shadow-xl/30">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Form Donasi</h2>
            <form action="{{ route('formdonasi.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama Donatur --}}
                <div>
                    <label for="name" class="block font-medium text-gray-800 mb-1">Nama Donatur<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label for="phone" class="block font-medium text-gray-800 mb-1">Nomor Telepon<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="phone" id="phone" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                </div>

                {{-- Tanggal Donasi --}}
                <div>
                    <label for="date" class="block font-medium text-gray-800 mb-1">Tanggal Donasi<span
                            class="text-red-500">*</span></label>
                    <input type="date" name="date" id="date" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                </div>

                {{-- Tipe Donasi --}}
                <div>
                    <label for="type" class="block font-medium text-gray-800 mb-1">Tipe Donasi<span
                            class="text-red-500">*</span></label>
                    <select name="type" id="type" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="Materi" {{ old('type') == 'Materi' ? 'selected' : '' }}>Materi</option>
                        <option value="Non Materi" {{ old('type') == 'Non Materi' ? 'selected' : '' }}>Non Materi</option>
                    </select>
                </div>

                {{-- Tujuan Donasi --}}
                <div>
                    <label for="tujuan_donasi_id" class="block font-medium text-gray-800 mb-1">Tujuan Donasi<span
                            class="text-red-500">*</span></label>
                    <select name="tujuan_donasi_id" id="tujuan_donasi_id" required
                        class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">
                        <option value="">-- Pilih Tujuan --</option>
                        @foreach($tujuanDonasiList as $td)
                            <option value="{{ $td->id }}">{{ $td->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Donasi Anonim --}}
                <div class="flex items-center">
                    <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_anonymous') ? 'checked' : '' }}>
                    <label for="is_anonymous" class="ml-2 block text-gray-800 font-medium">Donasi Anonim</label>
                </div>

                {{-- SECTION NON MATERI --}}
                <div id="non-materi-section" style="display: none;">
                    <div class="mt-4 p-4 rounded-xl bg-gray-50 border">
                        <h3 class="font-semibold text-indigo-700 mb-3">Donasi Non Materi</h3>
                        <div class="mb-3">
                            <label for="item_name" class="block font-medium text-gray-800 mb-1">Nama Barang<span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="item_name" id="item_name"
                                class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="block font-medium text-gray-800 mb-1">Jumlah<span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="quantity" id="quantity"
                                class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                        </div>
                        <div>
                            <label for="satuan_id" class="block font-medium text-gray-800 mb-1">Satuan<span
                                    class="text-red-500">*</span></label>
                            <select name="satuan_id" id="satuan_id"
                                class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">
                                <option value="">-- Pilih Satuan --</option>
                                @foreach($satuanList as $satuan)
                                    <option value="{{ $satuan->id }}">{{ $satuan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SECTION MATERI --}}
                <div id="materi-section" style="display: none;">
                    <div class="mt-4 p-4 rounded-xl bg-gray-50 border">
                        <h3 class="font-semibold text-indigo-700 mb-3">Donasi Materi</h3>
                        <div class="mb-3">
                            <label for="money_total" class="block font-medium text-gray-800 mb-1">Jumlah Uang<span
                                    class="text-red-500">*</span></label>
                            <div class="flex items-center">
                                <span
                                    class="inline-block px-3 py-2 rounded-l bg-gray-100 border border-r-0 border-gray-300 text-gray-700">Rp</span>
                                <input type="number" min="0" name="money_total" id="money_total"
                                    class="w-full rounded-r border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                            </div>
                        </div>
                        <div>
                            <label for="money_proof_picture" class="block font-medium text-gray-800 mb-1">Bukti
                                Transfer<span class="text-red-500">*</span></label>
                            <input type="file" name="money_proof_picture" id="money_proof_picture" accept="image/*"
                                class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full rounded-lg bg-indigo-500 px-8 py-3 text-center text-lg font-semibold text-white outline-none ring-indigo-300 transition hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700">
                    Kirim Donasi
                </button>
            </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('type');
            const materiSection = document.getElementById('materi-section');
            const nonMateriSection = document.getElementById('non-materi-section');

            function toggleSections() {
                if (typeSelect.value === 'Materi') {
                    materiSection.style.display = 'block';
                    nonMateriSection.style.display = 'none';
                } else if (typeSelect.value === 'Non Materi') {
                    materiSection.style.display = 'none';
                    nonMateriSection.style.display = 'block';
                } else {
                    materiSection.style.display = 'none';
                    nonMateriSection.style.display = 'none';
                }
            }

            typeSelect.addEventListener('change', toggleSections);

            // On load, show relevant section if form repopulated
            toggleSections();
        });
    </script>
@endsection
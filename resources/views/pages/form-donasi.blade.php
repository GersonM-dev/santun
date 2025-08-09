@extends('layouts.app')

@section('content')
<div class="bg-white py-8">
  <div class="mx-auto max-w-2xl p-4 md:p-8 rounded-xl shadow-xl/30">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Form Donasi</h2>

    <form action="{{ route('formdonasi.submit') }}" method="POST" enctype="multipart/form-data" class="grid gap-6 md:grid-cols-2">
                @csrf

                <!-- LEFT: Info Donatur -->
                <div class="space-y-6">
                    {{-- Nama Donatur --}}
                    <div>
                        <label for="name" class="block font-medium text-gray-800 mb-1">Nama Donatur<span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="phone" class="block font-medium text-gray-800 mb-1">Nomor Telepon<span
                                class="text-red-500">*</span></label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                            class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                        @error('phone')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Donasi --}}
                    <div>
                        <label for="date" class="block font-medium text-gray-800 mb-1">Tanggal Donasi<span
                                class="text-red-500">*</span></label>
                        <input type="date" name="date" id="date" value="{{ old('date') }}" required
                            class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                        @error('date')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipe Donasi --}}
                    @if(($mode ?? null) === 'materi')
                        <div>
                            <label for="type" class="block font-medium text-gray-800 mb-1">Tipe Donasi<span
                                    class="text-red-500">*</span></label>
                            <select name="type" id="type" required
                                class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Uang" {{ old('type') == 'Uang' ? 'selected' : '' }}>Uang</option>
                                <option value="Barang" {{ old('type') == 'Barang' ? 'selected' : '' }}>Barang</option>
                            </select>
                            @error('type')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @elseif(($mode ?? null) === 'non-materi')
                        {{-- Untuk non-materi: tidak ada pilihan tipe, default ke Jasa --}}
                        <input type="hidden" name="type" id="type" value="Jasa">
                    @else
                        {{-- Mode bebas (opsional): tampilkan 3 opsi --}}
                        <div>
                            <label for="type" class="block font-medium text-gray-800 mb-1">Tipe Donasi<span
                                    class="text-red-500">*</span></label>
                            <select name="type" id="type" required
                                class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Uang" {{ old('type') == 'Uang' ? 'selected' : '' }}>Uang</option>
                                <option value="Barang" {{ old('type') == 'Barang' ? 'selected' : '' }}>Barang</option>
                                <option value="Jasa" {{ old('type') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                            </select>
                            @error('type')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    {{-- Tujuan Donasi --}}
                    <div>
                        <label for="tujuan_donasi_id" class="block font-medium text-gray-800 mb-1">Tujuan Donasi<span
                                class="text-red-500">*</span></label>
                        <select name="tujuan_donasi_id" id="tujuan_donasi_id" required
                            class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">
                            <option value="">-- Pilih Tujuan --</option>
                            @foreach($tujuanDonasiList as $td)
                                <option value="{{ $td->id }}" {{ old('tujuan_donasi_id') == $td->id ? 'selected' : '' }}>
                                    {{ $td->name }}</option>
                            @endforeach
                        </select>
                        @error('tujuan_donasi_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Catatan Donatur --}}
                    <div>
                        <label for="catatan" class="block font-medium text-gray-800 mb-1">
                            Catatan Donatur <span class="text-red-500">*</span>
                        </label>
                        <p class="text-sm text-gray-500 mb-2">
                            Bisa diisi dengan doa atau harapan dari donatur.
                        </p>
                        <textarea name="catatan" id="catatan" rows="4"
                            class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Donasi Anonim --}}
                    <div class="flex items-center">
                        <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_anonymous') ? 'checked' : '' }}>
                        <label for="is_anonymous" class="ml-2 block text-gray-800 font-medium">Donasi Anonim</label>
                    </div>
                </div>

                <!-- RIGHT: Detail Tipe Donasi -->
                <div class="space-y-6">
                    {{-- SECTION UANG --}}
                    <div id="uang-section" class="hidden">
                        <div class="mt-4 p-4 rounded-xl bg-gray-50 border">
                            <h3 class="font-semibold text-indigo-700 mb-3">Donasi Materi (Uang)</h3>
                            <div class="mb-3">
                                <label for="money_total" class="block font-medium text-gray-800 mb-1">Jumlah Uang<span
                                        class="text-red-500">*</span></label>
                                <div class="flex items-center">
                                    <span
                                        class="inline-block px-3 py-2 rounded-l bg-gray-100 border border-r-0 border-gray-300 text-gray-700">Rp</span>
                                    <input type="number" min="0" name="money_total" id="money_total"
                                        value="{{ old('money_total') }}"
                                        class="w-full rounded-r border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                                </div>
                                @error('money_total')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="money_proof_picture" class="block font-medium text-gray-800 mb-1">Bukti
                                    Transfer<span class="text-red-500">*</span></label>
                                <input type="file" name="money_proof_picture" id="money_proof_picture" accept="image/*"
                                    class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                                @error('money_proof_picture')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION BARANG --}}
                    <div id="barang-section" class="hidden">
                        <div class="mt-4 p-4 rounded-xl bg-gray-50 border">
                            <h3 class="font-semibold text-indigo-700 mb-3">Donasi Non Materi (Barang)</h3>
                            <div class="mb-3">
                                <label for="item_name" class="block font-medium text-gray-800 mb-1">Nama Barang<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}"
                                    class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                                @error('item_name')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="block font-medium text-gray-800 mb-1">Jumlah<span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity') }}"
                                    class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                                @error('quantity')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="satuan_id" class="block font-medium text-gray-800 mb-1">Satuan<span
                                        class="text-red-500">*</span></label>
                                <select name="satuan_id" id="satuan_id"
                                    class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach($satuanList as $satuan)
                                        <option value="{{ $satuan->id }}" {{ old('satuan_id') == $satuan->id ? 'selected' : '' }}>
                                            {{ $satuan->name }}</option>
                                    @endforeach
                                </select>
                                @error('satuan_id')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION JASA --}}
                    <div id="jasa-section" class="hidden">
                        <div class="mt-4 p-4 rounded-xl bg-gray-50 border">
                            <h3 class="font-semibold text-indigo-700 mb-3">Donasi Jasa</h3>
                            <div class="mb-3">
                                <label for="description_jasa" class="block font-medium text-gray-800 mb-1">Deskripsi Jasa<span
                                        class="text-red-500">*</span></label>
                                <textarea name="description_jasa" id="description_jasa" rows="4"
                                    class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring">{{ old('description_jasa') }}</textarea>
                                @error('description_jasa')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- Lampiran opsional untuk Jasa (jika ingin) --}}
                            <div>
                                <label for="jasa_attachment" class="block font-medium text-gray-800 mb-1">Lampiran
                                    (opsional)</label>
                                <input type="file" name="jasa_attachment" id="jasa_attachment" accept="image/*,application/pdf"
                                    class="w-full rounded border bg-white px-3 py-2 text-gray-800 outline-none ring-indigo-300 focus:ring" />
                                @error('jasa_attachment')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT BUTTON (full width on grid) -->
                <div class="md:col-span-2">
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-500 px-8 py-3 text-center text-lg font-semibold text-white outline-none ring-indigo-300 transition hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700">Kirim
                        Donasi</button>
                </div>
            </form>
  </div>
</div>

{{-- SweetAlert (pastikan SweetAlert2 sudah dimuat di layout) --}}
@if(session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: @json(session('success')),
        confirmButtonColor: '#2563eb',
      });
    });
  </script>
@endif

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const MODE = @json($mode ?? null); // 'materi' | 'non-materi' | null

    const typeSelect = document.getElementById('type');
    const sections = {
      'Uang': document.getElementById('uang-section'),
      'Barang': document.getElementById('barang-section'),
      'Jasa': document.getElementById('jasa-section')
    };

    function setSection(sectionEl, visible) {
      if (!sectionEl) return;
      if (visible) {
        sectionEl.classList.remove('hidden');
        sectionEl.querySelectorAll('input, select, textarea').forEach(el => {
          el.disabled = false;
        });
      } else {
        sectionEl.classList.add('hidden');
        sectionEl.querySelectorAll('input, select, textarea').forEach(el => {
          el.disabled = true;
          el.removeAttribute('required');
        });
      }
    }

    function applyRequiredFor(val){
      if (val === 'Uang') {
        document.getElementById('money_total')?.setAttribute('required', 'required');
        document.getElementById('money_proof_picture')?.setAttribute('required', 'required');
      }
      if (val === 'Barang') {
        document.getElementById('item_name')?.setAttribute('required', 'required');
        document.getElementById('quantity')?.setAttribute('required', 'required');
        document.getElementById('satuan_id')?.setAttribute('required', 'required');
      }
      if (val === 'Jasa') {
        document.getElementById('description_jasa')?.setAttribute('required', 'required');
      }
    }

    function toggleSections() {
      const val = typeSelect?.value;
      setSection(sections['Uang'], val === 'Uang');
      setSection(sections['Barang'], val === 'Barang');
      setSection(sections['Jasa'], val === 'Jasa');
      applyRequiredFor(val);
    }

    // Init: hide all
    Object.values(sections).forEach(sec => setSection(sec, false));

    if (MODE === 'non-materi') {
      // Force ke Jasa, tanpa dropdown
      setSection(sections['Jasa'], true);
      applyRequiredFor('Jasa');
      return; // Stop di sini
    }

    if (MODE === 'materi') {
      // Default pilih Uang jika belum ada old('type')
      if (typeSelect && !typeSelect.value) {
        typeSelect.value = @json(old('type', 'Uang'));
      }
    }

    typeSelect?.addEventListener('change', toggleSections);
    toggleSections();
  });
</script>
@endsection

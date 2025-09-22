@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">

    {{-- Flash success --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header + Edit button --}}
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Riwayat Saya</h2>
        <button id="openEditBtn"
                class="inline-flex items-center gap-2 rounded-lg bg-sky-500 px-4 py-2 font-medium text-white hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-400">
            {{-- icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-90" viewBox="0 0 24 24" fill="currentColor"><path d="M4 21h4l11-11-4-4L4 17v4Zm15.7-12.3a1 1 0 0 0 0-1.4l-3-3a1 1 0 0 0-1.4 0L13 3.9l4.1 4.1 2.6-2.6Z"/></svg>
            Edit Profil
        </button>
    </div>

    @php
        /** @var \App\Models\User $user */
        $layananHistory = (isset($layananHistory) ? $layananHistory : (method_exists($user, 'layanans') ? $user->layanans : collect())) ?? collect();
        $donasiHistory  = (isset($donasiHistory) ? $donasiHistory  : (method_exists($user, 'donasis')  ? $user->donasis  : collect())) ?? collect();
    @endphp

    {{-- ====== TABEL RIWAYAT LAYANAN ====== --}}
    <div class="mb-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow">
        <div class="flex items-center justify-between border-b px-4 py-3 sm:px-6">
            <h3 class="text-lg font-semibold text-gray-800">Riwayat Layanan</h3>
            <span class="text-sm text-gray-500">Total: {{ $layananHistory->count() }}</span>
        </div>

        @if($layananHistory->isEmpty())
            <div class="px-4 py-10 text-center text-gray-500 sm:px-6">
                Belum ada riwayat layanan.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Jenis Layanan</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach($layananHistory as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $item->jenis ?? ($item->category ?? '—') }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $status = strtolower($item->status ?? 'menunggu');
                                        $map = [
                                            'selesai'   => 'bg-green-100 text-green-700 ring-green-200',
                                            'diproses'  => 'bg-amber-100 text-amber-800 ring-amber-200',
                                            'menunggu'  => 'bg-gray-100 text-gray-700 ring-gray-200',
                                            'ditolak'   => 'bg-rose-100 text-rose-700 ring-rose-200',
                                        ];
                                        $cls = $map[$status] ?? 'bg-gray-100 text-gray-700 ring-gray-200';
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 {{ $cls }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('layanan.show', $item->id ?? 0) }}"
                                       class="text-sky-600 hover:text-sky-700">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- ====== TABEL RIWAYAT DONASI ====== --}}
    <div class="mb-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow">
        <div class="flex items-center justify-between border-b px-4 py-3 sm:px-6">
            <h3 class="text-lg font-semibold text-gray-800">Riwayat Donasi</h3>
            <span class="text-sm text-gray-500">Total: {{ $donasiHistory->count() }}</span>
        </div>

        @if($donasiHistory->isEmpty())
            <div class="px-4 py-10 text-center text-gray-500 sm:px-6">
                Belum ada riwayat donasi.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Jenis</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Nominal/Barang</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach($donasiHistory as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ ucfirst($item->jenis ?? $item->mode ?? '—') }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    @if(isset($item->jumlah) && is_numeric($item->jumlah))
                                        Rp {{ number_format($item->jumlah,0,',','.') }}
                                    @elseif(!empty($item->barang))
                                        {{ $item->barang }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $status = strtolower($item->status ?? 'menunggu');
                                        $map = [
                                            'terkonfirmasi' => 'bg-green-100 text-green-700 ring-green-200',
                                            'diproses'      => 'bg-amber-100 text-amber-800 ring-amber-200',
                                            'menunggu'      => 'bg-gray-100 text-gray-700 ring-gray-200',
                                            'dibatalkan'    => 'bg-rose-100 text-rose-700 ring-rose-200',
                                        ];
                                        $cls = $map[$status] ?? 'bg-gray-100 text-gray-700 ring-gray-200';
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 {{ $cls }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('donasi.show', $item->id ?? 0) }}"
                                       class="text-sky-600 hover:text-sky-700">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

{{-- =================== MODAL EDIT PROFIL =================== --}}
<div id="editModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4"
     aria-hidden="true" role="dialog" aria-modal="true">
    <div class="w-full max-w-lg rounded-xl bg-white shadow-lg">
        <div class="flex items-center justify-between border-b px-5 py-3">
            <h3 class="text-lg font-semibold">Edit Profil</h3>
            <button id="closeEditBtn" class="rounded p-1 text-gray-500 hover:bg-gray-100" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6.4 19 5 17.6 10.6 12 5 6.4 6.4 5 12 10.6 17.6 5 19 6.4 13.4 12 19 17.6 17.6 19 12 13.4 6.4 19Z"/></svg>
            </button>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="px-5 py-5">
            @csrf
            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full rounded border border-gray-300 p-2 focus:border-sky-400 focus:ring-sky-200">
                @error('name')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full rounded border border-gray-300 p-2 focus:border-sky-400 focus:ring-sky-200">
                @error('email')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="mb-1 block text-sm font-medium text-gray-700">New Password <span class="text-gray-400">(opsional)</span></label>
                <input type="password" name="password"
                       class="w-full rounded border border-gray-300 p-2 focus:border-sky-400 focus:ring-sky-200">
                @error('password')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="mb-1 block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full rounded border border-gray-300 p-2 focus:border-sky-400 focus:ring-sky-200">
            </div>

            <div class="flex items-center justify-end gap-3 border-t pt-4">
                <button type="button" id="closeEditBtn2"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit"
                        class="rounded-lg bg-sky-600 px-4 py-2 font-medium text-white hover:bg-sky-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal   = document.getElementById('editModal');
    const openBtn = document.getElementById('openEditBtn');
    const closeBtn= document.getElementById('closeEditBtn');
    const closeBtn2= document.getElementById('closeEditBtn2');

    function openModal() {
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
    }
    function closeModal() {
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
    }

    if (openBtn)  openBtn.addEventListener('click', openModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (closeBtn2) closeBtn2.addEventListener('click', closeModal);

    // Close when clicking backdrop
    modal?.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // Auto-open modal if there are validation errors (server-side)
    @if ($errors->any())
        openModal();
    @endif
});
</script>
@endsection

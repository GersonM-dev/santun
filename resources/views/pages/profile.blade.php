@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4">

        {{-- Flash success --}}
        @if(session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

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
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($layananHistory as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ $item->id_jenisBantuan->name}}
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $status = strtolower($item->status ?? 'menunggu');
                                            $map = [
                                                'selesai' => 'bg-green-100 text-green-700 ring-green-200',
                                                'diproses' => 'bg-amber-100 text-amber-800 ring-amber-200',
                                                'menunggu' => 'bg-gray-100 text-gray-700 ring-gray-200',
                                                'ditolak' => 'bg-rose-100 text-rose-700 ring-rose-200',
                                            ];
                                            $cls = $map[$status] ?? 'bg-gray-100 text-gray-700 ring-gray-200';
                                        @endphp
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 {{ $cls }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- ====== TABEL RIWAYAT DONASI ====== --}}
        <div class="mb-10 overflow-hidden rounded-xl border border-gray-200 bg-white shadow">
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
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($donasiHistory as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ ucfirst($item->type ?? '—') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        @if($item->type === 'Materi' && $item->money->count())
                                            Rp {{ number_format($item->money->sum('total'), 0, ',', '.') }}
                                        @elseif($item->type === 'Non Materi' && $item->items->count())
                                            {{ $item->items->map(fn($i) => $i->name . ' (' . $i->qty . ' ' . optional($i->satuan)->name . ')')->join(', ') }}
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        @php
                                            $status = strtolower($item->status ?? 'menunggu');
                                            $map = [
                                                'terkonfirmasi' => 'bg-green-100 text-green-700 ring-green-200',
                                                'diproses' => 'bg-amber-100 text-amber-800 ring-amber-200',
                                                'menunggu' => 'bg-gray-100 text-gray-700 ring-gray-200',
                                                'dibatalkan' => 'bg-rose-100 text-rose-700 ring-rose-200',
                                            ];
                                            $cls = $map[$status] ?? 'bg-gray-100 text-gray-700 ring-gray-200';
                                        @endphp
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 {{ $cls }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- ====== EDIT PROFILE ====== --}}
        <div id="edit-profile" class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold mb-4">Edit Profil</h2>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full border rounded p-2 focus:border-sky-400 focus:ring-sky-200">
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full border rounded p-2 focus:border-sky-400 focus:ring-sky-200">
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        New Password <span class="text-gray-400">(opsional)</span>
                    </label>
                    <input type="password" name="password"
                        class="w-full border rounded p-2 focus:border-sky-400 focus:ring-sky-200">
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border rounded p-2 focus:border-sky-400 focus:ring-sky-200">
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700">
                        Update
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
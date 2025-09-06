@extends('layouts.app')
@section('content')

    <!-- Kegiatan Sosial -->
    <div class="mb-4py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-6 flex items-end justify-between gap-4">
                <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl text-center w-full">Kegiatan Sosial</h2>
            </div>

            @if($kegiatans->isEmpty())
                <div class="text-center text-gray-500 py-12">
                    Belum ada kegiatan sosial yang ditampilkan.
                </div>
            @else
                <div
                    class="grid gap-x-4 gap-y-6 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-3 xl:grid-cols-4 mt-6 border-t border-gray-400 pt-6">
                    @foreach($kegiatans as $kegiatan)
                        <div>
                            <a href="{{ route('kegiatan.detail', ['id' => $kegiatan->id]) }}" class="group mb-2 block h-96 overflow-hidden rounded-lg bg-gray-100 shadow-lg lg:mb-3">
                                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" loading="lazy" decoding="async"
                                    alt="Foto kegiatan {{ $kegiatan->name }}"
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
                <div class="mt-8">
                    {{ $kegiatans->links() }}
                </div>
            @endif
        </div>
    </div>


@endsection
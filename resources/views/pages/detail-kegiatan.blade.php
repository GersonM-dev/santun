@extends('layouts.app')
@section('content')
<div class="bg-white py-8">
    <div class="mx-auto max-w-2xl px-4">
        <div class="mb-6">
            <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                 alt="Foto kegiatan {{ $kegiatan->name }}"
                 class="w-full rounded-xl shadow-lg mb-4" />
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $kegiatan->name }}</h1>
            <p class="text-gray-500 mb-4">{{ \Carbon\Carbon::parse($kegiatan->date)->format('d M Y') }}</p>
            <div class="prose prose-indigo text-gray-700">
                {!! str($kegiatan->konten)->sanitizeHtml() !!}
            </div>
            @if($kegiatan->youtube_video_link)
                <div class="mt-6 aspect-w-16 aspect-h-9">
                    <iframe src="{{ $kegiatan->youtube_video_link }}" frameborder="0" allowfullscreen class="w-full h-72 rounded-lg"></iframe>
                </div>
            @endif
            @if($kegiatan->lokasi)
                <div class="mt-4 text-sm text-gray-600">Lokasi: {{ $kegiatan->lokasi }}</div>
            @endif
        </div>
        <a href="{{ route('kegiatan') }}" class="text-indigo-500 hover:underline">&larr; Kembali ke daftar kegiatan</a>
    </div>
</div>
@endsection

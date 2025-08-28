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
                <div class="mt-6">
                    @php
                        // Extract the YouTube video ID from the link
                        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([^\s&]+)/', $kegiatan->youtube_video_link, $matches);
                        $videoId = $matches[1] ?? null;
                    @endphp
                    @if($videoId)
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen
                            class="w-full rounded-lg"></iframe>
                    @endif
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

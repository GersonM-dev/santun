@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    {{-- Tampilkan gambar penuh dari koleksi kegiatan jika tersedia --}}
    @if(isset($kegiatanImages) && count($kegiatanImages) > 0)
    <div class="w-full mb-6">
        <img src="{{ asset('storage/' . $kegiatanImages[0]->gambar) }}" alt="{{ $kegiatanImages[0]->name }}" class="w-full h-80 object-cover rounded-lg shadow-md" />
    </div>
    @endif

    {{-- Informasi donasi berdasarkan mode --}}
    <div class="space-y-4">
        @if($mode === 'materi')
            <h1 class="text-2xl font-bold mb-2">Informasi Donasi Materi</h1>
            <p>Donasi materi adalah bantuan yang diberikan dalam bentuk uang atau barang yang memiliki nilai ekonomis, yang digunakan untuk mendukung kegiatan dan layanan kemanusiaan Relawan ODGJ Baturaden.</p>
            <p><strong>Donasi Uang:</strong> Dapat disalurkan melalui tunai atau transfer bank. Dana ini digunakan untuk biaya operasional, perawatan pasien, pengadaan perlengkapan kesehatan, dukungan pendidikan, serta kegiatan sosial lainnya.<br />
            <em>Rekening Donasi Uang: Bank BRI – No. Rekening 12345678 – a.n. Muhajianto</em></p>
            <p><strong>Donasi Barang:</strong> Bantuan dalam bentuk barang dapat meliputi kebutuhan pokok (beras, minyak, gula), perlengkapan kesehatan (obat-obatan, alat medis sederhana), pakaian layak pakai, perlengkapan sekolah (buku, alat tulis, tas, seragam), dan barang bermanfaat lainnya.</p>
            <p>Donasi barang dapat dikirim langsung ke alamat: Relawan ODGJ Baturaden, Desa Kemutug Kidul, Gg. Banowati No. 17, RT 04/RW 03, Kecamatan Baturaden, Kabupaten Banyumas, Jawa Tengah.</p>
        @elseif($mode === 'non-materi')
            <h1 class="text-2xl font-bold mb-2">Informasi Donasi Non Materi</h1>
            <p>Donasi non‑materi adalah dukungan yang diberikan dalam bentuk tenaga, waktu, pemikiran, atau keahlian, yang tidak berwujud fisik namun memiliki nilai yang sangat besar bagi keberlangsungan kegiatan sosial.</p>
            <ul class="list-disc list-inside">
                <li><strong>Tenaga:</strong> membantu di lapangan, mendampingi pasien ODGJ, atau menyalurkan bantuan.</li>
                <li><strong>Waktu:</strong> berpartisipasi dalam kunjungan pasien, pendampingan belajar, atau kegiatan sosial.</li>
                <li><strong>Pemikiran:</strong> memberi ide dan saran untuk pengembangan program.</li>
                <li><strong>Keahlian:</strong> menyumbangkan kemampuan khusus seperti konseling, pelatihan, atau layanan kesehatan.</li>
            </ul>
            <p>Partisipasi Anda dalam donasi non‑materi akan menjadi bagian penting dari langkah besar dalam membangun masyarakat yang lebih peduli dan saling mendukung.</p>
        @else
            <h1 class="text-2xl font-bold mb-2">Pilih Jenis Donasi</h1>
            <p>Pilih tipe donasi yang sesuai: <strong>Materi</strong> atau <strong>Non‑Materi</strong>. Setelah memilih, Anda akan melihat penjelasan singkat sesuai pilihan.</p>
        @endif
        <a href="{{ route('formdonasi', $mode) }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Lanjut ke Form Donasi</a>
    </div>

    {{-- Carousel gambar kegiatan --}}
    @if(isset($kegiatanImages) && count($kegiatanImages) > 1)
    <div class="mt-8">
        <div id="donasiCarousel" class="relative overflow-hidden rounded-lg shadow-md">
            @foreach($kegiatanImages as $index => $kg)
                <div class="carousel-item @if($index !== 0) hidden @endif">
                    <img src="{{ asset('storage/' . $kg->gambar) }}" alt="{{ $kg->name }}" class="w-full h-64 object-cover" />
                    <div class="absolute bottom-4 left-4 bg-white bg-opacity-70 p-2 rounded text-sm font-medium">
                        {{ $kg->name }}
                    </div>
                </div>
            @endforeach
            <button id="prevDonasiBtn" type="button" class="absolute top-1/2 left-2 -translate-y-1/2 bg-black/50 text-white p-1 rounded-full hover:bg-black/70">‹</button>
            <button id="nextDonasiBtn" type="button" class="absolute top-1/2 right-2 -translate-y-1/2 bg-black/50 text-white p-1 rounded-full hover:bg-black/70">›</button>
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('#donasiCarousel .carousel-item');
    if (!items.length) return;
    let idx = 0;
    function show(i) {
        items.forEach((el, k) => el.classList.toggle('hidden', k !== i));
    }
    const prevBtn = document.getElementById('prevDonasiBtn');
    const nextBtn = document.getElementById('nextDonasiBtn');
    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            idx = (idx - 1 + items.length) % items.length;
            show(idx);
        });
        nextBtn.addEventListener('click', () => {
            idx = (idx + 1) % items.length;
            show(idx);
        });
    }
    setInterval(() => {
        idx = (idx + 1) % items.length;
        show(idx);
    }, 5000);
});
</script>
@endsection
<x-filament::page>
    <div class="space-y-6">
        <x-filament::card>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="space-y-1">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Rekap Layanan (Bantuan)</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-3xl">
                        Unduh atau cetak ringkasan seluruh data permohonan layanan/bantuan dalam format PDF. File akan dibuka pada tab baru.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <x-filament::button tag="a" href="{{ route('bantuan.rekap.pdf') }}" target="_blank" icon="heroicon-o-printer">
                        Cetak PDF
                    </x-filament::button>
                </div>
            </div>
        </x-filament::card>

        <x-filament::card>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="space-y-1">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Rekap Donasi</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-3xl">
                        Unduh atau cetak rekapitulasi donasi (materi maupun non-materi) lengkap dengan ringkasan tujuan dan rincian catatan.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <x-filament::button tag="a" href="{{ route('donasi.rekap.pdf') }}" target="_blank" icon="heroicon-o-printer">
                        Cetak PDF
                    </x-filament::button>
                </div>
            </div>
        </x-filament::card>
    </div>
</x-filament::page>

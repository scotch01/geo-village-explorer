@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-10 animate-fade-in px-2 sm:px-0">

        <x-back-button :href="route('admin.tempat.survey', $tempat)">
            Kembali
        </x-back-button>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="text-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Detail Data BLOK TAMBAHAN
            </h1>
            <p class="text-sm lg:text-base font-medium text-slate-700 mt-1">Keterangan Data Bangunan Lainnya</p>
        </div>

        <!-- Flash Message -->
        <x-alert />

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

            <div class="flex items-center gap-4">
                <div class="w-2 h-8 rounded-full bg-fuchsia-600"></div>
                <div>
                    <h2 class="font-black text-xl text-slate-900 tracking-tight">
                        BLOK TAMBAHAN
                    </h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                        KETERANGAN DATA BANGUNAN LAINNYA/INFRASTRUKTUR
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">

            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    I. Informasi Infrastruktur
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama Infrastruktur --}}
                <div class="space-y-1">

                    <span class="block text-sm font-bold text-slate-700">
                        1. Nama Infrastruktur
                    </span>

                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $bangunanLainnya->nama_infrastruktur ?? '-' }}
                    </p>

                </div>

                {{-- Kategori --}}
                <div class="space-y-1">

                    <span class="block text-sm font-bold text-slate-700">
                        2. Kategori
                    </span>

                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $kategori[$bangunanLainnya->kategori] ?? '-' }}
                    </p>

                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2">

                    <span class="block text-sm font-bold text-slate-700 mb-4">
                        3. Alamat
                    </span>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-1">

                            <span class="block text-sm font-bold text-slate-600">
                                a. Provinsi
                            </span>

                            <p class="font-semibold text-slate-800 text-sm lg:text-base">
                                {{ $bangunanLainnya->provinsi ?? '-' }}
                            </p>

                        </div>

                        <div class="space-y-1">

                            <span class="block text-sm font-bold text-slate-600">
                                b. Kabupaten/Kota
                            </span>

                            <p class="font-semibold text-slate-800 text-sm lg:text-base">
                                {{ $bangunanLainnya->kabupaten ?? '-' }}
                            </p>

                        </div>

                        <div class="space-y-1">

                            <span class="block text-sm font-bold text-slate-600">
                                c. Kecamatan
                            </span>

                            <p class="font-semibold text-slate-800 text-sm lg:text-base">
                                {{ $bangunanLainnya->kecamatan ?? '-' }}
                            </p>

                        </div>

                        <div class="space-y-1">

                            <span class="block text-sm font-bold text-slate-600">
                                d. Desa/Kelurahan
                            </span>

                            <p class="font-semibold text-slate-800 text-sm lg:text-base">
                                {{ $bangunanLainnya->desa ?? '-' }}
                            </p>

                        </div>

                        <div class="space-y-1">

                            <span class="block text-sm font-bold text-slate-600">
                                e. Dusun
                            </span>

                            <p class="font-semibold text-slate-800 text-sm lg:text-base">
                                {{ $bangunanLainnya->dusun ?? '-' }}
                            </p>

                        </div>

                        <div class="md:col-span-2 space-y-1">

                            <span class="block text-sm font-bold text-slate-600">
                                f. Alamat Detail
                            </span>

                            <p class="font-semibold text-slate-800 text-sm lg:text-base whitespace-pre-line">
                                {{ $bangunanLainnya->alamat ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Email --}}
                <div class="space-y-1">

                    <span class="block text-sm font-bold text-slate-700">
                        4. Email
                    </span>

                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $bangunanLainnya->email ?? '-' }}
                    </p>

                </div>

                {{-- Website --}}
                <div class="space-y-1">

                    <span class="block text-sm font-bold text-slate-700">
                        5. Website
                    </span>

                    <p class="font-semibold text-slate-800 text-sm lg:text-base break-all">
                        {{ $bangunanLainnya->website ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">

            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>

                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    VI. Tagging Lokasi
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-6">

                <div>
                    <p class="text-sm font-bold text-slate-500">
                        Latitude
                    </p>

                    <p class="font-semibold text-slate-900">
                        {{ $bangunanLainnya->latitude ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-500">
                        Longitude
                    </p>

                    <p class="font-semibold text-slate-900">
                        {{ $bangunanLainnya->longitude ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm font-bold text-slate-500">
                        Akurasi GPS
                    </p>

                    <p class="font-semibold text-slate-900">
                        {{ $bangunanLainnya->akurasi ? number_format($bangunanLainnya->akurasi, 0) . ' meter' : '-' }}
                    </p>
                </div>

            </div>

            <div id="map-show" class="h-[400px] rounded-2xl border border-slate-200"></div>

        </div>

        <!-- BOTTOM ACTIONS BAR -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">

            <div class="text-center md:text-left">
                <p class="text-lg md:text-xl font-bold text-slate-800">Lakukan Perubahan?</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 w-full md:w-auto">
                @if (auth()->user()->isMasterAdmin())
                    <form method="POST" action="{{ route('admin.bangunan-lainnya.destroy', $tempat) }}"
                        class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus permanen data infrastruktur ini?')"
                            class="w-full sm:w-auto px-6 py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-rose-600/10 text-center">
                            Hapus Data
                        </button>
                    </form>
                @endif

                @if (auth()->user()->canEditTempat($tempat))
                    <a href="{{ route('admin.bangunan-lainnya.edit', $tempat) }}"
                        class="w-full sm:w-auto px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-amber-500/10 text-center">

                        Edit Data

                    </a>
                @else
                    <span
                        class="w-full sm:w-auto px-6 py-3.5 bg-slate-200 text-slate-500 font-bold rounded-2xl text-sm text-center cursor-not-allowed">

                        Edit Data

                    </span>
                @endif
            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener(
                'DOMContentLoaded',
                function() {

                    const lat =
                        {{ $bangunanLainnya->latitude ?: 'null' }};

                    const lng =
                        {{ $bangunanLainnya->longitude ?: 'null' }};

                    if (
                        lat === null ||
                        lng === null
                    ) {
                        return;
                    }

                    const map =
                        L.map(
                            'map-show'
                        ).setView(
                            [lat, lng],
                            18
                        );

                    L.tileLayer(
                        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 22,
                            attribution: '&copy; OpenStreetMap'
                        }
                    ).addTo(map);

                    L.marker(
                            [lat, lng]
                        )
                        .addTo(map)
                        .bindPopup(`
                            <strong>{{ $bangunanLainnya->nama_infrastruktur }}</strong>
                        `);

                }
            );
        </script>
    @endpush
@endsection

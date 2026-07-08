<div x-data="{
    selected: null,
    showImageModal: false,
    imageUrl: ''
}">
    <section id="peta" class="py-24 bg-gradient-to-bl from-purple-100 via-white to-blue-100">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-12">

                <span
                    class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">

                    Peta Interaktif

                </span>

                <h2 class="mt-6 text-4xl lg:text-5xl font-black text-slate-900">

                    Pemetaan Potensi Desa

                </h2>

                <p class="mt-4 text-lg text-slate-600 max-w-3xl mx-auto">

                    Jelajahi persebaran keluarga
                    dan usaha masyarakat secara
                    langsung melalui peta interaktif.

                </p>

            </div>

            {{-- FILTER --}}
            <div>
                <form method="GET" action="{{ route('public.spectra') }}" class="grid lg:grid-cols-12 gap-4">

                    <input type="hidden" name="scroll_to" value="peta">

                    {{-- SEARCH --}}
                    <div class="lg:col-span-4">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Cari Data
                        </label>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama kepala keluarga atau nama usaha..."
                            class="w-full rounded-2xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                    </div>

                    {{-- DESA --}}
                    <div class="lg:col-span-3">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Desa
                        </label>

                        <select name="desa"
                            class="w-full rounded-2xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">
                                Semua Desa
                            </option>

                            @foreach ($desas as $desa)
                                <option value="{{ $desa->id }}" @selected(request('desa') == $desa->id)>

                                    {{ $desa->nama_desa }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- JENIS --}}
                    <div class="lg:col-span-2">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Jenis
                        </label>

                        <select name="jenis_bangunan"
                            class="w-full rounded-2xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">
                                Semua
                            </option>

                            <option value="btt" @selected(request('jenis_bangunan') == 'btt')>

                                BTT

                            </option>

                            <option value="bku" @selected(request('jenis_bangunan') == 'bku')>

                                BKU

                            </option>

                            <option value="bc" @selected(request('jenis_bangunan') == 'bc')>

                                BC

                            </option>

                        </select>

                    </div>

                    {{-- ACTION --}}
                    <div class="lg:col-span-3 flex items-end gap-2">

                        {{-- RESET --}}
                        <a href="{{ route('public.spectra') }}#peta" title="Reset Filter"
                            class="h-[50px] w-[50px] shrink-0 rounded-2xl border border-slate-300 flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-all active:scale-95">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582M20 20v-5h-.581M5.08 9A7 7 0 0119 11m-.08 4A7 7 0 015 13" />

                            </svg>

                        </a>

                        {{-- SUBMIT --}}
                        <button type="submit"
                            class="flex-1 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 transition-all active:scale-95 flex items-center justify-center gap-2">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />

                            </svg>

                            <span class="hidden sm:inline">
                                Terapkan
                            </span>

                        </button>

                    </div>

                </form>
            </div>

            <div class="flex items-center justify-between mt-6">

                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white border border-slate-200 shadow-sm">

                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>

                    <span class="text-sm font-medium text-slate-700">

                        Menampilkan
                        <span class="font-bold text-slate-900">
                            {{ count($mapData) }}
                        </span>
                        lokasi

                    </span>

                </div>

            </div>

            {{-- MAP + PANEL --}}
            <div class="grid lg:grid-cols-12 gap-6 mt-6">

                <div class="lg:col-span-8">

                    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">

                        <div id="public-map" class="h-[350px] sm:h-[450px] lg:h-[700px] z-0">
                        </div>

                    </div>

                </div>

                <div class="lg:col-span-4">

                    <div x-on:show-location.window="selected = $event.detail"
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:sticky lg:top-24">

                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 1011.314-11.314z" />

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-bold text-slate-900">

                                    Informasi Lokasi

                                </h3>

                                <p class="text-sm text-slate-500">

                                    Klik marker pada peta

                                </p>

                            </div>

                        </div>

                        <div class="border-t border-slate-100 pt-4">

                            <template x-if="selected">

                                <div class="mb-6">

                                    <div class="text-xs font-semibold text-slate-500 mb-3">
                                        Foto Bangunan
                                    </div>

                                    <template x-if="selected.foto">

                                        <div @click="
                                        imageUrl = selected.foto;
                                        showImageModal = true;
                                    "
                                            class="relative rounded-2xl overflow-hidden border border-slate-200 cursor-zoom-in group">

                                            <img :src="selected.foto"
                                                class="w-full h-52 object-cover transition duration-500 group-hover:scale-105">

                                            <div
                                                class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center">

                                                <div
                                                    class="opacity-0 group-hover:opacity-100 transition bg-white/90 rounded-full p-3 shadow-lg">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-6 h-6 text-slate-700" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 3h6m0 0v6m0-6L14 10M9 21H3m0 0v-6m0 6l7-7" />

                                                    </svg>

                                                </div>

                                            </div>

                                        </div>

                                    </template>

                                    <template x-if="!selected.foto">

                                        <div
                                            class="h-52 rounded-2xl border border-dashed border-slate-300 bg-slate-50 flex items-center justify-center">

                                            <div class="text-center">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />

                                                </svg>

                                                <p class="text-sm text-slate-400">

                                                    Belum ada foto bangunan

                                                </p>

                                            </div>

                                        </div>

                                    </template>

                                </div>

                            </template>

                            {{-- EMPTY STATE --}}
                            <div x-show="!selected" class="text-center py-16">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-300 mx-auto mb-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 01.553-.894L9 2m0 18l6-3m-6 3V2m6 15l6 3m0-18l-6 3m6-3v18m-6-15v15" />

                                </svg>

                                <p class="text-slate-500">

                                    Pilih marker pada peta
                                    untuk melihat detail data.

                                </p>

                            </div>

                            {{-- DETAIL --}}
                            <div x-show="selected" class="space-y-4">

                                <template x-if="selected?.type === 'btt'">

                                    <div class="space-y-4">

                                        <div>
                                            <div class="text-xs text-slate-500">
                                                Jenis Bangunan
                                            </div>

                                            <div class="font-semibold text-slate-900"
                                                x-text="selected?.type?.toUpperCase()">
                                            </div>
                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Kepala Keluarga
                                            </div>

                                            <div class="font-medium" x-text="selected.nama_kepala_keluarga">
                                            </div>

                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Jumlah Anggota Keluarga
                                            </div>

                                            <div class="font-medium" x-text="selected.jumlah_anggota + ' Orang'">
                                            </div>

                                        </div>

                                    </div>

                                </template>

                                <template x-if="selected?.type === 'bku'">

                                    <div class="space-y-4">

                                        <div>
                                            <div class="text-xs text-slate-500">
                                                Jenis Bangunan
                                            </div>

                                            <div class="font-semibold text-slate-900"
                                                x-text="selected?.type?.toUpperCase()">
                                            </div>
                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Nama Usaha
                                            </div>

                                            <div class="font-medium" x-text="selected.nama_usaha">
                                            </div>

                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Pemilik
                                            </div>

                                            <div class="font-medium" x-text="selected.nama_pemilik">
                                            </div>

                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Kegiatan Utama
                                            </div>

                                            <div class="font-medium" x-text="selected.kegiatan_utama || '-'">
                                            </div>

                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Produk Utama
                                            </div>

                                            <div class="font-medium" x-text="selected.produk_utama || '-'">
                                            </div>

                                        </div>

                                    </div>

                                </template>

                                <template x-if="selected?.type === 'bc'">

                                    <div class="space-y-4">

                                        <div>
                                            <div class="text-xs text-slate-500">
                                                Jenis Bangunan
                                            </div>

                                            <div class="font-semibold text-slate-900"
                                                x-text="selected?.type?.toUpperCase()">
                                            </div>
                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Kepala Keluarga
                                            </div>

                                            <div class="font-medium" x-text="selected.nama_kepala_keluarga">
                                            </div>

                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500">
                                                Jumlah Anggota Keluarga
                                            </div>

                                            <div class="font-medium" x-text="selected.jumlah_anggota + ' Orang'">
                                            </div>

                                        </div>

                                        <div>

                                            <div class="text-xs text-slate-500 mb-2">
                                                Daftar Usaha
                                            </div>

                                            <ul class="space-y-2">

                                                <template x-for="usaha in selected.usahas" :key="usaha.nama_usaha">

                                                    <li class="rounded-xl bg-slate-50 p-3">

                                                        <div class="font-medium" x-text="usaha.nama_usaha">
                                                        </div>

                                                        <div class="text-sm text-slate-500"
                                                            x-text="usaha.kegiatan_utama">
                                                        </div>

                                                    </li>

                                                </template>

                                            </ul>

                                        </div>

                                    </div>

                                </template>

                            </div>

                            <template x-if="selected">

                                <div class="pt-4 mt-4 border-t border-slate-200">

                                    <div class="text-xs font-semibold text-slate-500 mb-1">
                                        Titik Koordinat
                                    </div>

                                    <div class="flex flex-wrap items-center gap-3">

                                        <span class="text-sm text-slate-600 font-mono"
                                            x-text="selected ? `${selected.lat}, ${selected.lng}` : ''">
                                        </span>

                                        <a :href="selected
                                            ?
                                            `https://www.google.com/maps?q=${selected.lat},${selected.lng}` :
                                            '#'"
                                            target="_blank"
                                            class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 hover:text-emerald-700">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 2C6.13 2 3 5.13 3 9c0 5.25 7 9 7 9s7-3.75 7-9c0-3.87-3.13-7-7-7z" />
                                            </svg>

                                            Lihat di Google Maps

                                        </a>

                                    </div>
                                </div>

                            </template>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <div x-show="showImageModal" x-cloak class="fixed inset-0 z-[99999] flex items-center justify-center p-4"
        style="display:none;">

        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="showImageModal = false">
        </div>

        <div x-show="showImageModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" class="relative z-10">

            <img :src="imageUrl" class="max-w-[92vw] max-h-[92vh] rounded-3xl shadow-2xl object-contain">

            <button @click="showImageModal=false"
                class="absolute -top-4 -right-4 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center">

                ✕

            </button>

        </div>

    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            () => {

                const mapData = @json($mapData);

                const map = L.map(
                    'public-map', {
                        zoomControl: false
                    }
                );

                L.control.zoom({
                    position: 'bottomright'
                }).addTo(map);

                L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }
                ).addTo(map);

                const markers =
                    L.markerClusterGroup({
                        showCoverageOnHover: false,
                        spiderfyOnMaxZoom: true,
                    });

                const bounds = [];

                function getMarkerIcon(type) {

                    let color = 'blue';

                    switch (type) {

                        case 'bc':
                            color = 'green';
                            break;

                        case 'bku':
                            color = 'red';
                            break;

                        case 'btt':
                            color = 'blue';
                            break;
                    }

                    return new L.Icon({
                        iconUrl: `https://maps.gstatic.com/mapfiles/ms2/micons/${color}-dot.png`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                    });
                }

                let activeMarker = null;
                let activeMarkerType = null;

                function getActiveMarkerIcon() {

                    return new L.Icon({
                        iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/yellow-dot.png',

                        iconSize: [38, 38],

                        iconAnchor: [19, 38],
                    });

                }

                mapData.forEach(item => {

                    if (!item.lat || !item.lng) {
                        return;
                    }

                    const marker = L.marker(
                        [
                            item.lat,
                            item.lng
                        ], {
                            icon: getMarkerIcon(
                                item.type
                            )
                        }
                    );

                    marker.on('click', () => {

                        if (
                            activeMarker &&
                            activeMarkerType
                        ) {

                            activeMarker.setIcon(
                                getMarkerIcon(
                                    activeMarkerType
                                )
                            );

                        }

                        marker.setIcon(
                            getActiveMarkerIcon()
                        );

                        activeMarker = marker;

                        activeMarkerType = item.type;

                        /**
                         * Fly hanya jika zoom masih jauh
                         */
                        if (
                            map.getZoom() < 16
                        ) {

                            map.flyTo(
                                [
                                    item.lat,
                                    item.lng
                                ],
                                17, {
                                    duration: 1
                                }
                            );

                        }

                        window.dispatchEvent(
                            new CustomEvent(
                                'show-location', {
                                    detail: item
                                }
                            )
                        );

                    });

                    markers.addLayer(
                        marker
                    );

                    bounds.push([
                        item.lat,
                        item.lng
                    ]);
                });

                map.addLayer(
                    markers
                );

                if (bounds.length > 0) {

                    map.fitBounds(
                        bounds, {
                            padding: [50, 50]
                        }
                    );

                } else {

                    map.setView(
                        [-0.6264, 100.1190],
                        12
                    );

                }

                setTimeout(() => {

                    map.invalidateSize();

                }, 300);

            }
        );
    </script>
@endpush

@if (request('scroll_to') === 'peta')
    @push('scripts')
        <script>
            window.addEventListener(
                'load',
                () => {

                    document
                        .getElementById('peta')
                        ?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                }
            );
        </script>
    @endpush
@endif

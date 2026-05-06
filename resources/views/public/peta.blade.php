<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Wilayah</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet -->
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <!-- Cluster -->
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css"/>

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css"/>

    <!-- Alpine -->
    <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }
    </style>

    <script>
        function petaExplorer() {
            return {
                open: false,
                data: {},

                show(payload) {
                    this.data = payload;
                    this.open = true;
                },

                close() {
                    this.open = false;
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 antialiased"
      x-data="petaExplorer()"
      @open-modal.window="show($event.detail)">

<!-- NAVBAR -->
<nav class="sticky top-0 z-[1000] bg-white/90 backdrop-blur border-b border-slate-200">

    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        <div>
            <h1 class="font-bold text-slate-800 text-lg">
                🌍 GeoSpatial Explorer
            </h1>

            <p class="text-xs text-slate-500">
                Sistem Informasi Pemetaan Wilayah
            </p>
        </div>

        <div class="flex items-center gap-3">

            <a href="{{ route('login') }}"
               class="text-sm text-slate-600 hover:text-blue-600 font-medium transition">
                Login
            </a>

            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                Live
            </span>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 pt-10 pb-6">

    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">

        <div>

            <h2 class="text-4xl font-black text-slate-900 leading-tight">
                Peta Sebaran Wilayah
            </h2>

            <p class="mt-3 text-slate-500 max-w-3xl leading-relaxed">
                Visualisasi persebaran ekonomi, pendidikan, kesehatan,
                perumahan, dan potensi wilayah berbasis geospasial.
            </p>

        </div>

        <div class="grid grid-cols-3 gap-4">

            <div class="bg-white rounded-2xl border border-slate-200 px-5 py-4 shadow-sm">
                <div class="text-2xl font-black text-slate-800">
                    {{ $tempats->count() }}
                </div>

                <div class="text-xs text-slate-500 mt-1">
                    Total Lokasi
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 px-5 py-4 shadow-sm">
                <div class="text-2xl font-black text-slate-800">
                    {{ $desas->count() }}
                </div>

                <div class="text-xs text-slate-500 mt-1">
                    Desa
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 px-5 py-4 shadow-sm">
                <div class="text-2xl font-black text-slate-800">
                    {{ count($sektors) }}
                </div>

                <div class="text-xs text-slate-500 mt-1">
                    Sektor
                </div>
            </div>

        </div>

    </div>

</section>

<!-- FILTER -->
<section class="max-w-7xl mx-auto px-6 pb-6">

    <form method="GET"
          class="bg-white rounded-3xl border border-slate-200 shadow-sm p-5">

        <div class="grid lg:grid-cols-4 gap-4">

            <!-- SEARCH -->
            <div>
                <label class="text-xs font-semibold text-slate-500 block mb-2">
                    Pencarian
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari tempat..."
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <!-- SEKTOR -->
            <div>
                <label class="text-xs font-semibold text-slate-500 block mb-2">
                    Sektor
                </label>

                <select
                    name="sektor"
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">
                        Semua Sektor
                    </option>

                    @foreach($sektors as $key => $label)

                        <option value="{{ $key }}"
                            @selected(request('sektor') == $key)>

                            {{ $label }}

                        </option>

                    @endforeach

                </select>
            </div>

            <!-- DESA -->
            <div>
                <label class="text-xs font-semibold text-slate-500 block mb-2">
                    Desa
                </label>

                <select
                    name="desa"
                    class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500">

                    <option value="">
                        Semua Desa
                    </option>

                    @foreach($desas as $desa)

                        <option value="{{ $desa->id }}"
                            @selected(request('desa') == $desa->id)>

                            {{ $desa->nama_desa }}

                        </option>

                    @endforeach

                </select>
            </div>

            <!-- BUTTON -->
            <div class="flex items-end">

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold py-3 transition shadow-sm">

                    Terapkan Filter

                </button>

            </div>

        </div>

    </form>

</section>

<!-- MAP -->
<section class="max-w-7xl mx-auto px-6 pb-16">

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-3">

        <div id="map"
             class="rounded-2xl"
             style="height: 700px;"></div>

    </div>

</section>

<!-- MODAL -->
<div x-show="open"
     x-cloak
     class="fixed inset-0 z-[9999] flex items-center justify-center p-4">

    <!-- BACKDROP -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"
         @click="close()"></div>

    <!-- CONTENT -->
    <div x-show="open"
         x-transition
         class="relative z-10 w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">

            <div class="flex items-start justify-between gap-4">

                <div>

                    <h2 class="text-xl font-black text-slate-800"
                        x-text="data.nama_tempat">
                    </h2>

                    <div class="mt-2">

                        <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase"
                              x-text="data.sektor">
                        </span>

                    </div>

                </div>

                <button
                    @click="close()"
                    class="text-slate-400 hover:text-slate-600 text-xl">
                    ✕
                </button>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-6 space-y-5">

            <div class="grid grid-cols-3 gap-3">

                <span class="text-sm font-semibold text-slate-500">
                    Pemilik
                </span>

                <span class="text-sm text-slate-800 col-span-2"
                      x-text="data.nama_pemilik || '-'">
                </span>

            </div>

            <div class="grid grid-cols-3 gap-3">

                <span class="text-sm font-semibold text-slate-500">
                    Desa
                </span>

                <span class="text-sm text-slate-800 col-span-2"
                      x-text="data.desa?.nama_desa || '-'">
                </span>

            </div>

            <div class="grid grid-cols-3 gap-3">

                <span class="text-sm font-semibold text-slate-500">
                    Kontak
                </span>

                <span class="text-sm text-slate-800 col-span-2"
                      x-text="data.no_hp || '-'">
                </span>

            </div>

            <div class="grid grid-cols-3 gap-3">

                <span class="text-sm font-semibold text-slate-500">
                    Deskripsi
                </span>

                <span class="text-sm text-slate-700 leading-relaxed col-span-2"
                      x-text="data.deskripsi || '-'">
                </span>

            </div>

            <div class="grid grid-cols-3 gap-3">

                <span class="text-sm font-semibold text-slate-500">
                    Alamat
                </span>

                <span class="text-sm text-slate-700 leading-relaxed col-span-2"
                      x-text="data.alamat">
                </span>

            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">

                <div class="text-xs text-slate-400 font-mono">

                    <span x-text="data.latitude"></span>,
                    <span x-text="data.longitude"></span>

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="px-6 py-5 bg-slate-50 border-t border-slate-100">

            <a :href="'https://www.google.com/maps?q=' + data.latitude + ',' + data.longitude"
               target="_blank"
               class="w-full inline-flex items-center justify-center rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 transition">

                Buka di Google Maps

            </a>

        </div>

    </div>

</div>

<!-- LEAFLET -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- CLUSTER -->
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const map = L.map('map', {
        zoomControl: false
    }).setView([-2.5, 118], 5);

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    const markers = L.markerClusterGroup({
        showCoverageOnHover: false,
        spiderfyOnMaxZoom: true,
    });

    const bounds = [];

    const data = @json($tempats);

    function getMarkerIcon(sektor) {

        let color = 'blue';

        switch (sektor) {

            case 'ekonomi':
                color = 'green';
                break;

            case 'pendidikan':
                color = 'blue';
                break;

            case 'kesehatan':
                color = 'red';
                break;

            case 'perumahan':
                color = 'orange';
                break;
        }

        return new L.Icon({
            iconUrl: `https://maps.gstatic.com/mapfiles/ms2/micons/${color}-dot.png`,
            iconSize: [32, 32],
            iconAnchor: [16, 32],
        });
    }

    data.forEach(item => {

        if (!item.latitude || !item.longitude) return;

        const lat = parseFloat(item.latitude);
        const lng = parseFloat(item.longitude);

        const marker = L.marker(
            [lat, lng],
            {
                icon: getMarkerIcon(item.sektor)
            }
        );

        marker.on('click', () => {

            window.dispatchEvent(
                new CustomEvent(
                    'open-modal',
                    {
                        detail: item
                    }
                )
            );

        });

        markers.addLayer(marker);

        bounds.push([lat, lng]);
    });

    map.addLayer(markers);

    if (bounds.length > 0) {

        map.fitBounds(bounds, {
            padding: [50, 50]
        });

    }

    setTimeout(() => {
        map.invalidateSize();
    }, 300);
});
</script>

</body>
</html>
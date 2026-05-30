<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPETA - Peta Wilayah</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('bps.ico') }}" sizes="any">

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

        body {
            background:
                radial-gradient(circle at top left, rgba(59,130,246,.08), transparent 30%),
                radial-gradient(circle at top right, rgba(168,85,247,.08), transparent 35%),
                radial-gradient(circle at bottom left, rgba(16,185,129,.06), transparent 30%),
                #f8fafc;
        }

        .aurora-card {
            background: rgba(255,255,255,.82);
            backdrop-filter: blur(16px);
        }

        .hero-glow {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .hero-glow::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            top: -180px;
            left: -120px;
            background: rgba(59,130,246,.18);
            filter: blur(120px);
            border-radius: 999px;
        }

        .hero-glow::after {
            content: '';
            position: absolute;
            width: 450px;
            height: 450px;
            top: -120px;
            right: -120px;
            background: rgba(168,85,247,.14);
            filter: blur(120px);
            border-radius: 999px;
        }

        .leaflet-container {
            font-family: inherit;
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

<body class="antialiased text-slate-800"
      x-data="petaExplorer()"
      @open-modal.window="show($event.detail)">

<!-- NAVBAR -->
<nav class="sticky top-0 z-[1000] border-b border-white/30 bg-white/70 backdrop-blur-xl">

    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <div class="flex items-center gap-4">

            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-200">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-6 h-6 text-white"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.553-.894L9 7m0 13l6-3m-6 3V7m6 10l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m-6 3l6-3"/>
                </svg>

            </div>

            <div>

                <h1 class="font-black text-xl tracking-tight">
                    SIPETA
                </h1>

                <p class="text-sm text-slate-500">
                    Sistem Informasi Pemetaan Wilayah
                </p>

            </div>

        </div>

        <div class="flex items-center gap-4">

            <a href="{{ route('login') }}"
               class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                Login
            </a>

            <div class="px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">
                LIVE DATA
            </div>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="relative overflow-hidden">

    <div class="hero-glow"></div>

    <div class="max-w-7xl mx-auto px-6 pt-20 pb-14 relative">

        <div class="max-w-4xl">

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 border border-slate-200 text-sm font-semibold text-slate-700 shadow-sm">

                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                Geographic Information System

            </div>

            <h2 class="mt-8 text-5xl md:text-6xl font-black tracking-tight leading-[1.05] text-slate-900">

                Eksplorasi
                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Data Wilayah
                </span>
                Secara Visual

            </h2>

            <p class="mt-6 text-lg text-slate-600 leading-relaxed max-w-3xl">

                Platform pemetaan wilayah berbasis geospasial untuk menampilkan
                persebaran ekonomi, pendidikan, kesehatan, perumahan,
                dan potensi desa secara interaktif.

            </p>

        </div>

        <!-- STATS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mt-14">

            <div class="aurora-card rounded-3xl border border-white/60 shadow-xl shadow-slate-200/40 p-6">

                <div class="text-4xl font-black text-slate-900">
                    {{ $tempats->count() }}
                </div>

                <div class="mt-2 text-sm text-slate-500">
                    Total Lokasi
                </div>

            </div>

            <div class="aurora-card rounded-3xl border border-white/60 shadow-xl shadow-slate-200/40 p-6">

                <div class="text-4xl font-black text-slate-900">
                    {{ $desas->count() }}
                </div>

                <div class="mt-2 text-sm text-slate-500">
                    Desa Terdata
                </div>

            </div>

            <div class="aurora-card rounded-3xl border border-white/60 shadow-xl shadow-slate-200/40 p-6">

                <div class="text-4xl font-black text-slate-900">
                    {{ count($sektors) }}
                </div>

                <div class="mt-2 text-sm text-slate-500">
                    Sektor Wilayah
                </div>

            </div>

            <div class="aurora-card rounded-3xl border border-white/60 shadow-xl shadow-slate-200/40 p-6">

                <div class="text-4xl font-black text-slate-900">
                    GIS
                </div>

                <div class="mt-2 text-sm text-slate-500">
                    Interactive Explorer
                </div>

            </div>

        </div>

    </div>

</section>

<!-- FILTER -->
<section class="max-w-7xl mx-auto px-6 pb-8">

    <form method="GET"
          class="aurora-card rounded-[2rem] border border-white/60 shadow-xl shadow-slate-200/40 p-6">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-11 h-11 rounded-2xl bg-blue-100 flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-blue-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 7v5l-4 2v-7L3 6V4z"/>
                </svg>

            </div>

            <div>

                <h3 class="font-bold text-slate-800">
                    Filter Data Wilayah
                </h3>

                <p class="text-sm text-slate-500">
                    Sesuaikan tampilan peta berdasarkan kebutuhan eksplorasi
                </p>

            </div>

        </div>

        <div class="grid lg:grid-cols-4 gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari tempat..."
                class="h-14 rounded-2xl border-slate-200 bg-white/70 focus:border-blue-500 focus:ring-blue-500"
            >

            <select
                name="sektor"
                class="h-14 rounded-2xl border-slate-200 bg-white/70 focus:border-blue-500 focus:ring-blue-500">

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

            <select
                name="desa"
                class="h-14 rounded-2xl border-slate-200 bg-white/70 focus:border-blue-500 focus:ring-blue-500">

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

            <button
                class="h-14 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-95 text-white font-bold shadow-lg shadow-blue-200 transition">

                Terapkan Filter

            </button>

        </div>

    </form>

</section>

<!-- MAP -->
<section class="max-w-7xl mx-auto px-6 pb-20">

    <div class="aurora-card rounded-[2rem] border border-white/60 shadow-2xl shadow-slate-200/40 p-4 overflow-hidden">

        <div id="map"
             class="rounded-[1.5rem]"
             style="height: 760px;"></div>

    </div>

</section>

<!-- MODAL -->
<div x-show="open"
     x-cloak
     class="fixed inset-0 z-[9999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/60 backdrop-blur-md"
         @click="close()"></div>

    <div x-show="open"
         x-transition
         class="relative z-10 w-full max-w-xl aurora-card rounded-[2rem] border border-white/50 shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="px-7 py-6 border-b border-slate-100">

            <div class="flex items-start justify-between gap-5">

                <div>

                    <div class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase mb-4"
                         x-text="data.sektor">
                    </div>

                    <h2 class="text-2xl font-black text-slate-900"
                        x-text="data.nama_tempat">
                    </h2>

                </div>

                <button
                    @click="close()"
                    class="w-10 h-10 rounded-2xl hover:bg-slate-100 flex items-center justify-center transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-slate-500"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </button>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-7 space-y-6">

            <div class="grid grid-cols-3 gap-4">

                <div class="text-sm font-semibold text-slate-500">
                    Pemilik
                </div>

                <div class="col-span-2 text-sm text-slate-800"
                     x-text="data.nama_pemilik || '-'">
                </div>

            </div>

            <div class="grid grid-cols-3 gap-4">

                <div class="text-sm font-semibold text-slate-500">
                    Desa
                </div>

                <div class="col-span-2 text-sm text-slate-800"
                     x-text="data.desa?.nama_desa || '-'">
                </div>

            </div>

            <div class="grid grid-cols-3 gap-4">

                <div class="text-sm font-semibold text-slate-500">
                    Kontak
                </div>

                <div class="col-span-2 text-sm text-slate-800"
                     x-text="data.no_hp || '-'">
                </div>

            </div>

            <div class="grid grid-cols-3 gap-4">

                <div class="text-sm font-semibold text-slate-500">
                    Alamat
                </div>

                <div class="col-span-2 text-sm text-slate-700 leading-relaxed"
                     x-text="data.alamat">
                </div>

            </div>

            <div class="grid grid-cols-3 gap-4">

                <div class="text-sm font-semibold text-slate-500">
                    Deskripsi
                </div>

                <div class="col-span-2 text-sm text-slate-700 leading-relaxed"
                     x-text="data.deskripsi || '-'">
                </div>

            </div>

            <div class="pt-5 border-t border-slate-100">

                <div class="text-xs font-mono text-slate-400">

                    <span x-text="data.latitude"></span>,
                    <span x-text="data.longitude"></span>

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="p-7 border-t border-slate-100 bg-slate-50/60">

            <a :href="'https://www.google.com/maps?q=' + data.latitude + ',' + data.longitude"
               target="_blank"
               class="h-14 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-95 text-white font-bold flex items-center justify-center transition shadow-lg shadow-blue-200">

                Buka di Google Maps

            </a>

        </div>

    </div>

</div>

<!-- LEAFLET -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- CLUSTER -->
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<!-- LOGIC TETAP SAMA -->
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
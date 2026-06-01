@extends('layouts.admin')

@section('content')

<div class="max-w-4xl space-y-6">

    <!-- HEADER: Lebih tegas dan bersih -->
    <div class="flex items-center gap-4">
        <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H5a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tambah Usaha</h2>
            <p class="text-sm text-slate-500 font-medium">Lengkapi informasi detail usaha dan lokasi geografis</p>
        </div>
    </div>

    <!-- FORM CARD -->
    <form method="POST" action="{{ route('admin.usaha.store') }}"
          class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-200 space-y-8">
        @csrf

        <!-- SECTION: INFORMASI DASAR -->
        <div class="space-y-5">
            <div class="flex items-center gap-2 mb-2">
                <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-400">Informasi Umum</h3>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">Nama Usaha</label>
                    <input name="nama_usaha"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all"
                           placeholder="Masukkan nama entitas usaha"
                           required>
                </div>

                <!-- KATEGORI -->
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">Kategori Usaha</label>
                    <select name="kategori_usaha"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                        <option value="">-- Pilih Kategori --</option>
                        <option>Kuliner</option>
                        <option>Jasa</option>
                        <option>Retail</option>
                        <option>UMKM</option>
                    </select>
                </div>

                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">Nama Pemilik</label>
                    <input name="nama_pemilik"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all"
                           placeholder="Nama lengkap penanggung jawab"
                           required>
                </div>
            </div>

            <div class="group">
                <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">Alamat Lengkap</label>
                <textarea name="alamat" rows="3"
                          class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all"
                          placeholder="Tuliskan alamat detail"
                          required></textarea>
            </div>

            <!-- NO HP -->
            <div class="group">
                <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">No HP / Kontak</label>
                <input name="no_hp"
                    class="ww-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all"
                    placeholder="08xxxxxxxxxx">
            </div>

            <!-- DESKRIPSI -->
            <div class="group">
                <label class="block text-sm font-bold text-slate-700 mb-2 group-focus-within:text-blue-600 transition-colors">Deskripsi</label>
                <textarea name="deskripsi"
                        rows="3"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all"
                        placeholder="Deskripsikan usaha ini..."></textarea>
            </div>
        </div>

        <hr class="border-slate-100">

        <!-- SECTION: LOKASI -->
        <div class="space-y-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-2">
                    <span class="w-1 h-4 bg-blue-600 rounded-full"></span>
                    <h3 class="text-xs font-black uppercase tracking-widest text-slate-400">Titik Koordinat</h3>
                </div>

                <div class="flex items-center gap-3 bg-blue-50 p-1.5 pr-4 rounded-full border border-blue-100">
                    <button type="button" id="btn-gps"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-xs font-bold shadow-md shadow-blue-200 transition-all active:scale-95 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.828a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Ambil Lokasi Otomatis
                    </button>
                    <span id="gps-status" class="text-[10px] font-bold text-blue-600 uppercase tracking-tight"></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider ml-1">Latitude</label>
                    <input id="latitude" name="latitude"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 font-mono text-sm focus:bg-white focus:border-blue-500 outline-none transition-all"
                           placeholder="-6.xxxxxx"
                           required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-wider ml-1">Longitude</label>
                    <input id="longitude" name="longitude"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 font-mono text-sm focus:bg-white focus:border-blue-500 outline-none transition-all"
                           placeholder="106.xxxxxx"
                           required>
                </div>
            </div>

            <!-- MAP: Visual lebih rapi dengan shadow -->
            <div class="relative group">
                <div class="absolute inset-0 bg-blue-600/5 rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div id="mini-map" class="h-72 rounded-2xl border border-slate-200 shadow-inner z-10 relative"></div>
            </div>
        </div>

        <!-- FOOTER ACTION -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.usaha.index') }}" class="px-6 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</a>
            <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-2.5 rounded-xl shadow-lg shadow-emerald-100 transition-all active:scale-95 text-sm font-bold">
                Simpan Data Usaha
            </button>
        </div>

    </form>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const statusEl = document.getElementById('gps-status');

    let map = L.map('mini-map').setView([-6.2, 106.8], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
        .addTo(map);

    let marker = null;

    function updateMap(lat, lng) {
        if (marker) map.removeLayer(marker);
        marker = L.marker([lat, lng]).addTo(map);
        map.setView([lat, lng], 15);
    }

    // GPS BUTTON
    document.getElementById('btn-gps').addEventListener('click', () => {

        if (!navigator.geolocation) {
            statusEl.innerText = 'Browser tidak support GPS';
            return;
        }

        statusEl.innerText = 'Mengambil lokasi...';

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;

                latInput.value = lat;
                lngInput.value = lng;

                updateMap(lat, lng);

                statusEl.innerText = `✅ Lokasi ditemukan (±${Math.round(pos.coords.accuracy)}m)`;
            },
            (err) => {
                console.error(err);
                statusEl.innerText = '❌ Izin lokasi ditolak / gagal';
            },
            {
                enableHighAccuracy: true,
                timeout: 10000
            }
        );
    });

    // manual input
    latInput.addEventListener('change', () => {
        if (latInput.value && lngInput.value) {
            updateMap(parseFloat(latInput.value), parseFloat(lngInput.value));
        }
    });

});
</script>
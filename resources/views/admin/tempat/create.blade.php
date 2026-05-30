@extends('layouts.admin')

@section('content')

    <div class="max-w-5xl mx-auto space-y-8">

        <!-- HEADER -->
        <div class="flex items-start justify-between flex-wrap gap-4">

            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">
                    Tambah Tempat
                </h1>

                <p class="text-slate-500 mt-2">
                    Input data dasar bangunan sebelum proses pendataan
                </p>
            </div>

            <div class="hidden md:flex items-center gap-3 px-4 py-3 rounded-2xl bg-blue-50 border border-blue-100">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    📍
                </div>

                <div>
                    <div class="text-xs font-bold uppercase tracking-wider text-blue-600">
                        Geo Mapping
                    </div>

                    <div class="text-sm text-slate-600">
                        Sistem Pemetaan Wilayah
                    </div>
                </div>
            </div>

        </div>

        <!-- VALIDATION -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5">

                <div class="font-bold text-red-700 mb-2">
                    Terjadi Kesalahan
                </div>

                <ul class="space-y-1 text-sm text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <!-- FORM -->
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.tempat.store') }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf

            <div class="p-8 space-y-10">

                <!-- INFORMASI UMUM -->
                <section class="space-y-6">

                    <div class="flex items-center gap-3">

                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>

                        <div>
                            <h2 class="font-bold text-slate-800">
                                Informasi Umum
                            </h2>

                            <p class="text-sm text-slate-500">
                                Data dasar lokasi atau entitas
                            </p>
                        </div>

                    </div>

                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- NAMA -->
                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Nama Tempat
                            </label>

                            <input type="text" name="nama_tempat" value="{{ old('nama_tempat') }}"
                                class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Jenis Bangunan
                            </label>

                            <select name="jenis_bangunan" required
                                class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                                <option value="">
                                    -- Pilih Jenis Bangunan --
                                </option>

                                @foreach (\App\Models\Tempat::JENIS_BANGUNAN as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old('jenis_bangunan') == $value ? 'selected' : '' }}>

                                        {{ $label }}

                                    </option>
                                @endforeach

                            </select>

                            <div id="jenis-helper" class="hidden rounded-2xl bg-blue-50 border border-blue-100 p-4">

                            </div>

                        </div>

                    </div>

                    <!-- ALAMAT -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            Alamat
                        </label>

                        <textarea name="alamat" rows="4" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Foto Bangunan
                        </label>

                        <input type="file" name="foto_bangunan" accept="image/*" class="w-full mt-2">

                    </div>

                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Catatan
                        </label>

                        <textarea name="catatan" rows="4" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">{{ old('catatan') }}</textarea>

                    </div>

                </section>

                <!-- KOORDINAT -->
                <section class="space-y-6">

                    <div class="flex items-center justify-between flex-wrap gap-4">

                        <div>
                            <h2 class="font-bold text-slate-800">
                                Titik Koordinat
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Tentukan lokasi geografis pada peta
                            </p>
                        </div>

                        <button type="button" id="btn-gps"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl text-sm font-semibold shadow-lg shadow-blue-100 transition">

                            📍 Ambil Lokasi GPS

                        </button>

                    </div>

                    <div id="gps-status" class="text-sm text-blue-600 font-medium"></div>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Latitude
                            </label>

                            <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}"
                                class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50 font-mono">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Longitude
                            </label>

                            <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}"
                                class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50 font-mono">
                        </div>

                    </div>

                    <!-- MAP -->
                    <div class="overflow-hidden rounded-[2rem] border border-slate-200 shadow-sm">
                        <div id="mini-map" class="h-[420px]"></div>
                    </div>

                </section>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-slate-100 px-8 py-5 bg-slate-50 flex items-center justify-end gap-4">

                <a href="{{ route('admin.tempat.index') }}"
                    class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-200 transition">
                    Batal
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition">
                    Simpan Data
                </button>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /**
             * MAP
             */
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            const statusEl = document.getElementById('gps-status');

            const defaultLat = -0.626438;
            const defaultLng = 100.120000;

            let map = L.map('mini-map')
                .setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
                .addTo(map);

            let marker = null;

            function updateMap(lat, lng) {

                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker([lat, lng]).addTo(map);

                map.setView([lat, lng], 15);
            }

            /**
             * GPS
             */
            document.getElementById('btn-gps')
                .addEventListener('click', () => {

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

                            statusEl.innerText =
                                `✅ Lokasi ditemukan (±${Math.round(pos.coords.accuracy)}m)`;
                        },

                        () => {

                            statusEl.innerText =
                                '❌ Izin lokasi ditolak / gagal';
                        },

                        {
                            enableHighAccuracy: true,
                            timeout: 10000
                        }
                    );
                });

            /**
             * MANUAL INPUT
             */
            function manualUpdate() {

                if (latInput.value && lngInput.value) {

                    updateMap(
                        parseFloat(latInput.value),
                        parseFloat(lngInput.value)
                    );
                }
            }

            latInput.addEventListener('change', manualUpdate);
            lngInput.addEventListener('change', manualUpdate);

        });

        const jenisSelect =
            document.querySelector(
                '[name="jenis_bangunan"]'
            );

        const helper =
            document.getElementById(
                'jenis-helper'
            );

        function updateJenisHelper() {
            helper.classList.remove('hidden');

            switch (jenisSelect.value) {
                case 'btt':

                    helper.innerHTML =
                        'Bangunan digunakan sebagai tempat tinggal.';

                    break;

                case 'bku':

                    helper.innerHTML =
                        'Bangunan digunakan khusus untuk aktivitas usaha.';

                    break;

                case 'bc':

                    helper.innerHTML =
                        'Bangunan digunakan sebagai tempat tinggal sekaligus usaha.';

                    break;

                default:

                    helper.classList.add('hidden');
            }
        }

        jenisSelect.addEventListener(
            'change',
            updateJenisHelper
        );

        updateJenisHelper();
    </script>

@endsection

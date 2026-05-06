@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto space-y-8">

    <!-- HEADER -->
    <div class="flex items-start justify-between flex-wrap gap-4">

        <div>
            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Edit Tempat
            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui data lokasi, sektor, dan titik koordinat wilayah
            </p>
        </div>

        <div class="hidden md:flex items-center gap-3 px-4 py-3 rounded-2xl bg-amber-50 border border-amber-100">
            <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center">
                ✏️
            </div>

            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-amber-600">
                    Update Data
                </div>

                <div class="text-sm text-slate-600">
                    Perubahan akan langsung tersimpan
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
    <form method="POST"
          action="{{ route('admin.tempat.update', $tempat->id) }}"
          class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

        @csrf
        @method('PUT')

        <div class="p-8 space-y-10">

            <!-- INFORMASI UMUM -->
            <section class="space-y-6">

                <div class="flex items-center gap-3">

                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>

                    <div>
                        <h2 class="font-bold text-slate-800">
                            Informasi Umum
                        </h2>

                        <p class="text-sm text-slate-500">
                            Perbarui data dasar lokasi atau entitas
                        </p>
                    </div>

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <!-- NAMA -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            Nama Tempat
                        </label>

                        <input type="text"
                               name="nama_tempat"
                               value="{{ old('nama_tempat', $tempat->nama_tempat) }}"
                               class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-amber-500 focus:ring-amber-500"
                               required>
                    </div>

                    <!-- SEKTOR -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            Sektor
                        </label>

                        <select name="sektor"
                                id="sektor"
                                class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-amber-500 focus:ring-amber-500"
                                required>

                            <option value="">-- Pilih Sektor --</option>

                            @foreach(\App\Models\Tempat::SEKTOR as $value => $label)

                                <option value="{{ $value }}"
                                    {{ old('sektor', $tempat->sektor) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                </div>

                <!-- EKONOMI -->
                <div id="ekonomi-fields"
                     class="hidden bg-amber-50 border border-amber-100 rounded-2xl p-6 space-y-5">

                    <div>
                        <h3 class="font-bold text-slate-800">
                            Data Sektor Ekonomi
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Informasi tambahan khusus sektor ekonomi
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Skala Usaha
                            </label>

                            <select name="skala_usaha"
                                    class="w-full mt-2 rounded-2xl border-slate-200">

                                <option value="">-- Pilih Skala --</option>

                                <option value="mikro"
                                    {{ old('skala_usaha', $tempat->metadata['skala_usaha'] ?? '') == 'mikro' ? 'selected' : '' }}>
                                    Usaha Mikro
                                </option>

                                <option value="kecil"
                                    {{ old('skala_usaha', $tempat->metadata['skala_usaha'] ?? '') == 'kecil' ? 'selected' : '' }}>
                                    Usaha Kecil
                                </option>

                                <option value="menengah"
                                    {{ old('skala_usaha', $tempat->metadata['skala_usaha'] ?? '') == 'menengah' ? 'selected' : '' }}>
                                    Usaha Menengah
                                </option>

                                <option value="besar"
                                    {{ old('skala_usaha', $tempat->metadata['skala_usaha'] ?? '') == 'besar' ? 'selected' : '' }}>
                                    Usaha Besar
                                </option>

                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                Jumlah Karyawan
                            </label>

                            <input type="number"
                                   name="jumlah_karyawan"
                                   value="{{ old('jumlah_karyawan', $tempat->metadata['jumlah_karyawan'] ?? '') }}"
                                   class="w-full mt-2 rounded-2xl border-slate-200">
                        </div>

                    </div>

                </div>

                <!-- PEMILIK -->
                <div>
                    <label class="text-sm font-semibold text-slate-700">
                        Nama Pemilik
                    </label>

                    <input type="text"
                           name="nama_pemilik"
                           value="{{ old('nama_pemilik', $tempat->nama_pemilik) }}"
                           class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">
                </div>

                <!-- ALAMAT -->
                <div>
                    <label class="text-sm font-semibold text-slate-700">
                        Alamat
                    </label>

                    <textarea name="alamat"
                              rows="4"
                              class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50"
                              required>{{ old('alamat', $tempat->alamat) }}</textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <!-- NO HP -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            No HP
                        </label>

                        <input type="text"
                               name="no_hp"
                               value="{{ old('no_hp', $tempat->no_hp) }}"
                               class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">
                    </div>

                    <!-- DESKRIPSI -->
                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            Deskripsi Singkat
                        </label>

                        <input type="text"
                               name="deskripsi"
                               value="{{ old('deskripsi', $tempat->deskripsi) }}"
                               class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">
                    </div>

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
                            Perbarui lokasi geografis pada peta
                        </p>
                    </div>

                    <button type="button"
                            id="btn-gps"
                            class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-3 rounded-2xl text-sm font-semibold shadow-lg shadow-amber-100 transition">

                        📍 Ambil Lokasi GPS

                    </button>

                </div>

                <div id="gps-status"
                     class="text-sm text-amber-600 font-medium"></div>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            Latitude
                        </label>

                        <input type="text"
                               id="latitude"
                               name="latitude"
                               value="{{ old('latitude', $tempat->latitude) }}"
                               class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50 font-mono"
                               required>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700">
                            Longitude
                        </label>

                        <input type="text"
                               id="longitude"
                               name="longitude"
                               value="{{ old('longitude', $tempat->longitude) }}"
                               class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50 font-mono"
                               required>
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

            <button class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-amber-100 transition">
                Update Data
            </button>

        </div>

    </form>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /**
     * SEKTOR
     */
    const sektor = document.getElementById('sektor');
    const ekonomiFields = document.getElementById('ekonomi-fields');

    function toggleEkonomiFields() {

        if (sektor.value === 'ekonomi') {
            ekonomiFields.classList.remove('hidden');
        } else {
            ekonomiFields.classList.add('hidden');
        }
    }

    sektor.addEventListener('change', toggleEkonomiFields);

    toggleEkonomiFields();

    /**
     * MAP
     */
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const statusEl = document.getElementById('gps-status');

    let map = L.map('mini-map').setView([-6.2, 106.8], 10);

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
     * EXISTING COORDINATE
     */
    if (latInput.value && lngInput.value) {

        updateMap(
            parseFloat(latInput.value),
            parseFloat(lngInput.value)
        );
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

</script>

@endsection
@props([
    'latitudeField',
    'longitudeField',
    'accuracyField',

    'latitudeValue' => null,
    'longitudeValue' => null,
    'accuracyValue' => null,

    'readonly' => false,
])

@php

    $mapId = 'map-' . uniqid();

@endphp

<div class="space-y-6" x-data="geoLocationComponent()">

    @if (!$readonly)
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">

            <button type="button" @click="getLocation" :disabled="disabled" {{ $readonly ? 'disabled' : '' }}
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2
           bg-blue-600 hover:bg-blue-700
           text-white font-semibold rounded-xl transition"
                :class="{
                    'opacity-50 cursor-not-allowed bg-slate-400 hover:bg-slate-400': disabled
                }">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.071-7.071-1.414 1.414M8.343 15.657l-1.414 1.414m0-12.142 1.414 1.414m8.728 8.728 1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>

                Ambil Lokasi Saat Ini

            </button>

            <span class="text-sm text-slate-500" x-text="status"></span>

        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div>

            <label class="block text-sm font-bold text-slate-700 mb-2">
                Latitude
            </label>

            <input type="text" name="{{ $latitudeField }}" x-model="latitude"
                :readonly="disabled || {{ $readonly ? 'true' : 'false' }}" class="w-full rounded-xl border-slate-300"
                :class="{
                    'bg-slate-100 text-slate-500 cursor-not-allowed': disabled || {{ $readonly ? 'true' : 'false' }}
                }">

        </div>

        <div>

            <label class="block text-sm font-bold text-slate-700 mb-2">
                Longitude
            </label>

            <input type="text" name="{{ $longitudeField }}" x-model="longitude"
                :readonly="disabled || {{ $readonly ? 'true' : 'false' }}" class="w-full rounded-xl border-slate-300"
                :class="{
                    'bg-slate-100 text-slate-500 cursor-not-allowed': disabled || {{ $readonly ? 'true' : 'false' }}
                }">

        </div>

        <div>

            <label class="block text-sm font-bold text-slate-700 mb-2">
                Akurasi GPS (Meter)
            </label>

            <input type="text" name="{{ $accuracyField }}" x-model="accuracy"
                class="w-full rounded-xl border-slate-300 bg-slate-100" readonly>

        </div>

    </div>

    <div id="{{ $mapId }}" class="h-64 md:h-96 rounded-2xl border border-slate-200">
    </div>

</div>

<script>
    function geoLocationComponent() {
        return {

            latitude: '{{ old($latitudeField, $latitudeValue) }}',

            longitude: '{{ old($longitudeField, $longitudeValue) }}',

            accuracy: '{{ old($accuracyField, $accuracyValue) }}',

            status: '',

            map: null,

            marker: null,

            disabled: false,

            init() {
                this.map =
                    L.map(
                        '{{ $mapId }}'
                    );

                L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
                ).addTo(
                    this.map
                );

                if (
                    this.latitude &&
                    this.longitude
                ) {

                    this.updateMarker();

                } else {

                    this.map.setView(
                        [-0.6264, 100.1190],
                        13
                    );

                }

                this.$watch(
                    'latitude',
                    () => this.updateMarker()
                );

                this.$watch(
                    'longitude',
                    () => this.updateMarker()
                );

                window.addEventListener(
                    'toggle-family-location',
                    (event) => {

                        if (event.detail.enabled) {

                            this.latitude =
                                event.detail.latitude;

                            this.longitude =
                                event.detail.longitude;

                            this.accuracy =
                                event.detail.accuracy;

                            this.disabled = true;

                        } else {

                            this.latitude = '';
                            this.longitude = '';
                            this.accuracy = '';

                            this.disabled = false;

                            if (this.marker) {

                                this.map.removeLayer(
                                    this.marker
                                );

                                this.marker = null;
                            }

                            this.map.setView(
                                [-0.6264, 100.1190],
                                13
                            );
                        }
                    }
                );
            },

            getLocation() {
                this.status =
                    'Mengambil lokasi...';

                navigator.geolocation.getCurrentPosition(

                    (position) => {

                        this.latitude =
                            position.coords.latitude;

                        this.longitude =
                            position.coords.longitude;

                        this.accuracy =
                            Math.round(
                                position.coords.accuracy
                            );

                        this.status =
                            'Lokasi berhasil diperoleh';

                    },

                    () => {

                        this.status =
                            'Gagal memperoleh lokasi';

                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 15000,
                        maximumAge: 0,
                    }
                );
            },

            updateMarker() {
                if (
                    !this.latitude ||
                    !this.longitude
                ) {
                    return;
                }

                const lat =
                    parseFloat(
                        this.latitude
                    );

                const lng =
                    parseFloat(
                        this.longitude
                    );

                if (
                    this.marker
                ) {

                    this.map.removeLayer(
                        this.marker
                    );
                }

                this.marker =
                    L.marker([
                        lat,
                        lng
                    ]).addTo(
                        this.map
                    );

                this.map.setView(
                    [
                        lat,
                        lng
                    ],
                    17
                );
            }
        };
    }
</script>

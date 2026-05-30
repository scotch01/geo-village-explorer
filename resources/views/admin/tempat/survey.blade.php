@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Pendataan
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                {{ $tempat->nama_tempat }}
            </p>

        </div>

        {{-- INFO TEMPAT --}}

        <div class="bg-white border rounded-2xl p-6">

            <div class="grid md:grid-cols-3 gap-6">

                <div>

                    <div class="text-xs text-gray-500">
                        Jenis Bangunan
                    </div>

                    <div class="font-semibold mt-1">
                        {{ \App\Constants\Tempat\JenisBangunan::OPTIONS[$tempat->jenis_bangunan] ?? '-' }}
                    </div>

                </div>

                <div>

                    <div class="text-xs text-gray-500">
                        Koordinat
                    </div>

                    <div class="font-semibold mt-1">
                        @if ($tempat->latitude && $tempat->longitude)
                            {{ $tempat->latitude }},
                            {{ $tempat->longitude }}
                        @else
                            <span class="text-amber-600 font-medium">
                                Belum geotagging
                            </span>
                        @endif
                    </div>

                </div>

                <div>

                    <div class="text-xs text-gray-500">
                        Status
                    </div>

                    <div class="font-semibold mt-1">
                        {{ ucfirst($tempat->status_pendataan) }}
                    </div>

                </div>

            </div>

        </div>

        {{-- MENU SURVEY --}}

        <div class="grid md:grid-cols-2 gap-4">

            @if (in_array($tempat->jenis_bangunan, ['btt', 'bc']))
                <div class="bg-white border rounded-2xl p-6">

                    <div class="flex items-start justify-between">

                        <div>

                            <h3 class="font-semibold text-lg">
                                Data Keluarga
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Informasi keluarga dan kondisi perumahan
                            </p>

                        </div>

                        @if ($tempat->keluarga_completed)
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                                Selesai

                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">

                                Belum

                            </span>
                        @endif

                    </div>

                    @if (!$tempat->keluarga)
                        <a href="{{ route('admin.keluarga.create', $tempat) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">

                            Isi Data Keluarga

                        </a>
                    @else
                        <a href="{{ route('admin.keluarga.edit', $tempat->keluarga) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-amber-500 text-white text-sm">

                            Edit Data Keluarga

                        </a>
                    @endif

                </div>

                @if (in_array($tempat->jenis_bangunan, ['btt', 'bc']))
                    <div class="bg-white border rounded-2xl p-6">

                        <div class="flex items-start justify-between">

                            <div>

                                <h3 class="font-semibold text-lg">
                                    Anggota Keluarga
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Data individu setiap anggota keluarga
                                </p>

                            </div>

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">

                                {{ $tempat->anggotaKeluargas->count() }}
                                Orang

                            </span>

                        </div>

                        <button type="button" disabled
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-gray-300 text-gray-600 text-sm cursor-not-allowed">

                            Menunggu Modul Anggota

                        </button>

                    </div>
                @endif
            @endif

            @if (in_array($tempat->jenis_bangunan, ['bku', 'bc']))
                <div class="bg-white border rounded-2xl p-6">

                    <h3 class="font-semibold">
                        Data Usaha
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Informasi usaha dan ekonomi
                    </p>

                    @if ($tempat->usaha_completed)
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            Selesai

                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">

                            Belum

                        </span>
                    @endif

                    <a href="{{ route('admin.usaha.create', $tempat) }}"
                        class="inline-flex mt-4 px-4 py-2 rounded-xl bg-green-600 text-white text-sm">
                        Isi Data Usaha
                    </a>

                </div>
            @endif

        </div>

    </div>
@endsection

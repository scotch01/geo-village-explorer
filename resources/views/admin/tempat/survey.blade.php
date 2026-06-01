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

                    <div class="mt-2">

                        <span
                            class="px-3 py-1 rounded-full
               bg-indigo-100
               text-indigo-700
               text-sm font-medium">

                            {{ \App\Constants\Tempat\JenisBangunan::OPTIONS[$tempat->jenis_bangunan] ?? '-' }}

                        </span>

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

                    <div class="mt-2">

                        @if ($tempat->status_pendataan === 'selesai')
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">

                                ✓ Selesai

                            </span>
                        @elseif ($tempat->status_pendataan === 'parsial')
                            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-sm font-medium">

                                ◐ Parsial

                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm font-medium">

                                ○ Belum

                            </span>
                        @endif

                    </div>

                </div>

            </div>

        </div>

        @php

            $total = 0;
            $done = 0;

            if (in_array($tempat->jenis_bangunan, ['btt', 'bc'])) {
                $total += 2;

                if ($tempat->keluarga_completed) {
                    $done++;
                }

                if ($tempat->anggota_completed) {
                    $done++;
                }
            }

            if (in_array($tempat->jenis_bangunan, ['bku', 'bc'])) {
                $total += 1;

                if ($tempat->usaha_completed) {
                    $done++;
                }
            }

            $percent = $total > 0 ? round(($done / $total) * 100) : 0;

        @endphp

        <div class="bg-white border rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Progress Pendataan
                    </p>

                    <h2 class="text-2xl font-bold mt-1">
                        {{ $percent }}%
                    </h2>

                </div>

                <div class="text-right">

                    <div class="text-sm text-gray-500">

                        {{ $done }}/{{ $total }}
                        Modul Selesai

                    </div>

                </div>

            </div>

            <div class="mt-4 h-3 bg-gray-100 rounded-full">

                <div class="h-3 bg-green-500 rounded-full transition-all" style="width: {{ $percent }}%">
                </div>

            </div>

        </div>

        {{-- MENU SURVEY --}}

        <div class="grid md:grid-cols-2 gap-4">

            @if (in_array($tempat->jenis_bangunan, ['btt', 'bc']))
                <div class="bg-white border rounded-2xl p-6 hover:shadow-md transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <h3 class="font-semibold text-lg">
                                BLOK II
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                KETERANGAN UMUM KELUARGA DAN PERUMAHAN
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
                        <a href="{{ route('admin.keluarga.edit', $tempat) }}"
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
                                    BLOK II
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    KETERANGAN ANGGOTA KELUARGA
                                </p>

                            </div>

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">

                                {{ $tempat->anggotaKeluargas->count() }}
                                Anggota

                            </span>

                        </div>

                        @if ($tempat->keluarga)
                            <div class="flex gap-2 mt-4">

                                <a href="{{ route('admin.anggota.create', $tempat->keluarga) }}"
                                    class="inline-flex px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">

                                    Tambah Anggota

                                </a>

                                <a href="{{ route('admin.anggota.index', $tempat->keluarga) }}"
                                    class="inline-flex px-4 py-2 rounded-xl bg-slate-600 text-white text-sm">

                                    Kelola Anggota

                                </a>

                            </div>
                        @else
                            <button type="button" disabled
                                class="inline-flex mt-4 px-4 py-2 rounded-xl bg-gray-300 text-gray-600 text-sm cursor-not-allowed">

                                Isi Data Keluarga Dulu

                            </button>
                        @endif

                    </div>
                @endif
            @endif

            @if (in_array($tempat->jenis_bangunan, ['bku', 'bc']))
                <div class="bg-white border rounded-2xl p-6">

                    <h3 class="font-semibold">
                        BLOK III
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        KETERANGAN USAHA/PERUSAHAAN
                    </p>

                    @if ($tempat->usahaCompleted)
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                            Selesai

                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">

                            Belum

                        </span>
                    @endif

                    @if ($tempat->usahaCompleted)
                        <a href="{{ route('admin.usaha.edit', $tempat) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-amber-500 text-white text-sm">

                            Edit Data Usaha

                        </a>
                    @else
                        <a href="{{ route('admin.usaha.create', $tempat) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-green-600 text-white text-sm">

                            Isi Data Usaha

                        </a>
                    @endif

                </div>
            @endif

            {{-- BLOK IV FOTO BANGUNAN --}}

            <div class="bg-white border rounded-2xl p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="font-semibold text-lg">
                            BLOK IV
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            FOTO BANGUNAN
                        </p>

                    </div>

                    @if ($tempat->foto_bangunan)
                        <span
                            class="px-3 py-1 rounded-full
                       bg-green-100
                       text-green-700
                       text-xs font-semibold">

                            Tersedia

                        </span>
                    @else
                        <span
                            class="px-3 py-1 rounded-full
                       bg-gray-100
                       text-gray-600
                       text-xs font-semibold">

                            Belum Ada

                        </span>
                    @endif

                </div>

                <form action="{{ route('admin.tempat.updateSurvey', $tempat) }}" method="POST"
                    enctype="multipart/form-data" class="mt-4">

                    @csrf
                    @method('PUT')

                    <input type="file" name="foto_bangunan" accept="image/*" class="block w-full">

                    @if ($tempat->foto_bangunan)
                        <img src="{{ Storage::url($tempat->foto_bangunan) }}" class="mt-4 rounded-xl border max-h-72">
                    @endif

                    <button class="mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white">

                        Simpan Foto

                    </button>

                </form>

            </div>

            {{-- BLOK V CATATAN --}}

            <div class="bg-white border rounded-2xl p-6">

                <h3 class="font-semibold text-lg">
                    BLOK V
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    CATATAN
                </p>

                <form action="{{ route('admin.tempat.updateSurvey', $tempat) }}" method="POST" class="mt-4">

                    @csrf
                    @method('PUT')

                    <textarea name="catatan" rows="5" class="w-full rounded-xl border-gray-300">{{ old('catatan', $tempat->catatan) }}</textarea>

                    <button class="mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white">

                        Simpan Catatan

                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection

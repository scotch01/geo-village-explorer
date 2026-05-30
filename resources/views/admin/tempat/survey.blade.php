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
                    {{ strtoupper($tempat->jenis_bangunan) }}
                </div>

            </div>

            <div>

                <div class="text-xs text-gray-500">
                    Koordinat
                </div>

                <div class="font-semibold mt-1">
                    {{ $tempat->latitude }},
                    {{ $tempat->longitude }}
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

        @if(
            in_array(
                $tempat->jenis_bangunan,
                ['btt', 'bc']
            )
        )

        <div class="bg-white border rounded-2xl p-6">

            <h3 class="font-semibold">
                Data Keluarga
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Informasi keluarga dan perumahan
            </p>

            <a
                href="{{ route('admin.keluarga.create', $tempat) }}"
                class="inline-flex mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white text-sm"
            >
                Isi Data Keluarga
            </a>

        </div>

        @endif

        @if(
            in_array(
                $tempat->jenis_bangunan,
                ['bku', 'bc']
            )
        )

        <div class="bg-white border rounded-2xl p-6">

            <h3 class="font-semibold">
                Data Usaha
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Informasi usaha dan ekonomi
            </p>

            <a
                href="{{ route('admin.usaha.create', $tempat) }}"
                class="inline-flex mt-4 px-4 py-2 rounded-xl bg-green-600 text-white text-sm"
            >
                Isi Data Usaha
            </a>

        </div>

        @endif

    </div>

</div>

@endsection
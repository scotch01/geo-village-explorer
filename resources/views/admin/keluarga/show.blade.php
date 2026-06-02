@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">



        <div class="bg-white border rounded-2xl p-6">

            <h1 class="text-2xl font-bold">
                Detail Data Keluarga
            </h1>

            <p class="text-gray-500 mt-1">
                {{ $tempat->display_name ?? $tempat->nama_tempat }}
            </p>

        </div>

        <div class="bg-white border rounded-2xl p-6">

            <h2 class="font-bold text-lg mb-5">
                Keterangan Umum Keluarga
            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <div class="text-sm text-gray-500">
                        2a. Nama Kepala Keluarga
                    </div>

                    <div class="font-medium">
                        {{ $keluarga->nama_kepala_keluarga ?: '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        2b. NIK Kepala Keluarga
                    </div>

                    <div class="font-medium">
                        {{ $keluarga->nik_kepala_keluarga ?: '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        2c. Nomor Kartu Keluarga (KK) dari Kepala Keluarga
                    </div>

                    <div class="font-medium">
                        {{ $keluarga->nomor_kk ?: '-' }}
                    </div>
                </div>

            </div>

        </div>

        <div class="bg-white border rounded-2xl p-6">

            <h2 class="font-bold text-lg mb-5">
                3. Alamat
            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <div class="text-sm text-gray-500">a. Provinsi</div>
                    <div>{{ $keluarga->provinsi ?: '-' }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">b. Kabupaten</div>
                    <div>{{ $keluarga->kabupaten ?: '-' }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">c. Kecamatan</div>
                    <div>{{ $keluarga->kecamatan ?: '-' }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">d. Desa</div>
                    <div>{{ $keluarga->desa ?: '-' }}</div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">e. Dusun</div>
                    <div>{{ $keluarga->dusun ?: '-' }}</div>
                </div>

                <div class="md:col-span-2">
                    <div class="text-sm text-gray-500">
                        f. Alamat Detail
                    </div>

                    <div>
                        {{ $keluarga->alamat_detail ?: '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        4. Apakah alamat tersebut sesuai dengan alamat pada Kartu Keluarga (KK)?
                    </div>

                    <div class="font-medium">
                        {{ $yaTidak[$keluarga->alamat_sesuai_kk] ?? '-' }}
                    </div>
                </div>

            </div>

        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">

            <div class="flex items-start justify-between">

                <div class="flex items-center gap-3 mb-5">

                    <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>

                    <div>
                        <h2 class="font-bold text-blue-900">
                            ANGGOTA KELUARGA
                        </h2>

                        <p class="text-sm text-blue-700 mt-1">
                            Modul anggota keluarga.
                        </p>
                    </div>

                </div>

                <span
                    class="px-3 py-1 rounded-full
                   bg-blue-100
                   text-blue-700
                   text-xs font-semibold">

                    {{ $keluarga->anggotaKeluargas()->count() }}
                    Anggota

                </span>

            </div>

            <div class="flex gap-2 mt-4">

                <a href="{{ route('admin.anggota.index', $keluarga) }}"
                    class="px-4 py-2 rounded-xl bg-slate-600 text-white">

                    Kelola Anggota

                </a>

            </div>

        </div>

        <div class="bg-white border rounded-2xl p-6">

            <h2 class="font-bold text-lg mb-5">
                Keterangan Perumahan
            </h2>

            <div class="space-y-4">

                <div>
                    <div class="text-sm text-gray-500">
                        20. Berapa jumlah keluarga yang tinggal dalam 1 rumah/tempat tinggal?
                    </div>

                    <div>
                        {{ $keluarga->jumlah_keluarga_dalam_rumah ?: '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        21. Apa status kepemilikan bangunan tempat tinggal yang ditempati?
                    </div>

                    <div>
                        {{ $keluarga->status_kepemilikan_rumah ?: '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        22. Berapa luas lantai bangunan tempat tinggal yang ditempati? (m2)
                    </div>

                    <div>
                        {{ $keluarga->luas_lantai ?: '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        23. Apa bahan bangunan utama lantai rumah terluas?
                    </div>

                    <div>
                        {{ $bahanLantai[$keluarga->bahan_lantai] ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        24. Apa bahan bangunan utama dinding rumah terluas?
                    </div>

                    <div>
                        {{ $bahanDinding[$keluarga->bahan_dinding] ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        25. Apa bahan bangunan utama atap rumah terluas?
                    </div>

                    <div>
                        {{ $bahanAtap[$keluarga->bahan_atap] ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        26. Apakah memiliki fasilitas tempat buang air besar dan siapa saja yang menggunakan?
                    </div>

                    <div>
                        {{ $fasilitasBab[$keluarga->fasilitas_bab] ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        27. Apa jenis kloset yang digunakan?
                    </div>

                    <div>
                        {{ $jenisKloset[$keluarga->jenis_kloset] ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        28. Di manakah tempat pembuangan akhir tinja?
                    </div>

                    <div>
                        {{ $pembuanganTinja[$keluarga->pembuangan_tinja] ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        29. Apa sumber air utama yang digunakan keluarga untuk minum?
                    </div>

                    <div>
                        {{ $sumberAirMinum[$keluarga->sumber_air_minum] ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        30. Apa sumber penerangan utama rumah ini?
                    </div>

                    <div>
                        {{ $sumberPenerangan[$keluarga->sumber_penerangan] ?? '-' }}
                    </div>
                </div>

                @if ($keluarga->meterans->count())
                    <h2 class="text-lg mb-5">

                        31a. Jika listrik PLN dengan meteran, berapa jumlah meteran listrik yang terpasang di
                        rumah ini?

                    </h2>

                    <label class="block text-sm font-medium mb-2">

                        31b. Berapa daya listrik yang terpasang di rumah ini?

                    </label>

                    <div class="grid md:grid-cols-3 gap-4">

                        @foreach ($keluarga->meterans as $meteran)
                            <div class="border rounded-xl p-4">

                                <div class="text-sm text-gray-500">

                                    Meteran {{ $loop->iteration }}

                                </div>

                                <div class="font-semibold">

                                    {{ $dayaListrik[$meteran->daya_listrik] ?? '-' }}

                                </div>

                            </div>
                        @endforeach

                    </div>
                @endif

                <div>
                    <div class="text-sm text-gray-500">
                        32. Apakah ada minimal salah satu anggota keluarga ini yang menerima kredit dari lembaga keuangan
                        berikut dalam setahun terakhir?
                    </div>

                    <div>
                        @php
                            $sumber = collect($keluarga->kredit_sumber ?? [])
                                ->map(fn($item) => $kreditSumber[$item] ?? $item)
                                ->implode(', ');
                        @endphp

                        {{ $sumber ?: '-' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500">
                        33. Apakah dalam setahun terakhir keluarga ini pernah menerima kredit dari lembaga keuangan?
                    </div>

                    <div>
                        @php
                            $tujuan = collect($keluarga->kredit_tujuan ?? [])
                                ->map(fn($item) => $kreditTujuan[$item] ?? $item)
                                ->implode(', ');
                        @endphp

                        {{ $tujuan ?: '-' }}
                    </div>
                </div>


            </div>

        </div>



        <div class="flex justify-end gap-3">

            @if (auth()->user()->isMasterAdmin())
                <form method="POST" action="{{ route('admin.keluarga.destroy', $tempat) }}">

                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Hapus data keluarga?')"
                        class="px-5 py-3 rounded-xl bg-red-600 text-white">

                        Hapus

                    </button>

                </form>
            @endif

            <a href="{{ route('admin.keluarga.edit', $tempat) }}" class="px-5 py-3 rounded-xl bg-amber-500 text-white">

                Edit Data

            </a>

        </div>

    </div>

@endsection

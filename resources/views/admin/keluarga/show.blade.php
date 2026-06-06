@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl bg mx-auto space-y-8 animate-fade-in px-2 sm:px-0">

        <x-back-button :href="route('admin.tempat.survey', $tempat)">
            Kembali
        </x-back-button>

        <!-- HEADER HALAMAN -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="text-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Detail Data BLOK II
            </h1>
            <h3 class="text-sm lg:text-base font-medium text-slate-700 tracking-tight">
                Keterangan Umum Keluarga, Anggota Keluarga dan Perumahan
            </h3>
        </div>

        <!-- Flash Message -->
        <x-alert />

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

            <div class="flex items-center gap-4">
                <div class="w-2 h-8 rounded-full bg-fuchsia-600"></div>
                <div>
                    <h2 class="font-black text-xl text-slate-900 tracking-tight">
                        BLOK II
                    </h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                        KETERANGAN UMUM KELUARGA
                    </p>
                </div>
            </div>
        </div>

        <!-- BLOK II: KETERANGAN UMUM KELUARGA -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    I. Identitas Kepala Keluarga
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">2a. Nama Kepala Keluarga</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $keluarga->nama_kepala_keluarga ?: '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">2b. NIK Kepala Keluarga</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base tracking-medium">
                        {{ $keluarga->nik_kepala_keluarga ?: '-' }}</p>
                </div>

                <div class="space-y-1 md:col-span-2 lg:col-span-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">2c. Nomor Kartu Keluarga (KK)</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base tracking-medium">
                        {{ $keluarga->nomor_kk ?: '-' }}</p>
                </div>
            </div>
        </div>

        <!-- BLOK ALAMAT WILAYAH -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    II. Alamat & Wilayah
            </div>

            <div class="space-y-2 mb-4">
                <label class="block text-sm lg:text-base font-bold text-slate-800 tracking-tight">
                    3. Alamat Detail
                </label>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">a. Provinsi</span>
                    <p class="font-semibold text-slate-800 text-sm">{{ $keluarga->provinsi ?: '-' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">b. Kabupaten</span>
                    <p class="font-semibold text-slate-800 text-sm">{{ $keluarga->kabupaten ?: '-' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">c. Kecamatan</span>
                    <p class="font-semibold text-slate-800 text-sm">{{ $keluarga->kecamatan ?: '-' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">d. Desa</span>
                    <p class="font-semibold text-slate-800 text-sm">{{ $keluarga->desa ?: '-' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">e. Dusun</span>
                    <p class="font-semibold text-slate-800 text-sm">{{ $keluarga->dusun ?: '-' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">f. Alamat Detail (Jalan/Nomor
                        Rumah)</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base leading-relaxed">
                        {{ $keluarga->alamat_detail ?: '-' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-100 pt-5">


                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500  tracking-wider">4. Apakah alamat tersebut sesuai dengan
                        alamat pada Kartu Keluarga (KK)?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $yaTidak[$keluarga->alamat_sesuai_kk] ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- QUICK ACCESS: MODUL ANGGOTA KELUARGA -->
        <div
            class="bg-blue-50/60 border border-blue-100 rounded-3xl p-6 lg:p-8 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-2 h-10 rounded-full bg-fuchsia-600 shrink-0 mt-0.5"></div>
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="font-extrabold text-blue-900 text-base lg:text-lg tracking-tight">
                            ANGGOTA KELUARGA
                        </h2>
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-bold tracking-wide">
                            {{ $keluarga->anggotaKeluargas()->count() }} Orang
                        </span>
                    </div>
                    <p class="text-sm font-medium text-blue-700/90 mt-0.5">
                        Manajemen rincian karakteristik dan instrumen individu untuk setiap anggota keluarga terdaftar.
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.anggota.index', $keluarga) }}"
                class="shrink-0 px-6 py-3.5 bg-slate-600 hover:bg-slate-700 text-white rounded-2xl font-bold text-center transition-all active:scale-95 shadow-sm shadow-blue-600/10 text-sm lg:text-base">
                Edit atau Kelola
            </a>
        </div>

        <hr class="border-t-2 rounded border-slate-300">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

            <div class="flex items-center gap-4">
                <div class="w-2 h-8 rounded-full bg-fuchsia-600"></div>
                <div>
                    <h2 class="font-black text-xl text-slate-900 tracking-tight">
                        BLOK II
                    </h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                        KETERANGAN PERUMAHAN
                    </p>
                </div>
            </div>
        </div>

        <!-- BLOK III: KETERANGAN PERUMAHAN -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 space-y-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    III. Karakteristik Perumahan
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">20. Berapa jumlah
                        keluarga yang tinggal dalam 1 rumah/tempat tinggal?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $keluarga->jumlah_keluarga_dalam_rumah ?: '-' }} Keluarga</p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">21. Apa status
                        kepemilikan bangunan tempat tinggal yang ditempati?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $statusKepemilikanRumah[$keluarga->status_kepemilikan_rumah] ?? '-' }}</p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">22. Berapa luas
                        lantai bangunan tempat tinggal yang ditempati?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $keluarga->luas_lantai ? $keluarga->luas_lantai . ' m²' : '-' }}</p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">23. Apa bahan
                        bangunan utama lantai rumah terluas?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $bahanLantai[$keluarga->bahan_lantai] ?? '-' }}</p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">24. Apa bahan
                        bangunan utama dinding rumah terluas?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $bahanDinding[$keluarga->bahan_dinding] ?? '-' }}</p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">25. Apa bahan
                        bangunan utama atap rumah terluas?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $bahanAtap[$keluarga->bahan_atap] ?? '-' }}</p>
                </div>

            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 space-y-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    IV. Sanitasi & Utilitas
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="space-y-1.5 md:col-span-2 lg:col-span-3 border-slate-50">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">26. Apakah memiliki
                        fasilitas tempat buang air besar dan siapa saja yang menggunakan?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base mt-0.5">
                        {{ $fasilitasBab[$keluarga->fasilitas_bab] ?? '-' }}</p>
                </div>

                <div class="space-y-1.5 border-t border-slate-50 pt-0 lg:pt-4">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">27. Apa jenis kloset
                        yang digunakan?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $jenisKloset[$keluarga->jenis_kloset] ?? '-' }}</p>
                </div>

                <div class="space-y-1.5 border-t border-slate-50 pt-0 lg:pt-4">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">28. Dimanakah tempat
                        pembuangan akhir tinja?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $pembuanganTinja[$keluarga->pembuangan_tinja] ?? '-' }}</p>
                </div>

                <div class="space-y-1.5 border-t border-slate-50 pt-0 lg:pt-4">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">29. Apa sumber air
                        utama yang digunakan keluarga untuk minum?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $sumberAirMinum[$keluarga->sumber_air_minum] ?? '-' }}</p>
                </div>

                <div class="space-y-1.5 md:col-span-2 lg:col-span-3 border-t border-slate-50 pt-4">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">30. Apa sumber
                        penerangan utama rumah ini?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base mt-0.5">
                        {{ $sumberPenerangan[$keluarga->sumber_penerangan] ?? '-' }}</p>
                </div>
            </div>

            <!-- KOMPONEN DETIL KELISTRIKAN METERAN (IF EXIST) -->
            @if ($keluarga->meterans->count())
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 lg:p-6 space-y-4 mt-4">
                    <div>
                        <span class="text-sm font-bold text-slate-500  tracking-wider">31a. Jika listrik PLN dengan
                            meteran,
                            berapa jumlah meteran listrik yang terpasang di rumah ini?</span>
                        <p class="text-sm font-bold text-slate-800 my-2">Ditemukan {{ $keluarga->meterans->count() }} unit
                            meteran listrik PLN terpasang aktif:</p>
                        <p class="text-sm font-bold text-slate-500  tracking-wider">
                            31b. Berapa daya distrik yang terpasang?
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($keluarga->meterans as $meteran)
                            <div
                                class="bg-white border border-slate-200/80 shadow-sm rounded-xl p-4 flex flex-col justify-center">
                                <span class="text-sm font-bold text-slate-500  tracking-widest">Meteran
                                    #{{ $loop->iteration }}</span>
                                <p class="text-sm font-extrabold text-slate-800 mt-1">
                                    {{ $dayaListrik[$meteran->daya_listrik] ?? '-' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 space-y-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    V. Perkreditan Rumah Tangga
            </div>

            <!-- SEKSI FINANSIAL / KREDIT -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-slate-100">
                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">32. Apakah ada
                        minimal salah satu anggota keluarga ini yang menerima kredit dari lembaga keuangan berikut dalam
                        setahun terakhir?</span>
                    @php
                        $sumber = collect($keluarga->kredit_sumber ?? [])
                            ->map(fn($item) => $kreditSumber[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800 text-sm lg:text-base leading-relaxed">{{ $sumber ?: '-' }}</p>
                </div>

                <div class="space-y-1.5">
                    <span class="text-sm font-bold text-slate-500  tracking-wider block leading-tight">33. Apakah dalam
                        setahun terakhir keluarga ini pernah menerima kredit dari lembaga keuangan dan untuk apa?</span>
                    @php
                        $tujuan = collect($keluarga->kredit_tujuan ?? [])
                            ->map(fn($item) => $kreditTujuan[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800 text-sm lg:text-base leading-relaxed">{{ $tujuan ?: '-' }}</p>
                </div>
            </div>
        </div>

        <!-- BOTTOM ACTIONS BAR -->

        <div class="grid grid-cols-2 gap-10 bg-white justify-end rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">

            <div class="flex items-center gap-4">
                <p class="text-xl font-bold">Lakukan Perubahan?</p>
            </div>

            <div class="flex items-center justify-end gap-4">
                @if (auth()->user()->isMasterAdmin())
                    <form method="POST" action="{{ route('admin.keluarga.destroy', $tempat) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus permanen data keluarga ini?')"
                            class="px-6 py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-rose-600/10">
                            Hapus Data
                        </button>
                    </form>
                @endif

                <a href="{{ route('admin.keluarga.edit', $tempat) }}"
                    class="px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-amber-500/10 text-center">
                    Edit Data
                </a>
            </div>

        </div>

    </div>
@endsection

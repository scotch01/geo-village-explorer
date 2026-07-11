@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-10 animate-fade-in px-2 sm:px-0">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="text-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Tambah Data BLOK II
            </h1>
            <p class="text-sm lg:text-base font-medium text-slate-700 mt-1">Silakan lengkapi kuisioner keluarga dan perumahan
                di bawah ini secara teliti.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                <div class="font-semibold text-red-700 mb-2">
                    Terdapat data wajib yang belum lengkap:
                </div>

                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>

            </div>
        @endif

        <div x-data="keluargaForm()">

            <form method="POST" x-ref="keluargaForm" action="{{ route('admin.keluarga.store', $tempat) }}"
                class="space-y-10">

                @csrf

                <input type="hidden" name="redirect_to" x-model="redirectTo">

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4">
                        <div class="w-2 h-8 rounded-full bg-blue-600"></div>
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

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>
                        <h2 class="font-black text-lg text-slate-900 tracking-tight">
                            I. Identitas Kepala Keluarga
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                2a. Nama Kepala Keluarga
                            </label>
                            <input type="text" name="nama_kepala_keluarga" value="{{ old('nama_kepala_keluarga') }}"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 transition-all focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm lg:text-base">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                2b. NIK Kepala Keluarga
                            </label>
                            <input type="text" name="nik_kepala_keluarga" value="{{ old('nik_kepala_keluarga') }}"
                                maxlength="16"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 transition-all focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm lg:text-base tracking-wider">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                2c. Nomor Kartu Keluarga (KK) dari Kepala Keluarga
                            </label>
                            <input type="text" name="nomor_kk" value="{{ old('nomor_kk') }}" maxlength="16"
                                class="w-full md:w-1/2 rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 transition-all focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm lg:text-base tracking-wider">
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>
                        <h2 class="font-black text-lg text-slate-900 tracking-tight">
                            II. Alamat & Wilayah
                    </div>

                    <div class="space-y-2 mb-4">
                        <label class="block text-sm lg:text-base font-bold text-slate-800 tracking-tight">
                            3. Alamat Detail
                        </label>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                a. Provinsi
                            </label>
                            <input type="text" name="provinsi" value="{{ old('provinsi', $desa?->provinsi) }}"
                                class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500 text-sm lg:text-base">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                b. Kabupaten/Kota
                            </label>
                            <input type="text" name="kabupaten" value="{{ old('kabupaten', $desa?->kabupaten) }}"
                                class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500 text-sm lg:text-base">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                c. Kecamatan
                            </label>
                            <input type="text" name="kecamatan" value="{{ old('kecamatan', $desa?->kecamatan) }}"
                                class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500 text-sm lg:text-base">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                d. Desa/Kelurahan
                            </label>
                            <input type="text" name="desa" value="{{ old('desa', $desa?->nama_desa) }}"
                                class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500 text-sm lg:text-base">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                e. Dusun
                            </label>
                            <select name="dusun"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800">

                                <option value="">
                                    Pilih Dusun
                                </option>

                                @foreach ($dusuns as $dusun)
                                    <option value="{{ $dusun }}" @selected(old('dusun') == $dusun)>
                                        {{ $dusun }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                f. Alamat Detail (Jalan/Nomor Rumah)
                            </label>
                            <textarea name="alamat_detail" rows="3"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-4 font-semibold text-slate-800 transition-all focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm lg:text-base">{{ old('alamat_detail') }}</textarea>
                        </div>

                        <div class="md:col-span-2 border-t border-slate-100 pt-5 mt-2 space-y-3">
                            <label class="block text-sm lg:text-base font-bold text-slate-800 tracking-tight">
                                4. Apakah alamat tersebut sesuai dengan alamat pada Kartu Keluarga (KK)?
                            </label>

                            <div class="flex flex-wrap gap-6 items-center">
                                @foreach ($yaTidak as $key => $label)
                                    <label class="inline-flex items-center gap-3 cursor-pointer group">
                                        <input type="radio" name="alamat_sesuai_kk" value="{{ $key }}"
                                            @checked(old('alamat_sesuai_kk', $keluarga->alamat_sesuai_kk ?? null) == $key)
                                            class="w-5 h-5 text-blue-600 border-slate-300 focus:ring-blue-500 focus:ring-opacity-50 cursor-pointer">
                                        <span
                                            class="text-sm lg:text-base font-semibold text-slate-600 group-hover:text-slate-900 transition-colors">
                                            {{ $label }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div
                    class="bg-blue-50/60 border border-blue-100 rounded-3xl p-6 lg:p-8 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 transition-all">

                    <div class="flex items-start gap-4">
                        <div class="w-2 h-10 rounded-full bg-blue-600 shrink-0 mt-0.5"></div>
                        <div>
                            <h2 class="font-extrabold text-blue-900 text-base lg:text-lg tracking-tight">
                                BLOK II KETERANGAN ANGGOTA KELUARGA
                            </h2>
                            <p class="text-sm font-medium text-blue-700/90 mt-0.5">
                                Pertanyaan nomor 5–18 diisi secara detail melalui modul entri anggota keluarga setelah baris
                                data
                                ini tersimpan.
                            </p>
                        </div>
                    </div>

                    <button type="button" @click="showAnggotaModal = true"
                        class="shrink-0 px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold transition-all active:scale-95 shadow-sm shadow-blue-600/10 text-sm lg:text-base text-center">
                        Simpan & Tambah Anggota
                    </button>
                </div>

                <hr class="border-t-2 rounded border-slate-300">

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4">
                        <div class="w-2 h-8 rounded-full bg-blue-600"></div>
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

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>
                        <h2 class="font-black text-lg text-slate-900 tracking-tight">
                            III. Karakteristik Perumahan
                    </div>

                    <div class="space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-slate-50 pb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                    20. Berapa jumlah keluarga yang tinggal dalam 1 rumah/tempat tinggal?
                                </label>
                                <div class="relative max-w-xs">
                                    <input type="number" min="1" name="jumlah_keluarga_dalam_rumah"
                                        value="{{ old('jumlah_keluarga_dalam_rumah', $keluarga->jumlah_keluarga_dalam_rumah ?? '') }}"
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 transition-all focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm lg:text-base">
                                    <span
                                        class="absolute right-4 top-3.5 text-slate-400 text-sm font-semibold mr-5">Keluarga</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                    21. Apa status kepemilikan bangunan tempat tinggal yang ditempati?
                                </label>
                                <select name="status_kepemilikan_rumah"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                    <option value="" class="text-slate-400 font-medium">-- Pilih Status Kepemilikan
                                        --
                                    </option>
                                    @foreach ($statusKepemilikanRumah as $key => $label)
                                        <option value="{{ $key }}" @selected(old('status_kepemilikan_rumah', $keluarga->status_kepemilikan_rumah ?? null) == $key)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-slate-50 pb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                    22. Berapa luas lantai bangunan tempat tinggal yang ditempati?
                                </label>
                                <div class="relative max-w-xs">
                                    <input type="number" min="1" name="luas_lantai"
                                        value="{{ old('luas_lantai', $keluarga->luas_lantai ?? '') }}"
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 transition-all focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm lg:text-base">
                                    <span
                                        class="absolute right-4 top-3.5 text-slate-400 text-sm font-semibold mr-5">m²</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                    23. Apa bahan bangunan utama lantai rumah terluas?
                                </label>
                                <select name="bahan_lantai"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                    <option value="">-- Pilih Jenis Bahan Lantai --</option>
                                    @foreach ($bahanLantai as $key => $label)
                                        <option value="{{ $key }}" @selected(old('bahan_lantai', $keluarga->bahan_lantai ?? null) == $key)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-2">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                    24. Apa bahan bangunan utama dinding rumah terluas?
                                </label>
                                <select name="bahan_dinding"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                    <option value="">-- Pilih Jenis Bahan Dinding --</option>
                                    @foreach ($bahanDinding as $key => $label)
                                        <option value="{{ $key }}" @selected(old('bahan_dinding', $keluarga->bahan_dinding ?? null) == $key)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                    25. Apa bahan bangunan utama atap rumah terluas?
                                </label>
                                <select name="bahan_atap"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                    <option value="">-- Pilih Jenis Bahan Atap --</option>
                                    @foreach ($bahanAtap as $key => $label)
                                        <option value="{{ $key }}" @selected(old('bahan_atap', $keluarga->bahan_atap ?? null) == $key)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>
                        <h2 class="font-black text-lg text-slate-900 tracking-tight">
                            IV. Sanitasi & Utilitas
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-2 md:col-span-2 border-b border-slate-50 pb-4">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                26. Apakah memiliki fasilitas tempat buang air besar dan siapa saja yang menggunakan?
                            </label>
                            <select name="fasilitas_bab" x-model="fasilitasBab"
                                class="w-full md:w-2/3 rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                <option value="">-- Pilih Jenis Fasilitas BAB --</option>
                                @foreach ($fasilitasBab as $key => $label)
                                    <option value="{{ $key }}" @selected(old('fasilitas_bab', $keluarga->fasilitas_bab ?? null) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                27. Apa jenis kloset yang digunakan?
                            </label>
                            <select name="jenis_kloset" x-ref="jenisKloset" :disabled="fasilitasBab == 6"
                                :class="{
                                    'bg-slate-100 text-slate-400 cursor-not-allowed border-slate-200/60': fasilitasBab ==
                                        6
                                }"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                <option value="">-- Pilih Jenis Kloset --</option>
                                @foreach ($jenisKloset as $key => $label)
                                    <option value="{{ $key }}" @selected(old('jenis_kloset', $keluarga->jenis_kloset ?? null) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                28. Dimanakah tempat pembuangan akhir tinja?
                            </label>
                            <select name="pembuangan_tinja" x-ref="pembuanganTinja" :disabled="fasilitasBab == 6"
                                :class="{
                                    'bg-slate-100 text-slate-400 cursor-not-allowed border-slate-200/60': fasilitasBab ==
                                        6
                                }"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                <option value="">-- Pilih Tempat Pembuangan Akhir --</option>
                                @foreach ($pembuanganTinja as $key => $label)
                                    <option value="{{ $key }}" @selected(old('pembuangan_tinja', $keluarga->pembuangan_tinja ?? null) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2 pt-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                29. Apa sumber air utama yang digunakan keluarga untuk minum?
                            </label>
                            <select name="sumber_air_minum"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                <option value="">-- Pilih Sumber Air Minum --</option>
                                @foreach ($sumberAirMinum as $key => $label)
                                    <option value="{{ $key }}" @selected(old('sumber_air_minum', $keluarga->sumber_air_minum ?? null) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2 pt-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-tight">
                                30. Apa sumber penerangan utama rumah ini?
                            </label>
                            <select name="sumber_penerangan" x-model="sumberPenerangan"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 transition-all focus:border-blue-500 text-sm lg:text-base cursor-pointer">
                                <option value="">-- Pilih Sumber Penerangan --</option>
                                @foreach ($sumberPenerangan as $key => $label)
                                    <option value="{{ $key }}" @selected(old('sumber_penerangan', $keluarga->sumber_penerangan ?? null) == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div x-show="sumberPenerangan == '1'" x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            class="md:col-span-2 bg-slate-50 border border-slate-200 rounded-2xl p-5 lg:p-6 space-y-6 mt-2">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div>
                                    <h3 class="font-bold text-slate-800 text-sm lg:text-base tracking-tight">
                                        31a. Jika listrik PLN dengan meteran, berapa jumlah meteran listrik yang terpasang
                                        di rumah
                                        ini?
                                    </h3>
                                    <p class="text-xs font-semibold text-slate-500 mt-0.5">
                                        Tambahkan seluruh instrumen meteran listrik yang terpasang aktif pada rumah ini
                                    </p>
                                </div>

                                <button type="button" @click="meterans.push({ daya_listrik: '' })"
                                    class="shrink-0 inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-all active:scale-95 text-xs lg:text-sm shadow-md shadow-blue-600/10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Meteran
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <template x-for="(meteran, index) in meterans" :key="index">
                                    <div
                                        class="bg-white border border-slate-200 shadow-sm rounded-xl p-4 relative space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400"
                                                x-text="'Meteran #' + (index + 1)"></span>
                                            <button type="button" @click="meterans.splice(index, 1)"
                                                class="text-xs font-bold text-rose-600 hover:text-rose-800 transition-colors">
                                                Hapus
                                            </button>
                                        </div>

                                        <div class="space-y-1.5">
                                            <label class="block text-xs font-bold text-slate-600">
                                                31b. Berapa daya distrik yang terpasang?
                                            </label>
                                            <select :name="'meterans[' + index + '][daya_listrik]'"
                                                x-model="meteran.daya_listrik"
                                                class="w-full rounded-xl border-slate-200 bg-slate-50/50 p-2.5 font-semibold text-slate-700 focus:border-blue-500 text-xs lg:text-sm cursor-pointer">
                                                <option value="">-- Pilih Daya Listrik --</option>
                                                @foreach ($dayaListrik as $key => $label)
                                                    <option value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div x-show="meterans.length === 0"
                                class="text-center py-6 border border-dashed border-slate-200 rounded-xl text-slate-400 font-medium text-sm">
                                Belum ada komponen meteran yang ditambahkan.
                            </div>

                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>
                        <h2 class="font-black text-lg text-slate-900 tracking-tight">
                            V. Perkreditan Rumah Tangga
                    </div>

                    <div class="space-y-8">
                        <div class="space-y-4">
                            <label class="block text-sm lg:text-base font-bold text-slate-800 tracking-tight">
                                32. Apakah ada minimal salah satu anggota keluarga ini yang menerima kredit dari lembaga
                                keuangan
                                berikut dalam setahun terakhir?
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-3xl">
                                @foreach ($kreditSumber as $key => $label)
                                    <label
                                        class="flex items-center gap-3 p-3 rounded-2xl border border-slate-100 hover:border-slate-200 bg-slate-50/30 hover:bg-slate-50 cursor-pointer transition-all group">
                                        <input type="checkbox"
                                            class="exclusive-checkbox w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500 focus:ring-opacity-50"
                                            data-group="kredit_sumber" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                            name="kredit_sumber[]" value="{{ $key }}"
                                            @checked(in_array($key, old('kredit_sumber', $keluarga->kredit_sumber ?? [])))>
                                        <span
                                            class="text-sm font-semibold text-slate-600 group-hover:text-slate-800 transition-colors">
                                            {{ $label }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-4 border-t border-slate-100 pt-6">
                            <label class="block text-sm lg:text-base font-bold text-slate-800 tracking-tight">
                                33. Apakah dalam setahun terakhir keluarga ini pernah menerima kredit dari lembaga keuangan
                                dan
                                untuk apa?
                            </label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-3xl">
                                @foreach ($kreditTujuan as $key => $label)
                                    <label
                                        class="flex items-center gap-3 p-3 rounded-2xl border border-slate-100 hover:border-slate-200 bg-slate-50/30 hover:bg-slate-50 cursor-pointer transition-all group">
                                        <input type="checkbox"
                                            class="exclusive-checkbox w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500 focus:ring-opacity-50"
                                            data-group="kredit_tujuan" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                            name="kredit_tujuan[]" value="{{ $key }}"
                                            @checked(in_array($key, old('kredit_tujuan', $keluarga->kredit_tujuan ?? [])))>
                                        <span
                                            class="text-sm font-semibold text-slate-600 group-hover:text-slate-800 transition-colors">
                                            {{ $label }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                    <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>
                        <h2 class="font-black text-lg text-slate-900 tracking-tight">
                            VI. Tagging Lokasi
                    </div>

                    <div class="space-y-8">
                        <x-geo-location latitude-field="latitude_rumah" longitude-field="longitude_rumah"
                            accuracy-field="akurasi_rumah" />


                        {{-- Action Submit --}}
                        <div class="flex items-center justify-end gap-3 border-t-2 border-gray-300 pt-4">
                            <a href="{{ route('admin.tempat.survey', $tempat) }}"
                                class="px-6 py-2.5 border rounded-xl text-gray-700 hover:bg-gray-50 transition-all active:scale-95">
                                Batal
                            </a>
                            <button type="submit" @click="redirectTo = 'survey'"
                                class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold transition-all active:scale-95 shadow-md shadow-blue-600/20 text-sm text-center">
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div x-show="showAnggotaModal" x-cloak x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">

                <div @click.away="showAnggotaModal = false" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    class="bg-white rounded-3xl p-6 lg:p-8 w-full max-w-md border border-slate-100 shadow-xl space-y-6">

                    <div class="space-y-2">
                        <h3 class="text-xl font-black text-slate-900 tracking-tight">
                            Simpan Data Keluarga?
                        </h3>
                        <p class="text-sm font-semibold text-slate-500 leading-relaxed">
                            Data instrumen induk keluarga akan disimpan terlebih dahulu ke dalam sistem, kemudian Anda
                            otomatis
                            dialihkan menuju halaman entri data anggota keluarga.
                        </p>
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-50 pt-4">
                        <button type="button" @click="showAnggotaModal = false"
                            class="px-5 py-3 rounded-xl font-bold text-slate-600 hover:bg-slate-100 transition-all active:scale-95 text-sm">
                            Batal
                        </button>
                        <button type="button"
                            @click="redirectTo = 'anggota'; $nextTick(() => { $refs.keluargaForm.submit(); });"
                            class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-all active:scale-95 shadow-md shadow-blue-600/10 text-sm">
                            Simpan & Lanjut
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function keluargaForm() {
                return {
                    /**
                     * FLOW ANGGOTA KELUARGA
                     */
                    redirectTo: 'survey',
                    showAnggotaModal: false,

                    /**
                     * METERAN LISTRIK
                     */
                    meterans: [],

                    /**
                     * VALIDASI & KONDISIONAL
                     */
                    fasilitasBab: '{{ old('fasilitas_bab', $keluarga->fasilitas_bab ?? '') }}',
                    sumberPenerangan: '{{ old('sumber_penerangan', $keluarga->sumber_penerangan ?? '') }}',

                    init() {
                        this.$watch('fasilitasBab', value => {
                            if (value == 6) {
                                this.$refs.jenisKloset.value = '';
                                this.$refs.pembuanganTinja.value = '';
                            }
                        });
                    }
                };
            }

            // Integrasi eksklusivitas checkbox (cth: jawaban 'Tidak Ada / Kode X')
            document.querySelectorAll('.exclusive-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const groupName = this.getAttribute('data-group');
                    const isExclusive = this.getAttribute('data-exclusive') === '1';

                    if (this.checked) {
                        document.querySelectorAll(`.exclusive-checkbox[data-group="${groupName}"]`).forEach(
                            sibling => {
                                if (sibling !== this) {
                                    if (isExclusive || sibling.getAttribute('data-exclusive') === '1') {
                                        sibling.checked = false;
                                    }
                                }
                            });
                    }
                });
            });
        </script>
    @endpush
@endsection

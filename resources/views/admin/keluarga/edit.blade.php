@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Perbarui Data Keluarga
            </h1>

            <p class="text-gray-500 mt-1">
                {{ $tempat->nama_tempat }}
            </p>

        </div>

        <div x-data="keluargaForm()">

            <form method="POST" action="{{ route('admin.keluarga.update', $tempat) }}" class="space-y-6">

                @csrf
                @method('PUT')

                <div class="bg-white rounded-2xl border p-6">

                    <h2 class="font-semibold text-lg mb-5">
                        1. Identitas Keluarga
                    </h2>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                a. Nama Kepala Keluarga
                            </label>

                            <input type="text" name="nama_kepala_keluarga"
                                value="{{ old('nama_kepala_keluarga', $keluarga->nama_kepala_keluarga) }}"
                                class="w-full rounded-xl border-gray-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                b. NIK Kepala Keluarga
                            </label>

                            <input type="text" name="nik_kepala_keluarga"
                                value="{{ old('nik_kepala_keluarga', $keluarga->nik_kepala_keluarga) }}" maxlength="16"
                                class="w-full rounded-xl border-gray-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                c. Nomor Kartu Keluarga (KK) dari Kepala Keluarga
                            </label>

                            <input type="text" name="nomor_kk" value="{{ old('nomor_kk', $keluarga->nomor_kk) }}"
                                maxlength="16" class="w-full rounded-xl border-gray-300">

                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-2xl border p-6">

                    <h2 class="font-semibold text-lg mb-5">
                        2. Alamat
                    </h2>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                a. Provinsi
                            </label>

                            <input type="text" name="provinsi" value="{{ old('provinsi', $keluarga->provinsi) }}"
                                class="w-full rounded-xl border-gray-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                b. Kabupaten/Kota
                            </label>

                            <input type="text" name="kabupaten" value="{{ old('kabupaten', $keluarga->kabupaten) }}"
                                class="w-full rounded-xl border-gray-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                c. Kecamatan
                            </label>

                            <input type="text" name="kecamatan" value="{{ old('kecamatan', $keluarga->kecamatan) }}"
                                class="w-full rounded-xl border-gray-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                d. Desa/Kelurahan
                            </label>

                            <input type="text" name="desa" value="{{ old('desa', $keluarga->desa) }}"
                                class="w-full rounded-xl border-gray-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                e. Dusun
                            </label>

                            <input type="text" name="dusun" value="{{ old('dusun', $keluarga->dusun) }}"
                                class="w-full rounded-xl border-gray-300">

                        </div>

                        <div class="md:col-span-2">

                            <label class="block text-sm font-medium mb-2">
                                f. Alamat Lengkap
                            </label>

                            <textarea name="alamat_detail" rows="4" class="w-full rounded-xl border-gray-300">{{ old('alamat_detail', $keluarga->alamat_detail) }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="bg-white rounded-2xl border p-6">

                    <h2 class="font-semibold text-lg mb-5">
                        3. Kondisi Perumahan
                    </h2>

                    <div class="mb-3">

                        <label class="block text-sm font-medium mb-2">
                            a. Apakah alamat tersebut sesuai dengan alamat pada Kartu Keluarga (KK)?  
                        </label>

                        <div class="space-y-2">

                            @foreach ($yaTidak as $key => $label)
                                <label class="flex items-center gap-2">

                                    <input type="radio" name="alamat_sesuai_kk" value="{{ $key }}"
                                        @checked(old('alamat_sesuai_kk', $keluarga->alamat_sesuai_kk ?? null) == $key)>

                                    {{ $label }}

                                </label>
                            @endforeach

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="block text-sm font-medium mb-2">
                            b. Berapa jumlah keluarga yang tinggal dalam 1 rumah/tempat tinggal?
                        </label>

                        <input type="number" min="1" name="jumlah_keluarga_dalam_rumah"
                            value="{{ old('jumlah_keluarga_dalam_rumah', $keluarga->jumlah_keluarga_dalam_rumah ?? '') }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div class="mb-3">

                        <label class="block text-sm font-medium mb-2">
                            c. Apa status kepemilikan bangunan tempat tinggal yang ditempati? 
                        </label>

                        <select name="status_kepemilikan_rumah" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Status
                            </option>

                            @foreach ($statusKepemilikanRumah as $key => $label)
                                <option value="{{ $key }}" @selected(old('status_kepemilikan_rumah', $keluarga->status_kepemilikan_rumah ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            d. Berapa luas lantai bangunan tempat tinggal yang ditempati? (m2)
                        </label>

                        <input type="number" min="1" name="luas_lantai"
                            value="{{ old('luas_lantai', $keluarga->luas_lantai ?? '') }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            e. Apa bahan bangunan utama lantai rumah terluas?
                        </label>

                        <select name="bahan_lantai" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($bahanLantai as $key => $label)
                                <option value="{{ $key }}" @selected(old('bahan_lantai', $keluarga->bahan_lantai ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            f. Apa bahan bangunan utama dinding rumah terluas?
                        </label>

                        <select name="bahan_dinding" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($bahanDinding as $key => $label)
                                <option value="{{ $key }}" @selected(old('bahan_dinding', $keluarga->bahan_dinding ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            g. Apa bahan bangunan utama atap rumah terluas?
                        </label>

                        <select name="bahan_atap" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($bahanAtap as $key => $label)
                                <option value="{{ $key }}" @selected(old('bahan_atap', $keluarga->bahan_atap ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div class="bg-white rounded-2xl border p-6">

                    <h2 class="font-semibold text-lg mb-5">
                        4. Sanitasi & Utilitas
                    </h2>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            a. Apakah memiliki fasilitas tempat buang air besar dan siapa saja yang menggunakan? 
                        </label>

                        <select name="fasilitas_bab" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($fasilitasBab as $key => $label)
                                <option value="{{ $key }}" @selected(old('fasilitas_bab', $keluarga->fasilitas_bab ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            b. Apa jenis kloset yang digunakan?
                        </label>

                        <select name="jenis_kloset" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($jenisKloset as $key => $label)
                                <option value="{{ $key }}" @selected(old('jenis_kloset', $keluarga->jenis_kloset ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            c. Di manakah tempat pembuangan akhir tinja? 
                        </label>

                        <select name="pembuangan_tinja" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($pembuanganTinja as $key => $label)
                                <option value="{{ $key }}" @selected(old('pembuangan_tinja', $keluarga->pembuangan_tinja ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            d. Apa sumber air utama yang digunakan keluarga untuk minum?
                        </label>

                        <select name="sumber_air_minum" class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($sumberAirMinum as $key => $label)
                                <option value="{{ $key }}" @selected(old('sumber_air_minum', $keluarga->sumber_air_minum ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-2">
                            e. Apa sumber penerangan utama rumah ini?
                        </label>

                        <select name="sumber_penerangan" x-model="sumberPenerangan"
                            class="w-full rounded-xl border-gray-300">

                            <option value="">
                                Pilih Jawaban
                            </option>

                            @foreach ($sumberPenerangan as $key => $label)
                                <option value="{{ $key }}" @selected(old('sumber_penerangan', $keluarga->sumber_penerangan ?? null) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- 29A & 29B METERAN LISTRIK --}}

                    <div x-show="sumberPenerangan == '1'" x-cloak
                        class="bg-blue-50 border border-blue-200 rounded-2xl p-6">

                        <div class="flex items-center justify-between mb-5">

                            <div>

                                <h3 class="font-semibold text-blue-900">
                                    f. Jika listrik PLN dengan meteran, berapa jumlah meteran listrik yang terpasang di rumah ini?
                                </h3>

                                <p class="text-sm text-blue-700 mt-1">
                                    Tambahkan seluruh meteran listrik yang terpasang pada rumah ini
                                </p>

                            </div>

                            <button type="button"
                                @click="
                                    meterans.push({
                                        daya_listrik: ''
                                    })
                                "
                                class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">

                                + Tambah Meteran

                            </button>

                        </div>

                        <template x-for="(meteran, index) in meterans" :key="index">

                            <div class="bg-white border rounded-xl p-5 mb-4">

                                <div class="flex items-center justify-between mb-4">

                                    <h4 class="font-medium text-gray-800" x-text="'Meteran #' + (index + 1)">
                                    </h4>

                                    <button type="button" @click="meterans.splice(index, 1)"
                                        class="text-red-600 text-sm">

                                        Hapus

                                    </button>

                                </div>

                                <div>

                                    <label class="block text-sm font-medium mb-2">

                                        g.  Berapa daya listrik yang terpasang di rumah ini? 

                                    </label>

                                    <select :name="'meterans[' + index + '][daya_listrik]'" x-model="meteran.daya_listrik"
                                        class="w-full rounded-xl border-gray-300">

                                        <option value="">
                                            -- Pilih Daya Listrik --
                                        </option>

                                        @foreach ($dayaListrik as $key => $label)
                                            <option value="{{ $key }}">
                                                {{ $label }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </template>

                        <div x-show="meterans.length === 0" class="text-center py-8 text-gray-500">

                            Belum ada meteran ditambahkan

                        </div>

                    </div>

                </div>

                <div class="bg-white border rounded-2xl p-6">

                    <h2 class="font-semibold text-lg mb-5">
                        5. Kredit dan Pinjaman
                    </h2>

                    <div>

                        <label class="block text-sm font-medium mb-2">

                            a. Apakah ada minimal salah satu anggota keluarga ini yang menerima kredit dari lembaga keuangan berikut dalam setahun terakhir? 

                        </label>

                        <div class="space-y-2">

                            @foreach ($kreditSumber as $key => $label)
                                <label class="flex items-center gap-3">

                                    <input type="checkbox" class="exclusive-checkbox" data-group="kredit_sumber"
                                        data-exclusive="{{ $key === 'X' ? '1' : '0' }}" name="kredit_sumber[]"
                                        value="{{ $key }}" @checked(in_array($key, old('kredit_sumber', $keluarga->kredit_sumber ?? [])))>

                                    <span>
                                        {{ $label }}
                                    </span>

                                </label>
                            @endforeach

                        </div>

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">

                            b. Apakah dalam setahun terakhir keluarga ini pernah menerima kredit dari lembaga keuangan?

                        </label>

                        <div class="space-y-2">

                            @foreach ($kreditTujuan as $key => $label)
                                <label class="flex items-center gap-3">

                                    <input type="checkbox" class="exclusive-checkbox" data-group="kredit_tujuan"
                                        data-exclusive="{{ $key === 'X' ? '1' : '0' }}" name="kredit_tujuan[]"
                                        value="{{ $key }}" @checked(in_array($key, old('kredit_tujuan', $keluarga->kredit_tujuan ?? [])))>

                                    <span>
                                        {{ $label }}
                                    </span>

                                </label>
                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="flex justify-end">

                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-medium">

                        Simpan Data Keluarga

                    </button>

                </div>

            </form>

        </div>

        <form action="{{ route('admin.keluarga.destroy', $tempat) }}" method="POST"
            onsubmit="return confirm('Hapus data keluarga ini?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="px-5 py-3 rounded-xl bg-red-600 text-white">

                Hapus Data

            </button>

        </form>

    </div>

    @push('scripts')
        <script>
            function keluargaForm() {
                return {

                    sumberPenerangan: '{{ old('sumber_penerangan', $keluarga->sumber_penerangan) }}',

                    meterans:

                        @json(old(
                                'meterans',
                        
                                $keluarga->meterans->map(fn($m) => [
                                            'daya_listrik' => $m->daya_listrik,
                                        ])->values())),

                };
            }
        </script>
    @endpush
@endsection

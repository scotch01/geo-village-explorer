@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto">

        <h1 class="text-2xl font-bold">
            Data Usaha
        </h1>

        <p class="text-gray-500 mt-1">
            {{ $tempat->nama_tempat }}
        </p>

        <form x-data="{
        
            sameAddress: {{ $tempat->jenis_bangunan === 'bc' ? 'true' : 'false' }},
        
            internetTidakDigunakan: false,
        
            keluarga: {
        
                provinsi: @js($keluarga?->provinsi),
                kabupaten: @js($keluarga?->kabupaten),
                kecamatan: @js($keluarga?->kecamatan),
                desa: @js($keluarga?->desa),
                dusun: @js($keluarga?->dusun),
                alamat: @js($keluarga?->alamat_detail),
        
            },
        
            checkInternet() {
        
                const checkboxX = document.querySelector(
                    'input[name=&quot;penggunaan_internet[]&quot;][value=&quot;X&quot;]'
                );
        
                this.internetTidakDigunakan =
                    checkboxX?.checked ?? false;
        
                if (!this.internetTidakDigunakan) {
        
                    document
                        .querySelectorAll(
                            'input[name=&quot;alasan_tidak_internet[]&quot;]'
                        )
                        .forEach(el => {
                            el.checked = false;
                        });
                }
            }
        }" x-init="checkInternet()" action="{{ route('admin.usaha.store', $tempat) }}" method="POST"
            class="mt-6 space-y-6">

            @csrf

            <div class="bg-white rounded-2xl border p-6">

                <h2 class="font-semibold text-lg mb-4">
                    Alamat Usaha
                </h2>

                @if ($tempat->jenis_bangunan === 'bc')
                    <label class="flex items-center gap-2 mb-6">

                        <input type="checkbox" x-model="sameAddress">

                        <span>
                            Alamat usaha sama dengan alamat keluarga
                        </span>

                    </label>
                @endif

                <div class="grid md:grid-cols-2 gap-4">

                    <div>

                        <label class="block text-sm mb-2">
                            1. Provinsi
                        </label>

                        <input type="text" name="provinsi"
                            x-bind:value="sameAddress
                                ?
                                keluarga.provinsi :
                                ''"
                            x-bind:readonly="sameAddress" class="w-full rounded-xl border-gray-300">
                    </div>

                    <div>

                        <label class="block text-sm mb-2">
                            2. Kabupaten
                        </label>

                        <input type="text" name="kabupaten"
                            x-bind:value="sameAddress
                                ?
                                keluarga.kabupaten :
                                ''"
                            x-bind:readonly="sameAddress" class="w-full rounded-xl border-gray-300">
                    </div>

                    <div>

                        <label class="block text-sm mb-2">
                            3. Kecamatan
                        </label>

                        <input type="text" name="kecamatan"
                            x-bind:value="sameAddress
                                ?
                                keluarga.kecamatan :
                                ''"
                            x-bind:readonly="sameAddress" class="w-full rounded-xl border-gray-300">
                    </div>

                    <div>

                        <label class="block text-sm mb-2">
                            4. Desa
                        </label>

                        <input type="text" name="desa"
                            x-bind:value="sameAddress
                                ?
                                keluarga.desa :
                                ''"
                            x-bind:readonly="sameAddress" class="w-full rounded-xl border-gray-300">
                    </div>

                    <div>

                        <label class="block text-sm mb-2">
                            5. Dusun
                        </label>

                        <input type="text" name="dusun"
                            x-bind:value="sameAddress
                                ?
                                keluarga.dusun :
                                ''"
                            x-bind:readonly="sameAddress" class="w-full rounded-xl border-gray-300">
                    </div>

                </div>

                <div class="mt-4">

                    <label class="block text-sm mb-2">
                        6. Alamat
                    </label>

                    <textarea name="alamat"
                        x-text="
                sameAddress
                    ? keluarga.alamat
                    : ''
            "
                        x-bind:readonly="sameAddress" rows="3" class="w-full rounded-xl border-gray-300"></textarea>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        7. Nama Usaha
                    </label>

                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

            </div>

            <div class="bg-white rounded-2xl border p-6">

                {{-- <h2 class="font-semibold text-lg mb-4">
                    Kontak Usaha
                </h2> --}}

                <div class="grid md:grid-cols-2 gap-4">

                    <div>

                        <label class="block text-sm mb-2">
                            8.Telepon / HP
                        </label>

                        <input type="text" name="telepon" value="{{ old('telepon') }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm mb-2">
                            9. E-mail
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                </div>

                <div class="mt-4">

                    <label class="block text-sm mb-2">
                        10. Website / Akun Media Sosial
                    </label>

                    <input type="text" name="website" value="{{ old('website') }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                {{-- <div class="mt-4">

                    <label class="block text-sm mb-2">
                        11. Tagging Lokasi
                    </label>

                    <input type="text" class="w-full rounded-xl border-gray-300">

                </div> --}}

            </div>

            <div class="bg-white rounded-2xl border p-6">

                <h2 class="font-semibold text-lg mb-4">
                    Identitas Usaha
                </h2>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        12. Dimana lokasi tepat usaha/perusahaan
                    </label>

                    <select name="lokasi_usaha" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih Lokasi
                        </option>

                        @foreach ($lokasiUsaha as $value => $label)
                            <option value="{{ $value }}" @selected(old('lokasi_usaha') == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        13. Status Kepemilikan Bangunan
                    </label>

                    <select name="status_bangunan" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih Lokasi
                        </option>

                        @foreach ($statusBangunan as $value => $label)
                            <option value="{{ $value }}" @selected(old('status_bangunan') == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>

            </div>
            <div class="bg-white rounded-2xl border p-6">
                <label class="block text-sm font-medium mb-2">
                    14. Identitas pemilik usaha/perusahaan
                </label>
                <div>
                    <label class="block text-sm font-medium mb-2">
                        a. Nama
                    </label>

                    <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik') }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        b. NIK
                    </label>

                    <input type="text" name="nik_pemilik" maxlength="16" value="{{ old('nik_pemilik') }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">

                        c. Jenis Kelamin

                    </label>

                    <select name="jenis_kelamin_pemilik" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($jenisKelamin as $key => $label)
                            <option value="{{ $key }}" @selected(old('jenis_kelamin_pemilik') == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        d. Tanggal Lahir
                    </label>

                    <input type="date" name="tanggal_lahir_pemilik" value="{{ old('tanggal_lahir_pemilik') }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        f. Ijazah tertinggi yang dimiliki
                    </label>

                    <select name="ijazah_pemilik" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($pendidikan as $key => $label)
                            <option value="{{ $key }}" @selected(old('ijazah_pemilik') == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

            </div>
            <div class="bg-white rounded-2xl border p-6">
                <div>
                    <label class="block text-sm font-medium mb-2">
                        15. Apa Kegiatan Utama dari usaha ini?, <span class="italic">(Tuliskan selengkapnya)</span>
                    </label>

                    <textarea name="kegiatan_utama" rows="4" class="w-full rounded-xl border-gray-300">{{ old('kegiatan_utama') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        16. Apa produk utama yang dihasilkan <span class="italic">(Tuliskan selengkapnya)</span>
                    </label>

                    <textarea name="produk_utama" rows="4" class="w-full rounded-xl border-gray-300">{{ old('produk_utama') }}</textarea>
                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        17. Kategori Lapangan Usaha
                    </label>

                    <input type="text" name="kategori_lapangan_usaha" value="{{ old('kategori_lapangan_usaha') }}"
                        readonly placeholder="Diisi oleh pengawas BPS"
                        class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-500">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        18. Kode KBLI 2020
                    </label>

                    <input type="text" name="kbli" value="{{ old('kbli') }}" readonly
                        placeholder="Diisi oleh pengawas BPS"
                        class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-500">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        19. Tahun Mulai Beroperasi
                    </label>

                    <input type="number" name="tahun_mulai" min="1900" max="{{ now()->year }}"
                        value="{{ old('tahun_mulai') }}" class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        20. Apa saja ijin usaha/sertifikat usaha yang dimiliki usaha/perusahaan?
                    </label>

                    <div class="space-y-2">

                        @foreach ($izinUsaha as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="izin_usaha"
                                    data-exclusive="{{ $value === 'X' ? '1' : '0' }}" name="izin_usaha[]"
                                    value="{{ $value }}"
                                    {{ in_array($value, old('izin_usaha', [])) ? 'checked' : '' }}>

                                <span>
                                    {{ $label }}
                                </span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        21. Bentuk Badan Usaha / Badan Hukum
                    </label>

                    <select name="bentuk_badan_usaha" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($badanUsaha as $value => $label)
                            <option value="{{ $value }}" @selected(old('bentuk_badan_usaha') == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

            </div>

            <div class="bg-white rounded-2xl border p-6">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        22a. Berapa jumlah pekerja dibayar?, (orang)
                    </label>

                    <input type="number" min="0" name="jumlah_pekerja_dibayar"
                        value="{{ old('jumlah_pekerja_dibayar', 0) }}" class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        22b. Berapa total upah/gaji yang dibayarkan sebulan terakhir?, (Rp 000)
                    </label>

                    <input type="number" min="0" step="1" name="total_upah_bulanan"
                        value="{{ old('total_upah_bulanan', 0) }}" class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        22c. Berapa jumlah pekerja tidak dibayar/pekerja keluarga (termasuk pemilik)?, (orang)
                    </label>

                    <input type="number" min="0" name="jumlah_pekerja_tidak_dibayar"
                        value="{{ old('jumlah_pekerja_tidak_dibayar', 0) }}" class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        23a. Berapa nilai produksi/pendapatan/penjualan sebulan terakhir atau bulan terakhir beroperasi?,
                        (Rp 000)
                    </label>

                    <input type="number" min="0" step="1" name="pendapatan_bulanan"
                        value="{{ old('pendapatan_bulanan', 0) }}" class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        23b. Berapa nilai produksi/pendapatan/penjualan selama tahun 2025?, (Rp 000)
                    </label>

                    <input type="number" min="0" step="1" name="pendapatan_tahunan"
                        value="{{ old('pendapatan_tahunan', 0) }}" class="w-full rounded-xl border-gray-300">

                </div>

            </div>

            <div class="bg-white rounded-2xl border p-6">

                <div>

                    <label class="block text-sm font-medium mb-3">
                        24. Apakah menggunakan internet dalam menjalankan usaha selama setahun terakhir?
                    </label>

                    <div class="space-y-2">

                        @foreach ($penggunaanInternet as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" @change="checkInternet()"
                                    data-group="penggunaan_internet" data-exclusive="{{ $value == 'X' ? '1' : '0' }}"
                                    name="penggunaan_internet[]" value="{{ $value }}"
                                    {{ in_array($value, old('penggunaan_internet', [])) ? 'checked' : '' }}>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        25. Media internet apa saja yang digunakan untuk usaha selama setahun terakhir?
                    </label>

                    <div class="space-y-2">

                        @foreach ($mediaInternet as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="media_internet"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="media_internet[]"
                                    value="{{ $value }}"
                                    {{ in_array($value, old('media_internet', [])) ? 'checked' : '' }}>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        26. Jika tidak menggunakan internet, apa alasannya?
                    </label>

                    <div class="space-y-2"
                        :class="{
                            'opacity-50 pointer-events-none': !internetTidakDigunakan
                        }">

                        @foreach ($tidakPenggunaanInternet as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" :disabled="!internetTidakDigunakan" class="exclusive-checkbox"
                                    data-group="alasan_tidak_internet" data-exclusive="{{ $value == 'X' ? '1' : '0' }}"
                                    name="alasan_tidak_internet[]" value="{{ $value }}"
                                    {{ in_array($value, old('alasan_tidak_internet', [])) ? 'checked' : '' }}>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl border p-6">

                <div>

                    <label class="block text-sm font-medium mb-3">
                        27. Apakah usaha/perusahaan ini menerima kredit atau pinjaman dari lembaga berikut?
                    </label>

                    <div class="space-y-2">

                        @foreach ($sumberPinjaman as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="sumber_pinjaman"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="sumber_pinjaman[]"
                                    value="{{ $value }}"
                                    {{ in_array($value, old('sumber_pinjaman', [])) ? 'checked' : '' }}>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        28. Jika menerima kredit/pinjaman, untuk apa pinjaman tersebut digunakan?
                    </label>

                    <div class="space-y-2">

                        @foreach ($tujuanPinjaman as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="tujuan_pinjaman"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="tujuan_pinjaman[]"
                                    value="{{ $value }}"
                                    {{ in_array($value, old('tujuan_pinjaman', [])) ? 'checked' : '' }}>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        29. Jika tidak menerima kredit atau pinjaman, apa alasan utamanya?,
                    </label>

                    <select name="tidak_menerima_kredit" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($tidakMenerimaKredit as $value => $label)
                            <option value="{{ $value }}" @selected(old('tidak_menerima_kredit') == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        30. Kendala/kesulitan yang dialami oleh usaha/perusahaan selama setahun yang lalu:
                    </label>

                    <div class="space-y-2">

                        @foreach ($kendalaUsaha as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="kendala_usaha"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="kendala_usaha[]"
                                    value="{{ $value }}"
                                    {{ in_array($value, old('kendala_usaha', [])) ? 'checked' : '' }}>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

            </div>

            <div>

                <button type="submit" class="px-5 py-3 rounded-xl bg-green-600 text-white">

                    Simpan

                </button>

            </div>

        </form>

    </div>
@endsection

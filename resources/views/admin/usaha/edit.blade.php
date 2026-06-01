@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto">

        <h1 class="text-2xl font-bold">
            Edit Data Usaha
        </h1>

        <p class="text-gray-500 mt-1">
            {{ $tempat->nama_tempat }}
        </p>

        <form x-data="{
        
            sameAddress: {{ $tempat->jenis_bangunan === 'bc' ? 'true' : 'false' }},
        
            keluarga: {
        
                provinsi: @js($keluarga?->provinsi),
                kabupaten: @js($keluarga?->kabupaten),
                kecamatan: @js($keluarga?->kecamatan),
                desa: @js($keluarga?->desa),
                dusun: @js($keluarga?->dusun),
                alamat: @js($keluarga?->alamat_detail),
        
            }
        }" action="{{ route('admin.usaha.update', $tempat) }}" method="POST" class="mt-6 space-y-6">

            @csrf
            @method('PUT')

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
                            Provinsi
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
                            Kabupaten
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
                            Kecamatan
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
                            Desa
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
                            Dusun
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
                        Alamat
                    </label>

                    <textarea name="alamat"
                        x-text="
                sameAddress
                    ? keluarga.alamat
                    : ''
            "
                        x-bind:readonly="sameAddress" rows="3" class="w-full rounded-xl border-gray-300"></textarea>

                </div>

            </div>

            <div class="bg-white rounded-2xl border p-6">

                <h2 class="font-semibold text-lg mb-4">
                    Kontak Usaha
                </h2>

                <div class="grid md:grid-cols-2 gap-4">

                    <div>

                        <label class="block text-sm mb-2">
                            Telepon / HP
                        </label>

                        <input type="text" name="telepon" value="{{ old('telepon', $usaha->telepon) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm mb-2">
                            E-mail
                        </label>

                        <input type="email" name="email" value="{{ old('email', $usaha->email) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                </div>

                <div class="mt-4">

                    <label class="block text-sm mb-2">
                        Website / Akun Media Sosial
                    </label>

                    <input type="text" name="website" value="{{ old('website', $usaha->website) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

            </div>

            <div class="bg-white rounded-2xl border p-6">

                <h2 class="font-semibold text-lg mb-4">
                    Identitas Usaha
                </h2>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Nama Usaha
                    </label>

                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $usaha->nama_usaha) }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Lokasi Usaha
                    </label>

                    <select name="lokasi_usaha" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih Lokasi
                        </option>

                        @foreach ($lokasiUsaha as $value => $label)
                            <option value="{{ $value }}" @selected(old('lokasi_usaha', $usaha->lokasi_usaha) == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Status Kepemilikan Bangunan
                    </label>

                    <select name="status_bangunan" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih Lokasi
                        </option>

                        @foreach ($statusBangunan as $value => $label)
                            <option value="{{ $value }}" @selected(old('status_bangunan', $usaha->status_bangunan) == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nama Pemilik Usaha
                    </label>

                    <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik', $usaha->nama_pemilik) }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        NIK Pemilik Usaha
                    </label>

                    <input type="text" name="nik_pemilik" maxlength="16"
                        value="{{ old('nik_pemilik', $usaha->nik_pemilik) }}" class="w-full rounded-xl border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">

                        Jenis Kelamin

                    </label>

                    <select name="jenis_kelamin_pemilik" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($jenisKelamin as $key => $label)
                            <option value="{{ $key }}" @selected(old('jenis_kelamin_pemilik', $usaha->jenis_kelamin_pemilik) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tanggal Lahir Pemilik
                    </label>

                    <input type="date" name="tanggal_lahir_pemilik"
                        value="{{ old('tanggal_lahir_pemilik', $usaha->tanggal_lahir_pemilik) }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Pendidikan
                    </label>

                    <select name="ijazah_pemilik" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($pendidikan as $key => $label)
                            <option value="{{ $key }}" @selected(old('ijazah_pemilik', $usaha->ijazah_pemilik) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Kegiatan Utama Usaha
                    </label>

                    <textarea name="kegiatan_utama" rows="4" class="w-full rounded-xl border-gray-300">{{ old('kegiatan_utama', $usaha->kegiatan_utama) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Produk Utama Usaha
                    </label>

                    <textarea name="produk_utama" rows="4" class="w-full rounded-xl border-gray-300">{{ old('produk_utama', $usaha->produk_utama) }}</textarea>
                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Kategori Lapangan Usaha
                    </label>

                    <input type="text" name="kategori_lapangan_usaha"
                        value="{{ old('kategori_lapangan_usaha', $usaha->kategori_lapangan_usaha) }}" readonly
                        placeholder="Diisi oleh pengawas BPS"
                        class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-500">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Kode KBLI
                    </label>

                    <input type="text" name="kbli" value="{{ old('kbli', $usaha->kbli) }}" readonly
                        placeholder="Diisi oleh pengawas BPS"
                        class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-500">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Tahun Mulai Beroperasi
                    </label>

                    <input type="number" name="tahun_mulai" min="1900" max="{{ now()->year }}"
                        value="{{ old('tahun_mulai', $usaha->tahun_mulai) }}" class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Izin Usaha
                    </label>

                    <div class="space-y-2">

                        @foreach ($izinUsaha as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="izin_usaha"
                                    data-exclusive="{{ $value === 'X' ? '1' : '0' }}" name="izin_usaha[]"
                                    value="{{ $value }}" @checked(in_array($value, old('izin_usaha', $usaha->izin_usaha ?? [])))>

                                <span>
                                    {{ $label }}
                                </span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Bentuk Badan Usaha / Badan Hukum
                    </label>

                    <select name="bentuk_badan_usaha" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($badanUsaha as $value => $label)
                            <option value="{{ $value }}" @selected(old('bentuk_badan_usaha', $usaha->bentuk_badan_usaha) == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Jumlah Pekerja Dibayar
                    </label>

                    <input type="number" min="0" name="jumlah_pekerja_dibayar"
                        value="{{ old('jumlah_pekerja_dibayar', $usaha->jumlah_pekerja_dibayar ?? 0) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Total Upah / Gaji Bulanan (Rp)
                    </label>

                    <input type="number" min="0" step="1" name="total_upah_bulanan"
                        value="{{ old('total_upah_bulanan', $usaha->total_upah_bulanan ?? 0) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Jumlah Pekerja Tidak Dibayar
                    </label>

                    <input type="number" min="0" name="jumlah_pekerja_tidak_dibayar"
                        value="{{ old('jumlah_pekerja_tidak_dibayar', $usaha->jumlah_pekerja_tidak_dibayar ?? 0) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Pendapatan Bulanan (Rp)
                    </label>

                    <input type="number" min="0" step="1" name="pendapatan_bulanan"
                        value="{{ old('pendapatan_bulanan', $usaha->pendapatan_bulanan ?? 0) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Pendapatan Tahunan (Rp)
                    </label>

                    <input type="number" min="0" step="1" name="pendapatan_tahunan"
                        value="{{ old('pendapatan_tahunan', $usaha->pendapatan_tahunan ?? 0) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Penggunaan Internet
                    </label>

                    <div class="space-y-2">

                        @foreach ($penggunaanInternet as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="penggunaan_internet"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="penggunaan_internet[]"
                                    value="{{ $value }}" @checked(in_array($value, old('penggunaan_internet', $usaha->penggunaan_internet ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Media Internet
                    </label>

                    <div class="space-y-2">

                        @foreach ($mediaInternet as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="media_internet"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="media_internet[]"
                                    value="{{ $value }}" @checked(in_array($value, old('media_internet', $usaha->media_internet ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Alasan Tidak Menggunakan Internet
                    </label>

                    <div class="space-y-2">

                        @foreach ($tidakPenggunaanInternet as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="alasan_tidak_internet"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="alasan_tidak_internet[]"
                                    value="{{ $value }}" @checked(in_array($value, old('alasan_tidak_internet', $usaha->alasan_tidak_internet ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Sumber Kredit/Pinjaman
                    </label>

                    <div class="space-y-2">

                        @foreach ($sumberPinjaman as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="sumber_pinjaman"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="sumber_pinjaman[]"
                                    value="{{ $value }}" @checked(in_array($value, old('sumber_pinjaman', $usaha->sumber_pinjaman ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Tujuan Kredit/Pinjaman
                    </label>

                    <div class="space-y-2">

                        @foreach ($tujuanPinjaman as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="tujuan_pinjaman"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="tujuan_pinjaman[]"
                                    value="{{ $value }}" @checked(in_array($value, old('tujuan_pinjaman', $usaha->tujuan_pinjaman ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Tidak Menerima Kredit/Pinjaman
                    </label>

                    <select name="tidak_menerima_kredit" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($tidakMenerimaKredit as $value => $label)
                            <option value="{{ $value }}" @selected(old('tidak_menerima_kredit', $usaha->tidak_menerima_kredit ?? '') == $value)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-3">
                        Kendala Usaha
                    </label>

                    <div class="space-y-2">

                        @foreach ($kendalaUsaha as $value => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="kendala_usaha"
                                    data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="kendala_usaha[]"
                                    value="{{ $value }}" @checked(in_array($value, old('kendala_usaha', $usaha->kendala_usaha ?? [])))>

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

        <form action="{{ route('admin.usaha.destroy', $tempat) }}" method="POST"
            onsubmit="return confirm('Hapus data usaha?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="px-5 py-3 rounded-xl bg-red-600 text-white">

                Hapus Data Usaha

            </button>

        </form>

    </div>
@endsection

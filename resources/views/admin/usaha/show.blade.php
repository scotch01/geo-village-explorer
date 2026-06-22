@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl bg mx-auto space-y-8 animate-fade-in px-2 sm:px-0">

        <x-back-button :href="route('admin.usaha.index', $tempat)">
            Kembali
        </x-back-button>

        <!-- HEADER HALAMAN -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="text-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Detail Data BLOK III
            </h1>
            <h3 class="text-sm lg:text-base font-medium text-slate-700 tracking-tight">
                Keterangan Usaha/Perusahaan
            </h3>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">

            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900">
                    I. Alamat & Nama Usaha
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <div>
                    <span class="text-sm font-bold text-slate-500">
                        1. Provinsi
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->provinsi ?: '-' }}
                    </p>
                </div>

                <div>
                    <span class="text-sm font-bold text-slate-500">
                        2. Kabupaten/Kota
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->kabupaten ?: '-' }}
                    </p>
                </div>

                <div>
                    <span class="text-sm font-bold text-slate-500">
                        3. Kecamatan
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->kecamatan ?: '-' }}
                    </p>
                </div>

                <div>
                    <span class="text-sm font-bold text-slate-500">
                        4. Desa / Kelurahan
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->desa ?: '-' }}
                    </p>
                </div>

                <div>
                    <span class="text-sm font-bold text-slate-500">
                        5. Dusun
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->dusun ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        6. Alamat Detail / Jalan / No. Rumah
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->alamat ?: '-' }}
                    </p>
                </div>

            </div>

            <div class="mt-6 border-t border-slate-100 pt-6">

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        7. Nama Usaha / Perusahaan
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->nama_usaha ?: '-' }}
                    </p>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900">
                    II. Kontak Usaha
                </h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        8. Telepon/Hp
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->telepon ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        9. Email
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->email ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        10. Website/akun media sosial
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $usaha->website ?: '-' }}
                    </p>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900">
                    III. Karakteristik & Identitas Pemilik
                </h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        12. Dimana lokasi tepat usaha/perusahaan?
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $lokasiUsaha[$usaha->lokasi_usaha] ?? '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        13. Status kepemilikan bangunan
                    </span>

                    <p class="font-semibold text-slate-800">
                        {{ $statusBangunan[$usaha->status_bangunan] ?? '-' }}
                    </p>
                </div>
            </div>

            <div class="space-y-1 mt-8">
                <span class="text-sm font-bold text-slate-500">
                    14. Identitas pemilik usaha/perusahaan
                </span>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-3">

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        a. Nama
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->nama_pemilik ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        b. NIK
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->nik_pemilik ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        c. Jenis Kelamin
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $jenisKelamin[$usaha->jenis_kelamin_pemilik] ?? '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        d. Tanggal Lahir
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->tanggal_lahir_pemilik ? \Carbon\Carbon::parse($usaha->tanggal_lahir_pemilik)->format('d-m-Y') : '-' }}

                        @if ($usaha->umur_pemilik)
                            <span class="text-sm font-bold text-slate-500">
                                ({{ $usaha->umur_pemilik }} Tahun)
                            </span>
                        @endif
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        e. Ijazah/STTB tertinggi yang dimiliki
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $pendidikan[$usaha->ijazah_pemilik] ?? '-' }}
                    </p>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900">
                    IV. Aktivitas Operasional & Legalitas
                </h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        15. Apa Kegiatan Utama dari usaha ini? <p class="italic">(Tuliskan selengkapnya)</p>
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->kegiatan_utama ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        16. Apa Produk Utama yang dihasilkan? <p class="italic">(Tuliskan selengkapnya)</p>
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->produk_utama ?: '-' }}
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        17. Kategori lapangan usaha
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->kategori_lapangan_usaha ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        18. Kode KBLI 2025
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->kbli ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        19. Tahun mulai beroperasi
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->tahun_mulai ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        20. Apa saja ijin usaha/sertifikat usaha yang dimiliki usaha/perusahaan?
                    </span>
                    @php
                        $izin = collect($usaha->izin_usaha ?? [])
                            ->map(fn($item) => $izinUsaha[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $izin ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        21. Bentuk Badan Usaha/Badan Hukum
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $badanUsaha[$usaha->bentuk_badan_usaha] ?? '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900">
                    V. Ketenagakerjaan, Upah, dan Pendapatan
                </h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        22a. Berapa jumlah pekerja dibayar? (orang)
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->jumlah_pekerja_dibayar ?: '-' }} Orang
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        22b. Berapa total upah/gaji yang dibayarkan sebulan terakhir?
                    </span>
                    <p class="font-semibold text-slate-800">
                        Rp. {{ number_format($usaha->total_upah_bulanan ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        22c. Berapa jumlah pekerja tidak dibayar/pekerja keluarga (termasuk pemilik)?
                    </span>
                    <p class="font-semibold text-slate-800">
                        {{ $usaha->jumlah_pekerja_tidak_dibayar ?: '-' }} Orang
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        23a. Berapa nilai
                        produksi/pendapatan/penjualan sebulan terakhir atau bulan terakhir beroperasi?,
                    </span>
                    <p class="font-semibold text-slate-800">
                        Rp. {{ number_format($usaha->pendapatan_bulanan ?? 0, 0, ',', '.') }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        23b. Berapa nilai
                        produksi/pendapatan/penjualan selama tahun 2025?,
                    </span>
                    <p class="font-semibold text-slate-800">
                        Rp. {{ number_format($usaha->pendapatan_tahunan ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900">
                    VI. Pemanfaatan Internet Untuk Usaha
                </h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        24. Apakah menggunakan internet dalam menjalankan usaha selama setahun terakhir?
                    </span>
                    @php
                        $penggunaanInternet = collect($usaha->penggunaan_internet ?? [])
                            ->map(fn($item) => $penggunaanInternet[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $penggunaanInternet ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        25. Media internet apa saja yang
                        digunakan untuk usaha selama setahun terakhir?
                    </span>
                    @php
                        $mediaInternet = collect($usaha->media_internet ?? [])
                            ->map(fn($item) => $mediaInternet[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $mediaInternet ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        26. Jika tidak menggunakan internet, apa
                        alasannya?
                    </span>
                    @php
                        $tidakPenggunaanInternet = collect($usaha->alasan_tidak_internet ?? [])
                            ->map(fn($item) => $tidakPenggunaanInternet[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $tidakPenggunaanInternet ?: '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900">
                    VII. Akses Permodalan & Kendala
                    Usaha
                </h2>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        27. Apakah usaha/perusahaan ini
                        menerima kredit atau pinjaman dari lembaga berikut?
                    </span>
                    @php
                        $sumberPinjaman = collect($usaha->sumber_pinjaman ?? [])
                            ->map(fn($item) => $sumberPinjaman[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $sumberPinjaman ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        28. Jika menerima kredit/pinjaman,
                        untuk apa pinjaman tersebut digunakan?
                    </span>
                    @php
                        $tujuanPinjaman = collect($usaha->tujuan_pinjaman ?? [])
                            ->map(fn($item) => $tujuanPinjaman[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $tujuanPinjaman ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        29. Jika tidak menerima kredit atau
                        pinjaman, apa alasan utamanya?,
                    </span>
                    @php
                        $tidakMenerimaKredit = collect($usaha->tidak_menerima_kredit ?? [])
                            ->map(fn($item) => $tidakMenerimaKredit[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $tidakMenerimaKredit ?: '-' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500">
                        30. Kendala/kesulitan yang dialami
                        oleh usaha/perusahaan selama setahun yang lalu:
                    </span>
                    @php
                        $kendalaUsaha = collect($usaha->kendala_usaha ?? [])
                            ->map(fn($item) => $kendalaUsaha[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800">
                        {{ $kendalaUsaha ?: '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">

            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>

                <h2 class="font-black text-lg text-slate-900">
                    VIII. Lokasi Usaha
                </h2>
            </div>

            @if ($usaha->lokasi_sama_dengan_keluarga)
                <div
                    class="mb-6 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-medium">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                    </svg>

                    Lokasi usaha mengikuti lokasi keluarga

                </div>
            @endif

            <x-geo-location latitude-field="latitude_usaha" longitude-field="longitude_usaha"
                accuracy-field="akurasi_usaha" :latitude-value="$usaha->latitude_usaha" :longitude-value="$usaha->longitude_usaha" :accuracy-value="$usaha->akurasi_usaha" readonly />

        </div>

        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">

            <div class="text-center md:text-left">
                <p class="text-lg md:text-xl font-bold text-slate-800">Lakukan Perubahan?</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-end gap-3 w-full md:w-auto">

                @if (auth()->user()->isMasterAdmin() || auth()->user()->canEditTempat($usaha->tempat))
                    <form method="POST" action="{{ route('admin.usaha.destroy', $usaha) }}" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus permanen data usaha ini?')"
                            class="w-full sm:w-auto px-6 py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-rose-600/10 text-center">
                            Hapus Data
                        </button>
                    </form>
                @else
                    <button disabled
                        class="px-6 py-3.5 bg-gray-200 text-gray-500 font-bold rounded-2xl cursor-not-allowed">
                        Hapus Data
                    </button>
                @endif

                @if (auth()->user()->canEditTempat($usaha->tempat))
                    <a href="{{ route('admin.usaha.edit', $usaha) }}"
                        class="w-full sm:w-auto px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-amber-500/10 text-center">
                        Edit Data
                    </a>
                @else
                    <button disabled
                        class="px-6 py-3.5 bg-gray-200 text-gray-500 font-bold rounded-2xl cursor-not-allowed">
                        Edit Data
                    </button>
                @endif

            </div>

        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6 pb-12">

        {{-- Header --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="text-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Perbarui Data BLOK III
            </h1>
            <p class="text-sm lg:text-base font-medium text-slate-700 mt-1">Silakan perbarui data kuisioner usaha/perusahaan
                di
                bawah ini secara teliti.</p>
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

        {{-- Form Main --}}
        <form x-data="{
            sameAddress: {{ $tempat->jenis_bangunan === 'bc' ? 'true' : 'false' }},
            sameLocation: {{ old('lokasi_sama_dengan_keluarga', $usaha->lokasi_sama_dengan_keluarga) ? 'true' : 'false' }},
            internetTidakDigunakan: false,
            pinjamanTidakDiterima: false,
        
            keluarga: {
                provinsi: @js($keluarga?->provinsi ?? ''),
                kabupaten: @js($keluarga?->kabupaten ?? ''),
                kecamatan: @js($keluarga?->kecamatan ?? ''),
                desa: @js($keluarga?->desa ?? ''),
                dusun: @js($keluarga?->dusun ?? ''),
                alamat: @js($keluarga?->alamat_detail ?? '')
            },
        
            familyLocation: {
                latitude: @js($keluarga?->latitude_rumah),
                longitude: @js($keluarga?->longitude_rumah),
                accuracy: @js($keluarga?->akurasi_rumah),
            },
        
            usaha: {
                provinsi: '{{ old('provinsi', $usaha->provinsi) }}',
                kabupaten: '{{ old('kabupaten', $usaha->kabupaten) }}',
                kecamatan: '{{ old('kecamatan', $usaha->kecamatan) }}',
                desa: '{{ old('desa', $usaha->desa) }}',
                dusun: '{{ old('dusun', $usaha->dusun) }}',
                alamat: '{{ old('alamat', $usaha->alamat) }}'
            },
        
            checkInternet() {
        
                const checkboxX = document.querySelector(
                    'input[name=\'penggunaan_internet[]\'][value=\'X\']'
                );
        
                this.internetTidakDigunakan =
                    checkboxX?.checked ?? false;
        
                if (!this.internetTidakDigunakan) {
        
                    document
                        .querySelectorAll(
                            'input[name=\'alasan_tidak_internet[]\']'
                        )
                        .forEach(el => el.checked = false);
        
                }
            },
        
            checkPinjaman() {
        
                const checkboxX = document.querySelector(
                    'input[name=\'sumber_pinjaman[]\'][value=\'X\']'
                );
        
                this.pinjamanTidakDiterima =
                    checkboxX?.checked ?? false;
        
                if (this.pinjamanTidakDiterima) {
        
                    document
                        .querySelectorAll(
                            'input[name=\'tujuan_pinjaman[]\']'
                        )
                        .forEach(el => el.checked = false);
        
                } else {
        
                    const alasanSelect = document.querySelector(
                        'select[name=\'tidak_menerima_kredit\']'
                    );
        
                    if (alasanSelect) {
                        alasanSelect.value = '';
                    }
                }
            },
        
            toggleLocation() {
        
                window.dispatchEvent(
                    new CustomEvent(
                        'toggle-family-location', {
                            detail: {
                                enabled: this.sameLocation,
                                latitude: this.familyLocation.latitude,
                                longitude: this.familyLocation.longitude,
                                accuracy: this.familyLocation.accuracy,
                            }
                        }
                    )
                );
            },
        }" x-init="checkInternet();
        checkPinjaman();
        if (sameLocation) {
            toggleLocation();
        }" action="{{ route('admin.usaha.update', $usaha) }}" method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')

            <input type="hidden" name="lokasi_sama_dengan_keluarga" :value="sameLocation ? 1 : 0">

            {{-- BLOK I: Alamat & Nama Usaha --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-6">
                <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900">
                        I. Alamat & Nama Usaha
                    </h2>
                </div>
                @if ($tempat->jenis_bangunan === 'bc')
                    <label
                        class="inline-flex items-center gap-2.5 px-4 py-3 bg-blue-50/50 border border-blue-100 rounded-xl cursor-pointer select-none w-full md:w-auto transition hover:bg-blue-50">
                        <input type="checkbox" x-model="sameAddress"
                            class="rounded text-blue-600 focus:ring-blue-500 w-4 h-4 border-gray-300">
                        <span class="text-sm font-medium text-blue-800">Alamat usaha sama dengan alamat keluarga</span>
                    </label>
                @endif

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">1. Provinsi</label>
                        <input type="text" name="provinsi" x-model="sameAddress ? keluarga.provinsi : usaha.provinsi"
                            x-bind:readonly="sameAddress"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm read-only:bg-gray-50 read-only:text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">2. Kabupaten / Kota</label>
                        <input type="text" name="kabupaten" x-model="sameAddress ? keluarga.kabupaten : usaha.kabupaten"
                            x-bind:readonly="sameAddress"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm read-only:bg-gray-50 read-only:text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">3. Kecamatan</label>
                        <input type="text" name="kecamatan" x-model="sameAddress ? keluarga.kecamatan : usaha.kecamatan"
                            x-bind:readonly="sameAddress"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm read-only:bg-gray-50 read-only:text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">4. Desa / Kelurahan</label>
                        <input type="text" name="desa" x-model="sameAddress ? keluarga.desa : usaha.desa"
                            x-bind:readonly="sameAddress"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm read-only:bg-gray-50 read-only:text-gray-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">5. Dusun</label>
                        <select name="dusun" x-model="sameAddress ? keluarga.dusun : usaha.dusun"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm"
                            :class="{
                                'bg-gray-50 text-gray-500 pointer-events-none': sameAddress
                            }">

                            <option value="">
                                Pilih Dusun
                            </option>

                            @foreach ($dusuns as $dusun)
                                <option value="{{ $dusun }}">
                                    {{ $dusun }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">6. Alamat Detail / Jalan / No.
                        Rumah</label>
                    <textarea name="alamat" x-model="sameAddress ? keluarga.alamat : usaha.alamat" x-bind:readonly="sameAddress"
                        rows="2"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm read-only:bg-gray-50 read-only:text-gray-500"></textarea>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">7. Nama Usaha / Perusahaan</label>
                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $usaha->nama_usaha) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm">
                </div>
            </div>

            {{-- BLOK II: Kontak Usaha --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900">
                        II. Kontak Usaha
                    </h2>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">8. Nomor Telepon / HP</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $usaha->telepon) }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">9. E-mail</label>
                        <input type="email" name="email" value="{{ old('email', $usaha->email) }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">10. Website / Akun Media Sosial</label>
                    <input type="text" name="website" value="{{ old('website', $usaha->website) }}"
                        placeholder="Contoh: www.tokoanda.com, @instagram_usaha"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition text-sm">
                </div>
            </div>

            {{-- BLOK III: Identitas Bangunan & Pemilik --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-6">
                <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900">
                        III. Karakteristik & Identitas
                        Pemilik
                    </h2>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">12. Dimana lokasi tepat
                            usaha/perusahaan</label>
                        <select name="lokasi_usaha"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Pilih Lokasi</option>
                            @foreach ($lokasiUsaha as $value => $label)
                                <option value="{{ $value }}" @selected(old('lokasi_usaha', $usaha->lokasi_usaha) == $value)>

                                    {{ $label }}

                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">13. Status Kepemilikan
                            Bangunan</label>
                        <select name="status_bangunan"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Pilih Status</option>
                            @foreach ($statusBangunan as $value => $label)
                                <option value="{{ $value }}" @selected(old('status_bangunan', $usaha->status_bangunan) == $value)>

                                    {{ $label }}

                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 space-y-4">
                    <label class="block text-sm font-semibold text-gray-800">14. Identitas pemilik usaha/perusahaan</label>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">a. Nama</label>
                            <input type="text" name="nama_pemilik"
                                value="{{ old('nama_pemilik', $usaha->nama_pemilik) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">b. NIK</label>
                            <input type="text" name="nik_pemilik" maxlength="16"
                                value="{{ old('nik_pemilik', $usaha->nik_pemilik) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">c. Jenis Kelamin</label>
                            <select name="jenis_kelamin_pemilik"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">Pilih</option>
                                @foreach ($jenisKelamin as $key => $label)
                                    <option value="{{ $key }}" @selected(old('jenis_kelamin_pemilik', $usaha->jenis_kelamin_pemilik) == $key)>

                                        {{ $label }}

                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">d. Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir_pemilik" max="{{ now()->format('Y-m-d') }}"
                                value="{{ old('tanggal_lahir_pemilik', $usaha->tanggal_lahir_pemilik) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">f. Ijazah/STTB tertinggi yang
                            dimiliki</label>
                        <select name="ijazah_pemilik"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Pilih Pendidikan</option>
                            @foreach ($pendidikan as $key => $label)
                                <option value="{{ $key }}" @selected(old('ijazah_pemilik', $usaha->ijazah_pemilik) == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- BLOK IV: Aktivitas Operasional & KBLI --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900">
                        IV. Aktivitas Operasional &
                        Legalitas
                    </h2>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">15. Apa Kegiatan Utama dari usaha
                            ini?,<span class="text-xs text-gray-400 italic">(Tulis secara lengkap)</span></label>
                        <textarea name="kegiatan_utama" rows="3" placeholder="Contoh: Perdagangan eceran pakaian jadi muslimah..."
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('kegiatan_utama', $usaha->kegiatan_utama) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">16. Apa produk utama yang dihasilkan,
                            <span class="text-xs text-gray-400 italic">(Tulis secara lengkap)</span></label>
                        <textarea name="produk_utama" rows="3" placeholder="Contoh: Gamis wanita, kerudung, mukena..."
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('produk_utama', $usaha->produk_utama) }}</textarea>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4 border-t border-gray-100 pt-4">
                    <div class="md:col-span-2 grid grid-cols-2 gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="flex flex-col">
                            <label class="text-xs font-semibold text-gray-500 h-8 flex items-end mb-1">
                                17. Kategori Lapangan Usaha
                            </label>
                            @if (auth()->user()->isMasterAdmin() || auth()->user()->isPengawas())
                                <input type="text" name="kategori_lapangan_usaha"
                                    value="{{ old('kategori_lapangan_usaha', $usaha->kategori_lapangan_usaha) }}"
                                    placeholder="Oleh Pengawas BPS"
                                    class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-500 text-xs font-medium cursor-not-allowed lg:placeholder:text-xs placeholder:text-[10px]">
                            @else
                                <input type="text" name="kategori_lapangan_usaha"
                                    value="{{ old('kategori_lapangan_usaha', $usaha->kategori_lapangan_usaha) }}"
                                    placeholder="Oleh Pengawas BPS" readonly
                                    class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-500 text-xs font-medium cursor-not-allowed lg:placeholder:text-xs placeholder:text-[10px]">
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <label class="text-xs font-semibold text-gray-500 h-8 flex items-end mb-1">
                                18. Kode KBLI 2020
                            </label>

                            @if (auth()->user()->isMasterAdmin() || auth()->user()->isPengawas())
                                <input type="text" name="kbli" value="{{ old('kbli') }}"
                                    placeholder="Oleh Pengawas BPS"
                                    class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-500 text-xs font-medium cursor-not-allowed lg:placeholder:text-xs placeholder:text-[10px]">
                            @else
                                <input type="text" name="kbli" value="{{ old('kbli') }}" readonly
                                    placeholder="Oleh Pengawas BPS"
                                    class="w-full rounded-lg border-gray-200 bg-gray-100 text-gray-500 text-xs font-medium cursor-not-allowed lg:placeholder:text-xs placeholder:text-[10px]">
                            @endif
                        </div>

                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">19. Tahun Mulai Beroperasi</label>
                        <input type="number" name="tahun_mulai" min="1900" max="{{ now()->year }}"
                            value="{{ old('tahun_mulai', $usaha->tahun_mulai) }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 border-t border-gray-100 pt-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">20. Apa saja ijin usaha/sertifikat
                            usaha yang dimiliki usaha/perusahaan?</label>
                        <div class="space-y-2 bg-slate-50/50 p-4 rounded-xl border border-gray-100">
                            @foreach ($izinUsaha as $value => $label)
                                <label
                                    class="flex items-start gap-2.5 text-sm font-medium text-gray-700 cursor-pointer select-none">
                                    <input type="checkbox"
                                        class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500 mt-0.5"
                                        data-group="izin_usaha" data-exclusive="{{ $value === 'X' ? '1' : '0' }}"
                                        name="izin_usaha[]" value="{{ $value }}" @checked(in_array($value, old('izin_usaha', $usaha->izin_usaha ?? [])))>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">21. Bentuk Badan Usaha / Badan
                            Hukum</label>
                        <select name="bentuk_badan_usaha"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Pilih Bentuk Hukum</option>
                            @foreach ($badanUsaha as $value => $label)
                                <option value="{{ $value }}" @selected(old('bentuk_badan_usaha', $usaha->bentuk_badan_usaha) == $value)>

                                    {{ $label }}

                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- BLOK V: Ketenagakerjaan & Keuangan --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900">
                        V. Ketenagakerjaan, Upah, dan
                        Pendapatan
                    </h2>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">22a. Berapa jumlah pekerja dibayar?,
                            (orang)</label>
                        <input type="number" min="0" name="jumlah_pekerja_dibayar"
                            value="{{ old('jumlah_pekerja_dibayar', $usaha->jumlah_pekerja_dibayar, 0) }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">22b. Berapa total upah/gaji yang
                            dibayarkan sebulan terakhir?,(Ribuan Rp: 000)</label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">Rp</span>
                            </div>
                            <input type="number" min="0" step="1" name="total_upah_bulanan"
                                value="{{ old('total_upah_bulanan', $usaha->total_upah_bulanan, 0) }}"
                                class="w-full pl-9 pr-12 rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-50 my-2 pt-2">
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">22c. Berapa jumlah pekerja tidak
                        dibayar/pekerja keluarga (termasuk pemilik)?, (Orang)</label>
                    <input type="number" min="0" name="jumlah_pekerja_tidak_dibayar"
                        value="{{ old('jumlah_pekerja_tidak_dibayar', $usaha->jumlah_pekerja_tidak_dibayar, 0) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>

                <div class="grid md:grid-cols-2 gap-4 border-t border-gray-100 pt-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">23a. Berapa nilai
                            produksi/pendapatan/penjualan sebulan terakhir atau bulan terakhir beroperasi?, (Ribuan Rp:
                            000)</label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">Rp</span>
                            </div>
                            <input type="number" min="0" step="1" name="pendapatan_bulanan"
                                value="{{ old('pendapatan_bulanan', $usaha->pendapatan_bulanan, 0) }}"
                                class="w-full pl-9 pr-12 rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">23b. Berapa nilai
                            produksi/pendapatan/penjualan selama tahun 2025?, (Ribuan Rp: 000)</label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">Rp</span>
                            </div>
                            <input type="number" min="0" step="1" name="pendapatan_tahunan"
                                value="{{ old('pendapatan_tahunan', $usaha->pendapatan_tahunan, 0) }}"
                                class="w-full pl-9 pr-12 rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>
                </div>
            </div>

            {{-- BLOK VI: Pemanfaatan Internet --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-6">
                <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900">
                        VII. Akses Permodalan & Kendala
                        Usaha
                    </h2>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">24. Apakah menggunakan internet dalam
                            menjalankan usaha selama setahun terakhir?</label>
                        <div class="space-y-2 bg-slate-50/50 p-4 rounded-xl border border-gray-100">
                            @foreach ($penggunaanInternet as $value => $label)
                                <label
                                    class="flex items-start gap-2.5 text-sm font-medium text-gray-700 cursor-pointer select-none">
                                    <input type="checkbox"
                                        class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500 mt-0.5"
                                        @change="checkInternet()" data-group="penggunaan_internet"
                                        data-exclusive="{{ $value == 'X' ? '1' : '0' }}" name="penggunaan_internet[]"
                                        value="{{ $value }}" @checked(in_array($value, old('penggunaan_internet', $usaha->penggunaan_internet ?? [])))>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">25. Media internet apa saja yang
                            digunakan untuk usaha selama setahun terakhir?</label>
                        <div class="space-y-2 bg-slate-50/50 p-4 rounded-xl border border-gray-100">
                            @foreach ($mediaInternet as $value => $label)
                                <label
                                    class="flex items-start gap-2.5 text-sm font-medium text-gray-700 cursor-pointer select-none">
                                    <input type="checkbox"
                                        class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500 mt-0.5"
                                        data-group="media_internet" data-exclusive="{{ $value == 'X' ? '1' : '0' }}"
                                        name="media_internet[]" value="{{ $value }}"
                                        @checked(in_array($value, old('media_internet', $usaha->media_internet ?? [])))>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <label class="block text-sm font-semibold text-gray-800 mb-3">26. Jika tidak menggunakan internet, apa
                        alasannya?</label>
                    <div class="grid sm:grid-cols-2 gap-2 bg-slate-50/50 p-4 rounded-xl border border-gray-100 transition"
                        :class="{ 'opacity-40 pointer-events-none bg-gray-100': !internetTidakDigunakan }">
                        @foreach ($tidakPenggunaanInternet as $value => $label)
                            <label
                                class="flex items-start gap-2.5 text-sm font-medium text-gray-700 cursor-pointer select-none">
                                <input type="checkbox" :disabled="!internetTidakDigunakan"
                                    class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500 mt-0.5"
                                    data-group="alasan_tidak_internet" data-exclusive="{{ $value == 'X' ? '1' : '0' }}"
                                    name="alasan_tidak_internet[]" value="{{ $value }}"
                                    @checked(in_array($value, old('alasan_tidak_internet', $usaha->alasan_tidak_internet ?? [])))>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- BLOK VII: Pembiayaan & Kendala --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-6">
                <h2 class="font-bold text-gray-900 text-lg border-b border-gray-100 pb-2">VII. Akses Permodalan & Kendala
                    Usaha</h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">27. Apakah usaha/perusahaan ini
                            menerima kredit atau pinjaman dari lembaga berikut?</label>
                        <div class="space-y-2 bg-slate-50/50 p-4 rounded-xl border border-gray-100">
                            @foreach ($sumberPinjaman as $value => $label)
                                <label
                                    class="flex items-start gap-2.5 text-sm font-medium text-gray-700 cursor-pointer select-none">
                                    <input type="checkbox" @change="checkPinjaman()"
                                        class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500 mt-0.5"
                                        data-group="sumber_pinjaman" data-exclusive="{{ $value == 'X' ? '1' : '0' }}"
                                        name="sumber_pinjaman[]" value="{{ $value }}"
                                        @checked(in_array($value, old('sumber_pinjaman', $usaha->sumber_pinjaman ?? [])))>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">28. Jika menerima kredit/pinjaman,
                            untuk apa pinjaman tersebut digunakan?</label>
                        <div class="space-y-2 bg-slate-50/50 p-4 rounded-xl border border-gray-100"
                            :class="{
                                'opacity-40 pointer-events-none bg-gray-100': pinjamanTidakDiterima
                            }">
                            @foreach ($tujuanPinjaman as $value => $label)
                                <label
                                    class="flex items-start gap-2.5 text-sm font-medium text-gray-700 cursor-pointer select-none">
                                    <input type="checkbox" :disabled="pinjamanTidakDiterima"
                                        class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500 mt-0.5"
                                        data-group="tujuan_pinjaman" data-exclusive="{{ $value == 'X' ? '1' : '0' }}"
                                        name="tujuan_pinjaman[]" value="{{ $value }}"
                                        @checked(in_array($value, old('tujuan_pinjaman', $usaha->tujuan_pinjaman ?? [])))>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-6 border-t border-gray-100 pt-4">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">29. Jika tidak menerima kredit atau
                            pinjaman, apa alasan utamanya?,</label>
                        <select name="tidak_menerima_kredit" :disabled="!pinjamanTidakDiterima"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                            :class="{
                                'bg-gray-100 text-gray-500':
                                    !pinjamanTidakDiterima
                            }">
                            <option value="">Pilih Alasan</option>
                            @foreach ($tidakMenerimaKredit as $value => $label)
                                <option value="{{ $value }}" @selected(old('tidak_menerima_kredit', $usaha->tidak_menerima_kredit) == $value)>

                                    {{ $label }}

                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">30. Kendala/kesulitan yang dialami
                            oleh usaha/perusahaan selama setahun yang lalu:</label>
                        <div class="grid sm:grid-cols-2 gap-2 bg-slate-50/50 p-4 rounded-xl border border-gray-100">
                            @foreach ($kendalaUsaha as $value => $label)
                                <label
                                    class="flex items-start gap-2.5 text-sm font-medium text-gray-700 cursor-pointer select-none">
                                    <input type="checkbox"
                                        class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500 mt-0.5"
                                        data-group="kendala_usaha" data-exclusive="{{ $value == 'X' ? '1' : '0' }}"
                                        name="kendala_usaha[]" value="{{ $value }}" @checked(in_array($value, old('kendala_usaha', $usaha->kendala_usaha ?? [])))>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-6">

                <div class="flex items-center gap-4 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>

                    <h2 class="font-black text-lg text-slate-900">
                        VIII. Tagging Lokasi Usaha
                    </h2>
                </div>

                @if ($tempat->jenis_bangunan === 'bc')
                    <label
                        class="inline-flex items-center gap-2.5 px-4 py-3 bg-blue-50 border border-blue-100 rounded-xl cursor-pointer">

                        <input type="checkbox" x-model="sameLocation" @change="toggleLocation()"
                            class="rounded text-blue-600">

                        <span class="text-sm font-medium text-blue-800">
                            Lokasi usaha sama dengan lokasi keluarga
                        </span>

                    </label>
                @endif

                <x-geo-location latitude-field="latitude_usaha" longitude-field="longitude_usaha"
                    accuracy-field="akurasi_usaha" :latitude-value="$usaha->latitude_usaha" :longitude-value="$usaha->longitude_usaha" :accuracy-value="$usaha->akurasi_usaha" />

            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-6">

                {{-- Action Submit --}}
                <div class="flex items-center justify-end gap-3 border-t-2 border-gray-300 pt-4">
                    <a href="{{ route('admin.usaha.show', $usaha) }}"
                        class="px-6 py-2.5 border rounded-xl text-gray-700 hover:bg-gray-50 transition-all active:scale-95 ">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold transition-all active:scale-95 shadow-md shadow-amber-500/20 text-sm text-center">
                        Simpan Perubahan
                    </button>
                </div>

            </div>

        </form>
    </div>

    {{-- Native JavaScript for Exclusive Checkbox Toggles --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.exclusive-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const group = this.getAttribute('data-group');
                    const isExclusive = this.getAttribute('data-exclusive') === '1';

                    if (this.checked) {
                        document.querySelectorAll(`.exclusive-checkbox[data-group="${group}"]`)
                            .forEach(el => {
                                if (isExclusive && el !== this) {
                                    el.checked = false;
                                } else if (!isExclusive && el.getAttribute('data-exclusive') ===
                                    '1') {
                                    el.checked = false;
                                }
                            });
                    }
                });
            });
        });
    </script>
@endsection

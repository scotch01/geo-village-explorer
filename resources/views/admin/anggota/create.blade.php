@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="ttext-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Tambah Data Anggota Keluarga
            </h1>
            <p class="text-sm lg:text-base font-medium text-slate-700 mt-1">Silakan lengkapi kuisioner keterangan anggota
                keluarga di bawah ini secara teliti.</p>
        </div>

        <form x-data="anggotaForm()" x-init="init()" @profesi-selected.window="checkProfesi($event.detail.kode)"
            method="POST" action="{{ route('admin.anggota.store', $keluarga) }}" class="space-y-6">
            @csrf

            <div class="bg-white rounded-2xl border p-6 space-y-5 shadow-sm">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-2 h-8 rounded-full bg-blue-600"></div>
                    <div>
                        <h2 class="font-black text-xl text-slate-900 tracking-tight">
                            BLOK II
                        </h2>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                            KETERANGAN ANGGOTA KELUARGA
                        </p>
                    </div>
                </div>

                {{-- 5. Nomor Urut --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        5. Nomor Urut Anggota Keluarga
                    </label>
                    <input type="number" name="nomor_urut" min="1" value="{{ $nextNomorUrut }}" readonly"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('nomor_urut')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 6. Nama --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        6. Nama Anggota Keluarga
                    </label>
                    <input type="text" x-model="nama" name="nama" value="{{ old('nama') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 7. NIK --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        7. Nomor Induk Kependudukan (NIK)
                    </label>
                    <input type="text" maxlength="16" name="nik" value="{{ old('nik') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('nik')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 8. Hubungan Keluarga --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        8. Hubungan <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span> dengan Kepala Keluarga
                    </label>
                    <select name="hubungan_keluarga"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($hubunganKeluarga as $key => $label)
                            @if ($key == 1 && $sudahAdaKepalaKeluarga)
                                @continue
                            @endif
                            <option value="{{ $key }}" @selected(old('hubungan_keluarga') == $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('hubungan_keluarga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 9. Status Perkawinan --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        9. Status Perkawinan <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span>
                    </label>
                    <select name="status_perkawinan"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($statusPerkawinan as $key => $label)
                            <option value="{{ $key }}" @selected(old('status_perkawinan') == $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_perkawinan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 10. Tanggal Lahir --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        10. Tanggal Lahir <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span>
                    </label>
                    <input type="date" x-model="tanggalLahir" @change="hitungUmur()" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 cursor-pointer"
                        onclick="this.showPicker()">
                    @error('tanggal_lahir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Umur <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span>
                    </label>

                    <input type="text" x-model="umur" readonly
                        class="w-full rounded-xl border-gray-300 bg-gray-100 text-gray-500">
                </div>

                {{-- 11. Jenis Kelamin --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        11. Jenis Kelamin <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span>
                    </label>
                    <select name="jenis_kelamin"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($jenisKelamin as $key => $label)
                            <option value="{{ $key }}" @selected(old('jenis_kelamin') == $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_kelamin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="bg-white rounded-2xl border p-6 space-y-5 shadow-sm">

                {{-- 12. Partisipasi Sekolah --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        12. Partisipasi Sekolah <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span>
                    </label>
                    <select name="partisipasi_sekolah"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        :disabled="umur < 5"
                        :class="{
                            'bg-gray-100 text-gray-500': umur < 5
                        }">
                        <option value="">Pilih</option>
                        @foreach ($partisipasiSekolah as $key => $label)
                            <option value="{{ $key }}" @selected(old('partisipasi_sekolah') == $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('partisipasi_sekolah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 13. Ijazah Tertinggi --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        13. Ijazah/STTB tertinggi yang dimiliki <span class="font-bold"
                            x-text="nama || 'anggota keluarga ini'">
                        </span>
                    </label>
                    <select name="ijazah_tertinggi"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        :disabled="umur < 5"
                        :class="{
                            'bg-gray-100 text-gray-500': umur < 5
                        }">
                        <option value="">Pilih</option>
                        @foreach ($pendidikan as $key => $label)
                            <option value="{{ $key }}" @selected(old('ijazah_tertinggi') == $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('ijazah_tertinggi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 14. Profesi Pekerjaan Utama (Autocomplete) --}}
                <div class="relative"
                    :class="{
                        'opacity-50 pointer-events-none': umur < 10
                    }">
                    <label class="block mb-2 font-medium text-gray-700">
                        14. Profesi Pekerjaan Utama <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span>
                    </label>
                    <input type="hidden" name="master_profesi_id" id="master_profesi_id"
                        value="{{ old('master_profesi_id') }}">
                    <input type="hidden" name="kode_profesi" id="kode_profesi" value="{{ old('kode_profesi') }}">
                    <input type="hidden" name="profesi_nama" id="profesi_nama" value="{{ old('profesi_nama') }}">

                    <input type="text" id="profesi_search" autocomplete="off" value="{{ old('profesi_nama') }}"
                        placeholder="Ketik kode atau nama profesi..."
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    <div id="profesi_results"
                        class="hidden absolute z-10 w-full mt-1 bg-white border rounded-xl shadow-lg max-h-60 overflow-y-auto">
                    </div>
                    @error('master_profesi_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 15. Status Kedudukan Pekerjaan --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        15. Status kedudukan <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span> dalam pekerjaan utama
                    </label>
                    <select name="status_pekerjaan"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        :disabled="umur < 10 ||
                            profesiTidakBekerja"
                        :class="{
                            'bg-gray-100 text-gray-500': umur < 10 ||
                                profesiTidakBekerja
                        }">
                        <option value="">Pilih</option>
                        @foreach ($kedudukanPekerjaan as $key => $label)
                            <option value="{{ $key }}" @selected(old('status_pekerjaan') == $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_pekerjaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 16. Rekening/Dompet Digital --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        16. Apakah <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span> memiliki rekening aktif atau dompet digital?
                    </label>
                    <select name="rekening_digital"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($rekeningAktif as $key => $label)
                            <option value="{{ $key }}" @selected(old('rekening_digital') == $key)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('rekening_digital')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="bg-white rounded-2xl border p-6 space-y-5 shadow-sm">

                {{-- 17. Disabilitas (Checkbox Group) --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        17. Apakah <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span> memiliki keterbatasan dalam jangka waktu lama sehingga mengalami kesulitan dalam
                        menjalankan aktivitas sehari-hari?
                    </label>
                    <div class="space-y-2 bg-slate-50 p-4 rounded-xl border border-dashed">
                        @foreach ($disabilitas as $key => $label)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox"
                                    class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500"
                                    data-group="disabilitas" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                    name="disabilitas[]" value="{{ $key }}" @checked(in_array($key, old('disabilitas', [])))>
                                <span class="text-gray-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('disabilitas')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 18. Penyakit Kronis (Checkbox Group) --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        18. Apakah <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span> memiliki keluhan kesehatan kronis/menahun?
                    </label>
                    <div class="space-y-2 bg-slate-50 p-4 rounded-xl border border-dashed">
                        @foreach ($penyakitKronis as $key => $label)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox"
                                    class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500"
                                    data-group="penyakit_kronis" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                    name="penyakit_kronis[]" value="{{ $key }}" @checked(in_array($key, old('penyakit_kronis', [])))>
                                <span class="text-gray-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('penyakit_kronis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 19. Jaminan Kesehatan (Checkbox Group) --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        19. Apakah <span class="font-bold" x-text="nama || 'anggota keluarga ini'">
                        </span> memiliki jaminan kesehatan?
                    </label>
                    <div class="space-y-2 bg-slate-50 p-4 rounded-xl border border-dashed">
                        @foreach ($jaminanKesehatan as $key => $label)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox"
                                    class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500"
                                    data-group="jaminan_kesehatan" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                    name="jaminan_kesehatan[]" value="{{ $key }}" @checked(in_array($key, old('jaminan_kesehatan', [])))>
                                <span class="text-gray-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('jaminan_kesehatan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Button --}}
                <div class="flex justify-end gap-3 border-t pt-5">
                    <a href="{{ route('admin.anggota.index', $keluarga) }}"
                        class="px-6 py-2.5 border rounded-xl text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl shadow-sm transition">
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function anggotaForm() {

                return {

                    nama: '',

                    tanggalLahir: @js(old('tanggal_lahir')),

                    umur: 0,

                    profesiTidakBekerja: false,

                    init() {

                        this.hitungUmur();

                    },

                    hitungUmur() {

                        if (!this.tanggalLahir) {

                            this.umur = 0;

                            return;
                        }

                        const lahir =
                            new Date(this.tanggalLahir);

                        const sekarang =
                            new Date();

                        let umur =
                            sekarang.getFullYear() -
                            lahir.getFullYear();

                        const bulan =
                            sekarang.getMonth() -
                            lahir.getMonth();

                        if (
                            bulan < 0 ||
                            (
                                bulan === 0 &&
                                sekarang.getDate() <
                                lahir.getDate()
                            )
                        ) {

                            umur--;

                        }

                        this.umur = umur;

                        this.applyRules();

                    },

                    applyRules() {

                        if (this.umur < 5) {

                            const partisipasiSekolah =
                                document.querySelector(
                                    '[name="partisipasi_sekolah"]'
                                );

                            const ijazahTertinggi =
                                document.querySelector(
                                    '[name="ijazah_tertinggi"]'
                                );

                            if (partisipasiSekolah) {
                                partisipasiSekolah.value = '';
                            }

                            if (ijazahTertinggi) {
                                ijazahTertinggi.value = '';
                            }
                        }

                        if (this.umur < 10) {

                            const masterProfesi =
                                document.querySelector(
                                    '#master_profesi_id'
                                );

                            const kodeProfesi =
                                document.querySelector(
                                    '#kode_profesi'
                                );

                            const profesiNama =
                                document.querySelector(
                                    '#profesi_nama'
                                );

                            const profesiSearch =
                                document.querySelector(
                                    '#profesi_search'
                                );

                            const statusPekerjaan =
                                document.querySelector(
                                    '[name="status_pekerjaan"]'
                                );

                            if (masterProfesi) {
                                masterProfesi.value = '';
                            }

                            if (kodeProfesi) {
                                kodeProfesi.value = '';
                            }

                            if (profesiNama) {
                                profesiNama.value = '';
                            }

                            if (profesiSearch) {
                                profesiSearch.value = '';
                            }

                            if (statusPekerjaan) {
                                statusPekerjaan.value = '';
                            }

                            this.profesiTidakBekerja = false;
                        }
                    },

                    checkProfesi(kode) {

                        this.profesiTidakBekerja =
                            kode === '000';

                        if (this.profesiTidakBekerja) {

                            const statusPekerjaan =
                                document.querySelector(
                                    '[name="status_pekerjaan"]'
                                );

                            if (statusPekerjaan) {
                                statusPekerjaan.value = '';
                            }
                        }
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                // --- 1. Logika Autocomplete Profesi ---
                const input = document.getElementById('profesi_search');
                const results = document.getElementById('profesi_results');
                const profesiId = document.getElementById('master_profesi_id');
                const kodeProfesi = document.getElementById('kode_profesi');
                const namaProfesiHidden = document.getElementById('profesi_nama');
                let timeout;

                input.addEventListener('input', () => {
                    clearTimeout(timeout);
                    const keyword = input.value.trim();

                    if (keyword.length < 2) {
                        results.innerHTML = '';
                        results.classList.add('hidden');
                        return;
                    }

                    timeout = setTimeout(async () => {
                        try {
                            const response = await fetch(
                                `/admin/master-profesi/search?q=${encodeURIComponent(keyword)}`);
                            const data = await response.json();
                            results.innerHTML = '';

                            if (!data.length) {
                                results.innerHTML =
                                    `<div class="px-4 py-3 text-gray-500 text-sm">Tidak ditemukan</div>`;
                                results.classList.remove('hidden');
                                return;
                            }

                            data.forEach(item => {
                                const option = document.createElement('button');
                                option.type = 'button';
                                option.className =
                                    'w-full text-left px-4 py-2 hover:bg-slate-50 border-b last:border-0 text-sm';
                                option.innerHTML = `
                                    <div class="font-medium text-gray-800">${item.nama}</div>
                                    <div class="text-xs text-gray-400">${item.kode}</div>
                                `;

                                option.addEventListener('click', () => {
                                    input.value = item.nama;
                                    profesiId.value = item.id;
                                    kodeProfesi.value = item.kode;
                                    window.dispatchEvent(
                                        new CustomEvent(
                                            'profesi-selected', {
                                                detail: {
                                                    kode: item.kode
                                                }
                                            }
                                        )
                                    );
                                    namaProfesiHidden.value = item
                                        .nama; // Simpan untuk old value handling
                                    results.classList.add('hidden');
                                });

                                results.appendChild(option);
                            });

                            results.classList.remove('hidden');
                        } catch (error) {
                            console.error('Error fetching profesi:', error);
                        }
                    }, 300);
                });

                // Tutup dropdown jika klik di luar area search
                document.addEventListener('click', (event) => {
                    if (!input.contains(event.target) && !results.contains(event.target)) {
                        results.classList.add('hidden');
                    }
                });


                // --- 2. Logika Exclusive Checkbox (Disabilitas, Kronis, Jaminan) ---
                const checkboxes = document.querySelectorAll('.exclusive-checkbox');

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', function() {
                        const group = this.getAttribute('data-group');
                        const isExclusive = this.getAttribute('data-exclusive') === '1';

                        if (this.checked) {
                            // Ambil semua checkbox di group yang sama
                            const groupCbs = document.querySelectorAll(
                                `.exclusive-checkbox[data-group="${group}"]`);

                            groupCbs.forEach(otherCb => {
                                if (otherCb !== this) {
                                    if (isExclusive) {
                                        // Jika "Tidak Ada (X)" dicentang, matikan opsi lainnya
                                        otherCb.checked = false;
                                    } else {
                                        // Jika opsi biasa dicentang, matikan opsi "Tidak Ada (X)"
                                        if (otherCb.getAttribute('data-exclusive') === '1') {
                                            otherCb.checked = false;
                                        }
                                    }
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection

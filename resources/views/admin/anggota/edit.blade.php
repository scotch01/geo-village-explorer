@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="ttext-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Perbarui Data Anggota Keluarga
            </h1>
            <p class="text-sm lg:text-base font-medium text-slate-700 mt-1">Silakan perbarui kuisioner keterangan anggota
                keluarga di bawah ini secara teliti.</p>
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

        <form method="POST" action="{{ route('admin.anggota.update', $anggota) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border p-6 space-y-5 shadow-sm">
                <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900 tracking-tight">
                        I. Identitas Anggota Keluarga
                    </h2>
                </div>

                {{-- 5. Nomor Urut --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        5. Nomor Urut Anggota Keluarga
                    </label>
                    <input type="number" name="nomor_urut" min="1"
                        value="{{ old('nomor_urut', $anggota->nomor_urut) }}"
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
                    <input type="text" name="nama" value="{{ old('nama', $anggota->nama) }}"
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
                    <input type="text" maxlength="16" name="nik" value="{{ old('nik', $anggota->nik) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('nik')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 8. Hubungan Keluarga --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        8. Hubungan dengan Kepala Keluarga
                    </label>
                    <select name="hubungan_keluarga"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($hubunganKeluarga as $key => $label)
                            @if ($key == 1 && $sudahAdaKepalaKeluarga)
                                @continue
                            @endif
                            <option value="{{ $key }}" @selected(old('hubungan_keluarga', $anggota->hubungan_keluarga) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach
                    </select>
                    @error('hubungan_keluarga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="bg-white rounded-2xl border p-6 space-y-5 shadow-sm">
                <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900 tracking-tight">
                        II. Demografi
                    </h2>
                </div>

                {{-- 9. Status Perkawinan --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        9. Status Perkawinan
                    </label>
                    <select name="status_perkawinan"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($statusPerkawinan as $key => $label)
                            <option value="{{ $key }}" @selected(old('status_perkawinan', $anggota->status_perkawinan) == $key)>

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
                        10. Tanggal Lahir
                    </label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @error('tanggal_lahir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 11. Jenis Kelamin --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        11. Jenis Kelamin
                    </label>
                    <select name="jenis_kelamin"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($jenisKelamin as $key => $label)
                            <option value="{{ $key }}" @selected(old('jenis_kelamin', $anggota->jenis_kelamin) == $key)>

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
                <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900 tracking-tight">
                        III. Pendidikan, Pekerjaan & Ekonomi
                    </h2>
                </div>
                {{-- 12. Partisipasi Sekolah --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        12. Partisipasi Sekolah
                    </label>
                    <select name="partisipasi_sekolah"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($partisipasiSekolah as $key => $label)
                            <option value="{{ $key }}" @selected(old('partisipasi_sekolah', $anggota->partisipasi_sekolah) == $key)>

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
                        13. Ijazah/STTB tertinggi yang dimiliki
                    </label>
                    <select name="ijazah_tertinggi"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($pendidikan as $key => $label)
                            <option value="{{ $key }}" @selected(old('ijazah_tertinggi', $anggota->ijazah_tertinggi) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach
                    </select>
                    @error('ijazah_tertinggi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 14. Profesi Pekerjaan Utama (Autocomplete) --}}
                <div class="relative">
                    <label class="block mb-2 font-medium text-gray-700">
                        14. Profesi Pekerjaan Utama
                    </label>
                    <input type="hidden" name="master_profesi_id" id="master_profesi_id"
                        value="{{ old('master_profesi_id', $anggota->master_profesi_id) }}">

                    <input type="hidden" name="kode_profesi" id="kode_profesi"
                        value="{{ old('kode_profesi', $anggota->kode_profesi) }}">

                    <input type="text" id="profesi_search" autocomplete="off"
                        value="{{ old('profesi_nama', $anggota->profesi?->nama) }}"
                        placeholder="Ketik kode atau nama profesi..." class="w-full rounded-xl border-gray-300">

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
                        15. Status kedudukan dalam pekerjaan utama
                    </label>
                    <select name="status_pekerjaan"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($kedudukanPekerjaan as $key => $label)
                            <option value="{{ $key }}" @selected(old('status_pekerjaan', $anggota->status_pekerjaan) == $key)>

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
                        16. Apakah memiliki rekening aktif atau dompet digital?
                    </label>
                    <select name="rekening_digital"
                        class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Pilih</option>
                        @foreach ($rekeningAktif as $key => $label)
                            <option value="{{ $key }}" @selected(old('rekening_digital', $anggota->rekening_digital) == $key)>

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
                <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                    <div class="w-1.5 h-6 rounded-full bg-amber-500"></div>
                    <h2 class="font-black text-lg text-slate-900 tracking-tight">
                        IV. Disabilitas, Penyakit Kronis & Jaminan Kesehatan
                    </h2>
                </div>

                {{-- 17. Disabilitas (Checkbox Group) --}}
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        17. Apakah memiliki keterbatasan dalam jangka waktu lama sehingga mengalami kesulitan dalam
                        menjalankan aktivitas sehari-hari?
                    </label>
                    <div class="space-y-2 bg-slate-50 p-4 rounded-xl border border-dashed">
                        @foreach ($disabilitas as $key => $label)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox"
                                    class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500"
                                    data-group="disabilitas" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                    name="disabilitas[]" value="{{ $key }}" @checked(in_array($key, old('disabilitas', $anggota->disabilitas ?? [])))>
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
                        18. Apakah memiliki keluhan kesehatan kronis/menahun?
                    </label>
                    <div class="space-y-2 bg-slate-50 p-4 rounded-xl border border-dashed">
                        @foreach ($penyakitKronis as $key => $label)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox"
                                    class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500"
                                    data-group="penyakit_kronis" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                    name="penyakit_kronis[]" value="{{ $key }}" @checked(in_array($key, old('disabilitas', $anggota->penyakit_kronis ?? [])))>
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
                        19. Apakah memiliki jaminan kesehatan?
                    </label>
                    <div class="space-y-2 bg-slate-50 p-4 rounded-xl border border-dashed">
                        @foreach ($jaminanKesehatan as $key => $label)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox"
                                    class="exclusive-checkbox rounded text-blue-600 focus:ring-blue-500"
                                    data-group="jaminan_kesehatan" data-exclusive="{{ $key === 'X' ? '1' : '0' }}"
                                    name="jaminan_kesehatan[]" value="{{ $key }}" @checked(in_array($key, old('disabilitas', $anggota->jaminan_kesehatan ?? [])))>
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
                    <a href="{{ route('admin.anggota.show', $anggota) }}"
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

    @push('scripts')
        <script>
            document.addEventListener(
                'DOMContentLoaded',
                () => {

                    const input =
                        document.getElementById(
                            'profesi_search'
                        );

                    const results =
                        document.getElementById(
                            'profesi_results'
                        );

                    const profesiId =
                        document.getElementById(
                            'master_profesi_id'
                        );

                    const kodeProfesi =
                        document.getElementById(
                            'kode_profesi'
                        );

                    let timeout;

                    input.addEventListener(
                        'input',
                        () => {

                            clearTimeout(timeout);

                            const keyword =
                                input.value.trim();

                            if (keyword.length < 2) {

                                results.innerHTML = '';
                                results.classList.add('hidden');

                                return;
                            }

                            timeout = setTimeout(
                                async () => {

                                        try {

                                            const response =
                                                await fetch(
                                                    `/admin/master-profesi/search?q=${encodeURIComponent(keyword)}`
                                                );

                                            const data =
                                                await response.json();

                                            results.innerHTML = '';

                                            if (!data.length) {

                                                results.innerHTML =
                                                    `
                                    <div class="px-4 py-3 text-gray-500">
                                        Tidak ditemukan
                                    </div>
                                    `;

                                                results.classList.remove(
                                                    'hidden'
                                                );

                                                return;
                                            }

                                            data.forEach(
                                                item => {

                                                    const option =
                                                        document.createElement(
                                                            'button'
                                                        );

                                                    option.type =
                                                        'button';

                                                    option.className =
                                                        'w-full text-left px-4 py-3 hover:bg-slate-100 border-b';

                                                    option.innerHTML =
                                                        `
                                        <div class="font-medium">
                                            ${item.nama}
                                        </div>

                                        <div class="text-xs text-gray-500">
                                            ${item.kode}
                                        </div>
                                        `;

                                                    option.addEventListener(
                                                        'click',
                                                        () => {

                                                            input.value =
                                                                item.nama;

                                                            profesiId.value =
                                                                item.id;

                                                            kodeProfesi.value =
                                                                item.kode;

                                                            results.classList.add(
                                                                'hidden'
                                                            );

                                                        }
                                                    );

                                                    results.appendChild(
                                                        option
                                                    );
                                                }
                                            );

                                            results.classList.remove(
                                                'hidden'
                                            );

                                        } catch (error) {

                                            console.error(error);

                                        }

                                    },
                                    300
                            );

                        }
                    );

                    document.addEventListener(
                        'click',
                        (event) => {

                            if (
                                !input.contains(event.target) &&
                                !results.contains(event.target)
                            ) {

                                results.classList.add(
                                    'hidden'
                                );
                            }

                        }
                    );

                }
            );
        </script>
    @endpush
@endsection

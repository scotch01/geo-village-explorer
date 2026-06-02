@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- <h1 class="text-2xl font-bold">
            Edit Data Anggota Keluarga
        </h1> --}}

        <form method="POST" action="{{ route('admin.anggota.update', $anggota) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="bg-white rounded-2xl border p-6">
                <h2 class="font-semibold text-lg mb-5">
                    KETERANGAN ANGGOTA KELUARGA
                </h2>
                <div>

                    <label class="block mb-2">

                        5. Nomor Urut Anggota Keluarga

                    </label>

                    <input type="number" name="nomor_urut" min="1"
                        value="{{ old('nomor_urut', $anggota->nomor_urut) }}" class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block mb-2">

                        6.Nama Anggota Keluarga

                    </label>

                    <input type="text" name="nama" value="{{ old('nama', $anggota->nama) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block mb-2">

                        7. Nomor Induk Kependudukan (NIK)

                    </label>

                    <input type="text" maxlength="16" name="nik" value="{{ old('nik', $anggota->nik) }}"
                        class="w-full rounded-xl border-gray-300">

                </div>

                <div>

                    <label class="block mb-2">

                        8 Hubungan dengan Kepala Keluarga

                    </label>

                    <select name="hubungan_keluarga" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($hubunganKeluarga as $key => $label)
                            <option value="{{ $key }}" @selected(old('hubungan_keluarga', $anggota->hubungan_keluarga) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>


                <div>
                    <label class="block mb-2">

                        9. Status Perkawinan

                    </label>

                    <select name="status_perkawinan" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($statusPerkawinan as $key => $label)
                            <option value="{{ $key }}" @selected(old('status_perkawinan', $anggota->status_perkawinan) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>


                <div>

                    <label class="block mb-2">

                        10. Tanggal Lahir

                    </label>

                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}"
                        class="w-full rounded-xl border-gray-300">
                </div>

                <div>
                    <label class="block mb-2">

                        11. Jenis Kelamin

                    </label>

                    <select name="jenis_kelamin" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($jenisKelamin as $key => $label)
                            <option value="{{ $key }}" @selected(old('jenis_kelamin', $anggota->jenis_kelamin) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>
                </div>

                <div>

                    <label class="block mb-2">
                        12. Partisipasi Sekolah
                    </label>

                    <select name="partisipasi_sekolah" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($partisipasiSekolah as $key => $label)
                            <option value="{{ $key }}" @selected(old('partisipasi_sekolah', $anggota->partisipasi_sekolah) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block mb-2">
                        13. Ijazah/STTB tertinggi yang dimiliki
                    </label>

                    <select name="ijazah_tertinggi" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($pendidikan as $key => $label)
                            <option value="{{ $key }}" @selected(old('ijazah_tertinggi', $anggota->ijazah_tertinggi) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block mb-2">
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
                        class="hidden mt-2 bg-white border rounded-xl shadow-sm max-h-60 overflow-y-auto">
                    </div>

                </div>

                <div>

                    <label class="block mb-2">
                        15. Status kedudukan dalam pekerjaan utama
                    </label>

                    <select name="status_pekerjaan" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($kedudukanPekerjaan as $key => $label)
                            <option value="{{ $key }}" @selected(old('status_pekerjaan', $anggota->status_pekerjaan) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block mb-2">
                        16. Apakah memiliki rekening aktif atau dompet digital?
                    </label>

                    <select name="rekening_digital" class="w-full rounded-xl border-gray-300">

                        <option value="">
                            Pilih
                        </option>

                        @foreach ($rekeningAktif as $key => $label)
                            <option value="{{ $key }}" @selected(old('rekening_digital', $anggota->rekening_digital) == $key)>

                                {{ $label }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="block mb-2">

                        17. Apakah memiliki keterbatasan dalam jangka waktu lama sehingga mengalami kesulitan dalam
                        menjalankan aktivitas sehari-hari?

                    </label>

                    <div class="space-y-2">
                        @foreach ($disabilitas as $key => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="disabilitas"
                                    data-exclusive="{{ $key === 'X' ? '1' : '0' }}" name="disabilitas[]"
                                    value="{{ $key }}" @checked(in_array($key, old('disabilitas', $anggota->disabilitas ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach
                    </div>

                </div>

                <div>

                    <label class="block mb-2">

                        18. Apakah memiliki keluhan kesehatan kronis/menahun?

                    </label>

                    <div class="space-y-2">
                        @foreach ($penyakitKronis as $key => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="penyakit_kronis"
                                    data-exclusive="{{ $key === 'X' ? '1' : '0' }}" name="penyakit_kronis[]"
                                    value="{{ $key }}" @checked(in_array($key, old('disabilitas', $anggota->penyakit_kronis ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach
                    </div>

                </div>

                <div>

                    <label class="block mb-2">

                        19. Apakah memiliki jaminan kesehatan?

                    </label>

                    <div class="space-y-2">
                        @foreach ($jaminanKesehatan as $key => $label)
                            <label class="flex items-center gap-2">

                                <input type="checkbox" class="exclusive-checkbox" data-group="jaminan_kesehatan"
                                    data-exclusive="{{ $key === 'X' ? '1' : '0' }}" name="jaminan_kesehatan[]"
                                    value="{{ $key }}" @checked(in_array($key, old('disabilitas', $anggota->jaminan_kesehatan ?? [])))>

                                <span>{{ $label }}</span>

                            </label>
                        @endforeach
                    </div>

                </div>

                <div class="flex justify-end">

                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl">

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

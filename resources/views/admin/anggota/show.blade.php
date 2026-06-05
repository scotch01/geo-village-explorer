@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl bg mx-auto space-y-8 animate-fade-in px-2 sm:px-0">
        <!-- HEADER HALAMAN -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="text-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Detail Data Anggota Keluarga
            </h1>
            <h3 class="text-sm lg:text-base font-medium text-slate-700 tracking-tight">
                Karakteristik Individu dan Sosial Ekonomi
            </h3>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    I. Identitas Anggota Keluarga
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">5. Nomor Urut Anggota Keluarga</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $anggota->nomor_urut ?: '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">6. Nama Anggota Keluarga</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $anggota->nama ?: '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">7. Nomor Induk Kependudukan (NIK)</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $anggota->nik ?: '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">8. Hubungan dengan Kepala Keluarga</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $hubunganKeluarga[$anggota->hubungan_keluarga] ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    II. Demografi
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">9. Status Perkawinan</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $statusPerkawinan[$anggota->status_perkawinan] ?? '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">10. Tanggal Lahir</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') : '-' }}

                        @if ($anggota->umur)
                            <span class="text-sm font-bold text-slate-500">
                                ({{ $anggota->umur }} Tahun)
                            </span>
                        @endif
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">11. Jenis Kelamin</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $jenisKelamin[$anggota->jenis_kelamin] ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    III. Pendidikan, Pekerjaan & Ekonomi
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">12. Partisipasi Sekolah</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $partisipasiSekolah[$anggota->partisipasi_sekolah] ?? '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">13. Ijazah/STTB tertinggi yang
                        dimiliki</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $pendidikan[$anggota->ijazah_tertinggi] ?? '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">14. Profesi Pekerjaan Utama</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $anggota->profesi?->kode }}
                        -
                        {{ $anggota->profesi?->nama }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">15. Status kedudukan dalam pekerjaan
                        utama</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $kedudukanPekerjaan[$anggota->status_pekerjaan] ?? '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">16. Apakah memiliki rekening aktif atau
                        dompet digital?</span>
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $rekeningAktif[$anggota->rekening_digital] ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">
                <div class="w-1.5 h-6 rounded-full bg-fuchsia-600"></div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight">
                    IV. Disabilitas, Penyakit Kronis & Jaminan Kesehatan
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">17. Apakah memiliki keterbatasan dalam
                        jangka waktu lama sehingga mengalami kesulitan dalam
                        menjalankan aktivitas sehari-hari?</span>
                    @php
                        $disabilitas = collect($anggota->disabilitas ?? [])
                            ->map(fn($item) => $disabilitas[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $disabilitas ?: '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">18. Apakah memiliki keluhan kesehatan
                        kronis/menahun?</span>
                    @php
                        $penyakitKronis = collect($anggota->penyakit_kronis ?? [])
                            ->map(fn($item) => $penyakitKronis[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $penyakitKronis ?: '-' }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-sm font-bold text-slate-500 tracking-wider">19. Apakah memiliki jaminan
                        kesehatan?</span>
                    @php
                        $jaminanKesehatan = collect($anggota->jaminan_kesehatan ?? [])
                            ->map(fn($item) => $jaminanKesehatan[$item] ?? $item)
                            ->implode(', ');
                    @endphp
                    <p class="font-semibold text-slate-800 text-sm lg:text-base">
                        {{ $jaminanKesehatan ?: '-' }}</p>
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
                <form method="POST" action="{{ route('admin.anggota.destroy', $anggota) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus permanen data anggota keluarga ini?')"
                        class="px-6 py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-rose-600/10">
                        Hapus Data
                    </button>
                </form>
            @endif

            <a href="{{ route('admin.anggota.edit', $anggota) }}"
                class="px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-2xl transition-all active:scale-95 text-sm shadow-sm shadow-amber-500/10 text-center">
                Edit Data
            </a>
            </div>

        </div>
    </div>
@endsection

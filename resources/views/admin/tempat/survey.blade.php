@extends('layouts.admin')

@section('content')
    <div class="space-y-10 animate-fade-in px-2 sm:px-0 overflow-hidden">

        <x-back-button :href="route('admin.tempat.index')">
            Kembali
        </x-back-button>

        <div class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm">

            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                        Pendataan <span class="text-blue-600 block sm:inline">Wilayah</span>
                    </h1>

                    <p class="text-slate-500 mt-2 text-base sm:text-lg font-medium flex items-center gap-2">
                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Petugas:
                        <span class="text-slate-800 font-bold uppercase">
                            {{ $tempat->creator->name ?? '-' }}
                        </span>
                    </p>
                </div>

                @if (auth()->user()->isMasterAdmin())
                    <form action="{{ route('admin.tempat.destroy', $tempat) }}" method="POST"
                        onsubmit="return confirm(
                    'PERINGATAN!\n\nSemua data keluarga, anggota keluarga, usaha, dan data terkait bangunan ini akan dihapus permanen.\n\nLanjutkan?'
                )">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl transition-all active:scale-95 shadow-sm shadow-rose-600/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7L5 7M10 11V17M14 11V17M6 7L7 19C7.1 20.1 7.9 21 9 21H15C16.1 21 16.9 20.1 17 19L18 7M9 7V5C9 3.9 9.9 3 11 3H13C14.1 3 15 3.9 15 5V7" />
                            </svg>

                            Hapus Bangunan
                        </button>
                    </form>
                @endif

            </div>

        </div>

        <!-- Flash Message -->
        <x-alert />

        {{-- MENU SURVEY (BLOK I, II, III) --}}
        @php
            $topGridCols = $tempat->jenis_bangunan === 'bc' ? 'md:grid-cols-3' : 'md:grid-cols-2';
        @endphp

        <div class="grid grid-cols-1 {{ $topGridCols }} gap-8 w-full">

            <div
                class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between min-w-0">
                <div>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                                BLOK I
                            </h3>
                            <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">
                                IDENTIFIKASI BANGUNAN
                            </p>
                        </div>

                        @if (auth()->user()->canEditTempat($tempat))
                            <a href="{{ route('admin.tempat.edit', $tempat) }}"
                                class="shrink-0 inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 font-bold text-white text-sm transition-all active:scale-95 shadow-sm shadow-amber-500/20">
                                Edit
                            </a>
                        @else
                            <span
                                class="shrink-0 inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-slate-200 text-slate-500 font-bold text-sm cursor-not-allowed">

                                Tidak Diizinkan

                            </span>
                        @endif
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <div class="text-xs uppercase tracking-wider font-black text-slate-400">
                            Jenis Bangunan
                        </div>
                        <div
                            class="mt-2 inline-flex px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-black uppercase tracking-wider border border-blue-100">
                            {{ \App\Constants\Tempat\JenisBangunan::OPTIONS[$tempat->jenis_bangunan] ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            @if (in_array($tempat->jenis_bangunan, ['btt', 'bc']))
                <div
                    class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between min-w-0">
                    <div>
                        <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                            BLOK II
                        </h3>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest leading-relaxed">
                            KETERANGAN UMUM KELUARGA, ANGOOTA KELUARGA DAN PERUMAHAN
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        @if (!$tempat->keluarga)
                            @if (auth()->user()->canEditTempat($tempat))
                                <a href="{{ route('admin.keluarga.create', $tempat) }}"
                                    class="w-full sm:w-auto text-center inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 font-bold text-white text-sm transition-all active:scale-95 shadow-sm shadow-blue-600/10">

                                    Isi Data Keluarga

                                </a>
                            @else
                                <button type="button" disabled
                                    class="w-full sm:w-auto text-center inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-slate-200 text-slate-500 font-bold text-sm cursor-not-allowed">

                                    Tidak Diizinkan

                                </button>
                            @endif
                        @else
                            <a href="{{ route('admin.keluarga.show', $tempat) }}"
                                class="w-full sm:w-auto text-center inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 font-bold text-white text-sm transition-all active:scale-95">

                                Lihat Data Keluarga

                            </a>
                        @endif
                    </div>
                </div>
            @endif

            @if (in_array($tempat->jenis_bangunan, ['bku', 'bc']))
                <div
                    class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between min-w-0">

                    <div class="flex items-start justify-between gap-2 sm:gap-4">
                        <div class="min-w-0 flex-1">
                            <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                                BLOK III
                            </h3>
                            <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest leading-relaxed">
                                KETERANGAN USAHA/PERUSAHAAN
                            </p>
                        </div>
                        @if ($tempat->usahas->count())
                            <div
                                class="shrink-0 inline-flex items-center justify-center px-2 py-1.5 sm:px-4 sm:py-2 rounded-xl bg-slate-50 font-bold shadow-sm shadow-slate-500/20 border-slate-200 border">
                                <p class="text-xs sm:text-sm whitespace-nowrap">
                                    {{ $tempat->usahas->count() }} Usaha masuk list
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="pt-6 border-t border-slate-100">

                        <a href="{{ route('admin.usaha.index', $tempat) }}"
                            class="w-full sm:w-auto text-center inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-green-600 hover:bg-green-700 font-bold text-white text-sm transition-all active:scale-95 shadow-sm">

                            Kelola Data Usaha

                        </a>

                    </div>
                </div>
            @endif

        </div>

        {{-- FORM SECTION (BLOK IV & BLOK V) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">

            {{-- BLOK IV: FOTO BANGUNAN --}}
            @if (auth()->user()->canEditTempat($tempat))
                <div class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm min-w-0">
                    <div class="mb-6">
                        <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                            BLOK IV
                        </h3>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">
                            FOTO BANGUNAN
                        </p>
                    </div>

                    <form action="{{ route('admin.tempat.updateSurvey', $tempat) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="relative group">
                            <input type="file" id="foto_bangunan" name="foto_bangunan" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors cursor-pointer border border-slate-200 rounded-xl p-2 bg-slate-50/50">
                        </div>

                        @if ($tempat->foto_bangunan)
                            <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-inner group">
                                <img id="foto-server" src="{{ Storage::url($tempat->foto_bangunan) }}"
                                    class="max-h-72 w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif

                        <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-inner group">
                            <img id="preview-foto"
                                class="hidden max-h-72 w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <button
                            class="w-full sm:w-auto flex items-center justify-center px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 font-bold text-white text-sm transition-all active:scale-95 shadow-sm shadow-blue-600/20">
                            Simpan Foto
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm min-w-0">

                    <div class="mb-6">
                        <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                            BLOK IV
                        </h3>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">
                            FOTO BANGUNAN
                        </p>
                    </div>

                    <div class="space-y-5">

                        <div class="relative group">
                            <input disabled type="file" id="foto_bangunan" name="foto_bangunan" accept="image/*"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-slate-50 file:text-slate-700 hover:file:bg-slate-100 file:transition-colors cursor-not-allowed border border-slate-200 rounded-xl p-2 bg-slate-50/50 file:cursor-not-allowed">
                        </div>

                        @if ($tempat->foto_bangunan)
                            <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-inner group">
                                <img id="foto-server" src="{{ Storage::url($tempat->foto_bangunan) }}"
                                    class="max-h-72 w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif

                        <button disabled
                            class="w-full sm:w-auto flex items-center justify-center px-6 py-3.5 rounded-xl bg-slate-200 text-slate-500 font-bold cursor-not-allowed">
                            Simpan Foto
                        </button>
                    </div>

                </div>
            @endif

            {{-- BLOK V: CATATAN --}}
            @if (auth()->user()->canEditTempat($tempat))
                <div class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm min-w-0">
                    <div class="mb-6">
                        <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                            BLOK V
                        </h3>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">
                            CATATAN
                        </p>
                    </div>

                    <form action="{{ route('admin.tempat.updateSurvey', $tempat) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <textarea name="catatan" rows="5"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-4 font-medium text-slate-700 transition-all placeholder:text-slate-400 text-sm lg:text-base"
                                placeholder="Tambahkan catatan observasi lapangan di sini...">{{ old('catatan', $tempat->catatan) }}</textarea>
                        </div>

                        <button
                            class="w-full sm:w-auto flex items-center justify-center px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 font-bold text-white text-sm transition-all active:scale-95 shadow-sm shadow-blue-600/20">
                            Simpan Catatan
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm min-w-0">
                    <div class="mb-6">
                        <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                            BLOK V
                        </h3>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">
                            CATATAN
                        </p>
                    </div>

                    <div class="space-y-5">

                        <div>
                            <textarea disabled name="catatan" rows="5"
                                class="w-full rounded-2xl border-slate-200 bg-slate-50/50 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-4 font-medium text-slate-700 cursor-not-allowed transition-all placeholder:text-slate-400 text-sm lg:text-base"
                                placeholder="Tambahkan catatan observasi lapangan di sini..."></textarea>
                        </div>

                        <button disabled
                            class="w-full sm:w-auto flex items-center justify-center px-6 py-3.5 rounded-xl bg-slate-200 text-slate-500 font-bold cursor-not-allowed">
                            Simpan Catatan
                        </button>
                    </div>
                </div>
            @endif

        </div>

    </div>

    @push('scripts')
        <script>
            document
                .getElementById('foto_bangunan')
                ?.addEventListener('change', function(e) {

                    const file = e.target.files[0];

                    if (!file) return;

                    const oldImage = document.getElementById('foto-server');

                    if (oldImage) {
                        oldImage.style.display = 'none';
                    }

                    const preview = document.getElementById('preview-foto');

                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                });
        </script>
    @endpush
@endsection

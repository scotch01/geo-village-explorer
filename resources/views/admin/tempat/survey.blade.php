@extends('layouts.admin')

@section('content')
    <div class="space-y-10 animate-fade-in px-2 sm:px-0 overflow-hidden">

        <div class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                Pendataan <span class="text-blue-600 block sm:inline">Wilayah</span>
            </h1>
            <p class="text-slate-500 mt-2 text-base sm:text-lg font-medium flex items-center gap-2">
                <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Petugas: <span class="text-slate-800 font-bold uppercase">{{ $tempat->creator->name ?? '-' }}</span>
            </p>
        </div>

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

                        <a href="{{ route('admin.tempat.edit', $tempat) }}"
                            class="shrink-0 inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 font-bold text-white text-sm transition-all active:scale-95 shadow-sm shadow-amber-500/20">
                            Edit
                        </a>
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
                            <a href="{{ route('admin.keluarga.create', $tempat) }}"
                                class="w-full sm:w-auto text-center inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 font-bold text-white text-sm transition-all active:scale-95 shadow-sm shadow-blue-600/10">
                                Isi Data Keluarga
                            </a>
                        @else
                            <a href="{{ route('admin.keluarga.show', $tempat) }}"
                                class="w-full sm:w-auto text-center inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 font-bold text-white text-sm transition-all active:scale-95 shadow-sm shadow-slate-900/10">
                                Lihat Data Keluarga
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            @if (in_array($tempat->jenis_bangunan, ['bku', 'bc']))
                <div
                    class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-6 lg:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between min-w-0">

                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-black text-2xl text-slate-900 tracking-tight">
                                BLOK III
                            </h3>
                            <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest leading-relaxed">
                                KETERANGAN USAHA/PERUSAHAAN
                            </p>
                        </div>
                        @if ($tempat->usahas->count())
                            <div class="shrink-0 inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-50 font-bold shadow-sm shadow-slate-500/20 border">
                                <p class="text-sm">{{ $tempat->usahas->count() }}
                                    Usaha masuk list</p>
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

            {{-- BLOK V: CATATAN --}}
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

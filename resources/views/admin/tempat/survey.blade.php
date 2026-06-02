@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <div class="bg-white border rounded-2xl p-6">

            <h1 class="text-2xl font-bold text-gray-800">
                Pendataan
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Petugas:
                {{ $tempat->creator->name ?? '-' }}
            </p>

        </div>

        {{-- MENU SURVEY --}}

        <div class="grid md:grid-cols-3 gap-4">

            <div class="bg-white border rounded-2xl p-6 hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="font-semibold text-lg">
                            BLOK I
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            IDENTIFIKASI BANGUNAN
                        </p>

                    </div>

                    <a href="{{ route('admin.tempat.edit', $tempat) }}"
                        class="px-4 py-2 rounded-xl bg-amber-500 text-white text-sm">

                        Edit

                    </a>

                </div>

                <div class="mt-4">

                    <div class="text-xs text-gray-500">
                        Jenis Bangunan
                    </div>

                    <div class="font-semibold mt-1">

                        {{ \App\Constants\Tempat\JenisBangunan::OPTIONS[$tempat->jenis_bangunan] ?? '-' }}

                    </div>

                </div>

            </div>

            @if (in_array($tempat->jenis_bangunan, ['btt', 'bc']))
                <div class="bg-white border rounded-2xl p-6 hover:shadow-md transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <h3 class="font-semibold text-lg">
                                BLOK II
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                KETERANGAN UMUM KELUARGA DAN PERUMAHAN
                            </p>

                        </div>

                    </div>

                    @if (!$tempat->keluarga)
                        <a href="{{ route('admin.keluarga.create', $tempat) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">

                            Isi Data Keluarga

                        </a>
                    @else
                        <a href="{{ route('admin.keluarga.show', $tempat) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">

                            Lihat Data Keluarga

                        </a>
                    @endif
                </div>
            @endif

            @if (in_array($tempat->jenis_bangunan, ['bku', 'bc']))
                <div class="bg-white border rounded-2xl p-6 hover:shadow-md transition">

                    <div>

                        <h3 class="font-semibold text-lg">
                            BLOK III
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            KETERANGAN USAHA/PERUSAHAAN
                        </p>

                    </div>
                    @if ($tempat->usaha)
                        <a href="{{ route('admin.usaha.edit', $tempat) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-amber-500 text-white text-sm">

                            Edit Data Usaha

                        </a>
                    @else
                        <a href="{{ route('admin.usaha.create', $tempat) }}"
                            class="inline-flex mt-4 px-4 py-2 rounded-xl bg-green-600 text-white text-sm">

                            Isi Data Usaha

                        </a>
                    @endif
                </div>
            @endif

        </div>

        <div class="grid md:grid-cols-2 gap-4">

            {{-- BLOK IV FOTO BANGUNAN --}}

            <div class="bg-white border rounded-2xl p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="font-semibold text-lg">
                            BLOK IV
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            FOTO BANGUNAN
                        </p>

                    </div>

                </div>

                <form action="{{ route('admin.tempat.updateSurvey', $tempat) }}" method="POST"
                    enctype="multipart/form-data" class="mt-4">

                    @csrf
                    @method('PUT')

                    <input type="file" id="foto_bangunan" name="foto_bangunan" accept="image/*" class="block w-full">

                    @if ($tempat->foto_bangunan)
                        <img id="foto-server" src="{{ Storage::url($tempat->foto_bangunan) }}"
                            class="mt-4 rounded-xl border max-h-72 w-full object-cover">
                    @endif

                    <img id="preview-foto" class="hidden mt-4 rounded-xl border max-h-72 w-full object-cover">

                    <button class="mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white">

                        Simpan Foto

                    </button>

                </form>

            </div>

            {{-- BLOK V CATATAN --}}

            <div class="bg-white border rounded-2xl p-6">

                <h3 class="font-semibold text-lg">
                    BLOK V
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    CATATAN
                </p>

                <form action="{{ route('admin.tempat.updateSurvey', $tempat) }}" method="POST" class="mt-4">

                    @csrf
                    @method('PUT')

                    <textarea name="catatan" rows="5" class="w-full rounded-xl border-gray-300">{{ old('catatan', $tempat->catatan) }}</textarea>

                    <button class="mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white">

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

                    const oldImage =
                        document.getElementById('foto-server');

                    if (oldImage) {

                        oldImage.style.display = 'none';

                    }

                    const preview =
                        document.getElementById('preview-foto');

                    preview.src =
                        URL.createObjectURL(file);

                    preview.classList.remove('hidden');

                });
        </script>
    @endpush
@endsection

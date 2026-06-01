@extends('layouts.admin')

@section('content')

    <div class="max-w-5xl mx-auto space-y-8">

        <!-- VALIDATION -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5">

                <div class="font-bold text-red-700 mb-2">
                    Terjadi Kesalahan
                </div>

                <ul class="space-y-1 text-sm text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <!-- FORM -->
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.tempat.store') }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf

            <div class="p-8 space-y-10">

                <!-- INFORMASI UMUM -->
                <section class="space-y-6">

                    <div class="flex items-center gap-3">

                        <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>

                        <div>
                            <h2 class="font-bold text-slate-800">
                                BLOK I
                            </h2>

                            <p class="text-sm text-slate-500">
                                IDENTIFIKASI BANGUNAN
                            </p>
                        </div>

                    </div>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="text-sm font-semibold text-slate-700">
                                1. Kode Penggunaan Bangunan
                            </label>

                            <select name="jenis_bangunan" required
                                class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                                <option value="">
                                    -- Pilih Jenis Bangunan --
                                </option>

                                @foreach (\App\Constants\Tempat\JenisBangunan::OPTIONS as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old('jenis_bangunan') == $value ? 'selected' : '' }}>

                                        {{ $label }}

                                    </option>
                                @endforeach

                            </select>

                            <div id="jenis-helper" class="mt-4 hidden rounded-2xl bg-blue-50 border border-blue-100 p-4">

                            </div>

                        </div>

                    </div>

                </section>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-slate-100 px-8 py-5 bg-slate-50 flex items-center justify-end gap-4">

                <a href="{{ route('admin.tempat.index') }}"
                    class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-200 transition">
                    Batal
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition">
                    Simpan Data
                </button>

            </div>

        </form>

    </div>

    <script>
        const jenisSelect =
            document.querySelector(
                '[name="jenis_bangunan"]'
            );

        const helper =
            document.getElementById(
                'jenis-helper'
            );

        function updateJenisHelper() {
            helper.classList.remove('hidden');

            switch (jenisSelect.value) {
                case 'btt':

                    helper.innerHTML =
                        'Bangunan digunakan sebagai tempat tinggal.';

                    break;

                case 'bku':

                    helper.innerHTML =
                        'Bangunan digunakan khusus untuk aktivitas usaha.';

                    break;

                case 'bc':

                    helper.innerHTML =
                        'Bangunan digunakan sebagai tempat tinggal sekaligus usaha.';

                    break;

                default:

                    helper.classList.add('hidden');
            }
        }

        jenisSelect.addEventListener(
            'change',
            updateJenisHelper
        );

        updateJenisHelper();
    </script>

@endsection

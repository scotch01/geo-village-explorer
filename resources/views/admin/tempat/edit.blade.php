@extends('layouts.admin')

@section('content')

    <div class="max-w-5xl mx-auto space-y-10 animate-fade-in px-2 sm:px-0 overflow-hidden">

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

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.tempat.update', $tempat->id ?? '') }}"
            class="bg-white border border-slate-200 rounded-3xl lg:rounded-[2.5rem] shadow-sm overflow-hidden transition-all">

            @csrf
            @method('PUT')

            <div class="p-6 lg:p-10 space-y-12">

                <section class="space-y-8">

                    <div class="flex items-center gap-4">

                        <div class="w-2 h-8 rounded-full bg-amber-500"></div>

                        <div>
                            <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                                BLOK I
                            </h2>

                            <p class="text-xs font-bold text-slate-400 mt-0.5 uppercase tracking-widest">
                                IDENTIFIKASI BANGUNAN
                            </p>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">

                        <div class="space-y-3">
                            <label class="text-sm lg:text-base font-bold text-slate-700 tracking-tight">
                                1. Kode Penggunaan Bangunan
                            </label>

                            <div class="relative">
                                <select name="jenis_bangunan" required
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-4 font-semibold text-slate-700 transition-all focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm lg:text-base cursor-pointer appearance-none">

                                    <option value="" class="text-slate-400 font-medium">
                                        -- Pilih Jenis Bangunan --
                                    </option>

                                    @foreach (\App\Constants\Tempat\JenisBangunan::OPTIONS as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('jenis_bangunan', $tempat->jenis_bangunan) == $value ? 'selected' : '' }}>

                                            {{ $label }}

                                        </option>
                                    @endforeach

                                </select>

                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>

                            <div id="jenis-helper"
                                class="mt-4 hidden rounded-2xl bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-wider p-4 border border-blue-100/50 shadow-sm">

                            </div>

                        </div>

                    </div>

                </section>

            </div>

            <div
                class="border-t border-slate-100 px-6 py-5 lg:px-10 lg:py-6 bg-slate-50/50 flex items-center justify-end gap-4">

                <a href="{{ route('admin.tempat.survey', $tempat) }}"
                        class="px-6 py-2.5 border rounded-xl text-gray-700 hover:bg-gray-50 transition-all active:scale-95">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold transition-all active:scale-95 shadow-md shadow-amber-500/20 text-sm text-center">
                        Simpan Perubahan
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

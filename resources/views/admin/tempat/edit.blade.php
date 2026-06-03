@extends('layouts.admin')

@section('content')

    <div class="max-w-5xl mx-auto space-y-10 animate-fade-in px-2 sm:px-0 overflow-hidden">

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-100 rounded-3xl p-6 shadow-sm">

                <div class="font-extrabold text-rose-800 text-lg tracking-tight mb-3 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                    Terjadi Kesalahan
                </div>

                <ul class="space-y-1.5 text-sm text-rose-600 font-medium">

                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <span class="text-rose-400 text-xs">●</span>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.tempat.store') }}"
            class="bg-white border border-slate-200 rounded-3xl lg:rounded-[2.5rem] shadow-sm overflow-hidden transition-all">

            @csrf

            <div class="p-6 lg:p-10 space-y-12">

                <section class="space-y-8">

                    <div class="flex items-center gap-4">

                        <div class="w-2 h-8 rounded-full bg-blue-600"></div>

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

                <a href="{{ route('admin.tempat.index') }}"
                    class="px-6 py-3.5 rounded-xl font-bold text-slate-600 hover:bg-slate-100 transition-all active:scale-95 text-sm lg:text-base text-center">
                    Batal
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-xl font-bold transition-all active:scale-95 shadow-sm shadow-blue-600/20 text-sm lg:text-base text-center">
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

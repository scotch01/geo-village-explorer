@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-10 animate-fade-in px-2 sm:px-0">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8">
            <h1 class="text-2xl lg:text-3xl font-black text-slate-900 tracking-tight">
                Tambah Data BLOK TAMBAHAN
            </h1>
            <p class="text-sm lg:text-base font-medium text-slate-700 mt-1">Silakan lengkapi kuisioner bangunan lainnya di
                bawah ini secara teliti.</p>
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

        <form method="POST" action="{{ route('admin.bangunan-lainnya.store', $tempat) }}" class="space-y-10">

            @csrf

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                <div class="flex items-center gap-4">

                    <div class="w-2 h-8 rounded-full bg-blue-600"></div>

                    <div>

                        <h2 class="font-black text-xl text-slate-900 tracking-tight">
                            BLOK TAMBAHAN
                        </h2>

                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">

                            KETERANGAN BANGUNAN LAINNYA

                        </p>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">

                    <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>

                    <h2 class="font-black text-lg text-slate-900 tracking-tight">

                        I. Informasi Infrastruktur

                    </h2>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama Infrastruktur --}}
                    <div class="space-y-2">

                        <label class="block text-sm font-bold text-slate-700">
                            1. Nama Infrastruktur
                        </label>

                        <input type="text" name="nama_infrastruktur" value="{{ old('nama_infrastruktur') }}"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 focus:border-blue-500 focus:ring focus:ring-blue-200/50">

                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-2">

                        <label class="block text-sm font-bold text-slate-700">
                            2. Kategori
                        </label>

                        <select name="kategori"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-700 focus:border-blue-500">

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach ($kategori as $key => $label)
                                <option value="{{ $key }}" @selected(old('kategori') == $key)>
                                    {{ $label }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- Alamat --}}
                    <div class="md:col-span-2 space-y-6">

                        <label class="block text-sm font-bold text-slate-700">
                            3. Alamat
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Provinsi --}}
                            <div class="space-y-2">

                                <label class="block text-sm font-bold text-slate-700">
                                    a. Provinsi
                                </label>

                                <input type="text" name="provinsi" value="{{ old('provinsi', $desa?->provinsi) }}"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500">

                            </div>

                            {{-- Kabupaten --}}
                            <div class="space-y-2">

                                <label class="block text-sm font-bold text-slate-700">
                                    b. Kabupaten/Kota
                                </label>

                                <input type="text" name="kabupaten" value="{{ old('kabupaten', $desa?->kabupaten) }}"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500">

                            </div>

                            {{-- Kecamatan --}}
                            <div class="space-y-2">

                                <label class="block text-sm font-bold text-slate-700">
                                    c. Kecamatan
                                </label>

                                <input type="text" name="kecamatan" value="{{ old('kecamatan', $desa?->kecamatan) }}"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500">

                            </div>

                            {{-- Desa --}}
                            <div class="space-y-2">

                                <label class="block text-sm font-bold text-slate-700">
                                    d. Desa/Kelurahan
                                </label>

                                <input type="text" name="desa" value="{{ old('desa', $desa?->nama_desa) }}"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-100 p-3.5 font-semibold text-slate-500">

                            </div>

                            {{-- Dusun --}}
                            <div class="space-y-2">

                                <label class="block text-sm font-bold text-slate-700">
                                    e. Dusun
                                </label>

                                <select name="dusun"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold">

                                    <option value="">
                                        Pilih Dusun
                                    </option>

                                    @foreach ($dusuns as $dusun)
                                        <option value="{{ $dusun }}" @selected(old('dusun') == $dusun)>
                                            {{ $dusun }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- Alamat Detail --}}
                            <div class="md:col-span-2 space-y-2">

                                <label class="block text-sm font-bold text-slate-700">
                                    f. Alamat Detail
                                </label>

                                <textarea name="alamat" rows="3"
                                    class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-4 font-semibold text-slate-800 focus:border-blue-500 focus:ring focus:ring-blue-200/50">{{ old('alamat') }}</textarea>

                            </div>

                        </div>

                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">

                        <label class="block text-sm font-bold text-slate-700">
                            4. Email
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 focus:border-blue-500 focus:ring focus:ring-blue-200/50">

                    </div>

                    {{-- Website --}}
                    <div class="space-y-2">

                        <label class="block text-sm font-bold text-slate-700">
                            5. Website
                        </label>

                        <input type="text" name="website" value="{{ old('website') }}" placeholder="https://"
                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 p-3.5 font-semibold text-slate-800 focus:border-blue-500 focus:ring focus:ring-blue-200/50">

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 lg:p-8 transition-all">

                <div class="flex items-center gap-4 mb-6 border-b border-slate-100 pb-4">

                    <div class="w-1.5 h-6 rounded-full bg-blue-600"></div>

                    <h2 class="font-black text-lg text-slate-900 tracking-tight">

                        II. Tagging Lokasi

                    </h2>

                </div>

                <div class="space-y-8">

                    <x-geo-location latitude-field="latitude" longitude-field="longitude" accuracy-field="akurasi" />

                    <div class="flex items-center justify-end gap-3 border-t-2 border-gray-300 pt-4">

                        <a href="{{ route('admin.tempat.survey', $tempat) }}"
                            class="px-6 py-2.5 border rounded-xl text-gray-700 hover:bg-gray-50 transition-all active:scale-95">

                            Batal

                        </a>

                        <button type="submit"
                            class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold transition-all active:scale-95 shadow-md shadow-blue-600/20 text-sm text-center">

                            Simpan Data

                        </button>

                    </div>

                </div>

            </div>

        </form>
    </div>
@endsection

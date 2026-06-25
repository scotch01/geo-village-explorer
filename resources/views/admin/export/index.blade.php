@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}

        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                Export <span class="text-blue-600">Data</span>
            </h1>
            <p class="text-slate-500 mt-2 font-medium">
                Ekspor hasil pendataan ke dalam format CSV.
            </p>
        </div>

        {{-- FILTER --}}
        <div
            class="
            bg-white
            border border-slate-200
            rounded-[2rem]
            p-6
            shadow-sm
        ">

            <form method="GET" action="{{ route('admin.export.index') }}">

                <div class="grid lg:grid-cols-12 gap-6">

                    {{-- DATASET --}}
                    <div class="lg:col-span-4">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Dataset
                        </label>

                        <select name="dataset" onchange="this.form.submit()" class="w-full rounded-2xl border-slate-200">

                            <option value="tempat" @selected($dataset === 'tempat')>
                                Tempat
                            </option>

                            <option value="keluarga" @selected($dataset === 'keluarga')>
                                Keluarga
                            </option>

                            <option value="anggota" @selected($dataset === 'anggota')>
                                Anggota Keluarga
                            </option>

                            <option value="usaha" @selected($dataset === 'usaha')>
                                Usaha
                            </option>

                        </select>

                    </div>

                    {{-- DESA --}}
                    <div class="lg:col-span-4">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Desa
                        </label>

                        <select name="id_desa" onchange="this.form.submit()" class="w-full rounded-2xl border-slate-200">

                            <option value="">
                                Semua Desa
                            </option>

                            @foreach ($desas as $desa)
                                <option value="{{ $desa->id }}" @selected(request('id_desa') == $desa->id)>

                                    {{ $desa->nama_desa }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- JENIS --}}
                    <div class="lg:col-span-4">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Jenis Bangunan
                        </label>
                        <select name="jenis_bangunan" onchange="this.form.submit()"
                            class="w-full rounded-2xl border-slate-200">

                            <option value="">
                                Semua
                            </option>

                            <option value="btt" @selected(request('jenis_bangunan') == 'btt')>
                                BTT
                            </option>

                            <option value="bku" @selected(request('jenis_bangunan') == 'bku')>
                                BKU
                            </option>

                            <option value="bc" @selected(request('jenis_bangunan') == 'bc')>
                                BC
                            </option>

                        </select>

                    </div>

                </div>

            </form>

        </div>

        <div class="
        bg-blue-50
        border border-blue-100
        rounded-3xl
        p-6
    ">

            <div class="text-sm text-blue-700">

                Dataset Dipilih

            </div>

            <div class="mt-2 text-3xl font-black text-blue-900">

                @switch($dataset)
                    @case('tempat')
                        {{ number_format($summary['tempat']) }} Tempat
                    @break

                    @case('keluarga')
                        {{ number_format($summary['keluarga']) }} Keluarga
                    @break

                    @case('anggota')
                        {{ number_format($summary['anggota']) }} Anggota
                    @break

                    @case('usaha')
                        {{ number_format($summary['usaha']) }} Usaha
                    @break
                @endswitch

            </div>

        </div>

        {{-- RINGKASAN --}}
        <div class="grid md:grid-cols-4 gap-4">

            <div class="bg-white rounded-3xl border border-slate-200 p-6">
                <div class="text-sm text-slate-500">
                    Tempat
                </div>

                <div class="text-3xl font-black mt-2">
                    {{ number_format($summary['tempat']) }}
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6">
                <div class="text-sm text-slate-500">
                    Keluarga
                </div>

                <div class="text-3xl font-black mt-2">
                    {{ number_format($summary['keluarga']) }}
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6">
                <div class="text-sm text-slate-500">
                    Anggota
                </div>

                <div class="text-3xl font-black mt-2">
                    {{ number_format($summary['anggota']) }}
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6">
                <div class="text-sm text-slate-500">
                    Usaha
                </div>

                <div class="text-3xl font-black mt-2">
                    {{ number_format($summary['usaha']) }}
                </div>
            </div>

        </div>

        {{-- RELASI --}}
        <div
            class="
            bg-blue-50
            border border-blue-100
            rounded-[2rem]
            p-6
        ">

            <h2 class="font-bold text-blue-900">
                Relasi Dataset
            </h2>

            <pre class="mt-4 text-sm text-blue-800 whitespace-pre-wrap">Tempat (tempat_id)
├── Keluarga (tempat_id)
├── Usaha (tempat_id)

Keluarga (keluarga_id)
└── Anggota (keluarga_id)</pre>

        </div>

        {{-- EXPORT --}}
        <div>

            <a href="{{ route('admin.export.download', request()->only(['dataset', 'id_desa', 'jenis_bangunan'])) }}"
                class="inline-flex items-center px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition-all active:scale-95">
                Export CSV
            </a>

        </div>

    </div>
@endsection

@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto space-y-8">

    <!-- HEADER -->
    <div>

        <h1 class="text-3xl font-black tracking-tight text-slate-900">
            Edit Desa
        </h1>

        <p class="text-slate-500 mt-2">
            Perbarui data wilayah administrasi desa
        </p>

    </div>

    <!-- VALIDATION -->
    @if ($errors->any())

        <div class="bg-red-50 border border-red-200 rounded-2xl p-5">

            <ul class="space-y-1 text-sm text-red-600">

                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <!-- FORM -->
    <form method="POST"
          action="{{ route('admin.desa.update', $desa->id) }}"
          class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

        @csrf
        @method('PUT')

        <div class="p-8 space-y-6">

            <!-- NAMA DESA -->
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Nama Desa
                </label>

                <input type="text"
                       name="nama_desa"
                       value="{{ old('nama_desa', $desa->nama_desa) }}"
                       class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50"
                       required>

            </div>

            <!-- KODE DESA -->
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Kode Desa
                </label>

                <input type="text"
                       name="kode_desa"
                       value="{{ old('kode_desa', $desa->kode_desa) }}"
                       class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <!-- KECAMATAN -->
                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Kecamatan
                    </label>

                    <input type="text"
                           name="kecamatan"
                           value="{{ old('kecamatan', $desa->kecamatan) }}"
                           class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                </div>

                <!-- KABUPATEN -->
                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Kabupaten
                    </label>

                    <input type="text"
                           name="kabupaten"
                           value="{{ old('kabupaten', $desa->kabupaten) }}"
                           class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="border-t border-slate-100 px-8 py-5 bg-slate-50 flex items-center justify-end gap-4">

            <a href="{{ route('admin.desa.index') }}"
               class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-200 transition">
                Batal
            </a>

            <button class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-amber-100 transition">
                Update Desa
            </button>

        </div>

    </form>

</div>

@endsection
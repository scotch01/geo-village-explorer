@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between flex-wrap gap-4">

        <div>
            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Data Desa
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola wilayah desa dan struktur administrasi
            </p>
        </div>

        <a href="{{ route('admin.desa.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition-all active:scale-95">
            + Tambah Desa
        </a>

    </div>

    <!-- Flash Message -->
    <x-alert />

    <!-- TABLE -->
    <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

        @if($desas->count())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50 border-b border-slate-100 uppercase text-xs text-slate-500 tracking-wider">

                        <tr>
                            <th class="px-6 py-5 text-left">Nama Desa</th>
                            <th class="px-6 py-5 text-left">Kode Desa</th>
                            <th class="px-6 py-5 text-left">Kecamatan</th>
                            <th class="px-6 py-5 text-left">Kabupaten</th>
                            <th class="px-6 py-5 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($desas as $desa)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-5 font-semibold text-slate-800">
                                    {{ $desa->nama_desa }}
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    {{ $desa->kode_desa ?? '-' }}
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    {{ $desa->kecamatan ?? '-' }}
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    {{ $desa->kabupaten ?? '-' }}
                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('admin.desa.edit', $desa->id) }}"
                                           class="px-4 py-2 rounded-xl bg-amber-100 text-amber-700 hover:bg-amber-200 font-semibold text-xs transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.desa.destroy', $desa->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus desa ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200 font-semibold text-xs transition">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="py-24 text-center">

                <div class="text-lg font-bold text-slate-700">
                    Belum ada data desa
                </div>

                <p class="text-slate-500 mt-2 text-sm">
                    Tambahkan desa pertama untuk memulai sistem RBAC wilayah
                </p>

            </div>

        @endif

    </div>

</div>

@endsection
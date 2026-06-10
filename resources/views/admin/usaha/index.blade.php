@extends('layouts.admin')

@section('content')

    <div class="space-y-6">

        <x-back-button :href="route('admin.tempat.survey', $tempat)">
            Kembali
        </x-back-button>

        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="min-w-0">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Data Usaha
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data usaha/perusahaan pada bangunan ini
                    </p>
                </div>

                @if ($tempat->jenis_bangunan === 'bc' || $tempat->usahas->count() === 0)
                    <a href="{{ route('admin.usaha.create', $tempat) }}" 
                       class="w-full sm:w-auto text-center px-4 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all active:scale-95 text-sm shadow-sm">
                        Tambah Usaha
                    </a>
                @endif
            </div>
        </div>

        <x-alert />

        @if ($usahas->isEmpty())
            <div class="bg-white border rounded-2xl p-10 text-center shadow-sm">
                <h3 class="font-semibold text-lg text-slate-800">
                    Belum Ada Data Usaha
                </h3>
                <p class="text-gray-500 mt-2 text-sm">
                    Tambahkan data usaha pertama untuk bangunan ini.
                </p>
            </div>
        @else
            <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto w-full block whitespace-nowrap min-w-full inline-block align-middle">
                    <table class="w-full min-w-[600px] divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/70">
                                <th class="px-6 py-4.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-16">
                                    No
                                </th>
                                <th class="px-6 py-4.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Nama Usaha
                                </th>
                                <th class="px-6 py-4.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Nama Pemilik
                                </th>
                                <th class="px-6 py-4.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Kategori Usaha
                                </th>
                                <th class="px-6 py-4.5 text-center text-xs font-bold text-gray-500 uppercase tracking-wider w-28">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach ($usahas as $usaha)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 max-w-xs truncate">
                                        {{ $usaha->nama_usaha ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $usaha->nama_pemilik ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-sm truncate">
                                        {{ $usaha->kategori_lapangan_usaha ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.usaha.show', $usaha) }}"
                                           class="inline-flex items-center justify-center px-4 py-1.5 bg-blue-600 text-white rounded-lg text-xs font-bold transition-all active:scale-95 hover:bg-blue-700 shadow-sm shadow-blue-600/10">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
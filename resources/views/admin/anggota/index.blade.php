@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        <x-back-button :href="route('admin.keluarga.show', $keluarga->tempat)">
            Kembali
        </x-back-button>

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Kelola Anggota Keluarga
                </h1>
                <p class="text-gray-500 mt-1 flex items-center gap-1.5 text-sm">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Kepala Keluarga: <span class="font-semibold text-gray-700">{{ $keluarga->nama_kepala_keluarga }}</span>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.anggota.create', $keluarga) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold transition-all active:scale-95 shadow-md shadow-blue-600/20 text-sm lg:text-base text-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Anggota
                </a>

                <a href="{{ route('admin.keluarga.edit', $keluarga->tempat) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold transition-all active:scale-95 shadow-md shadow-green-600/20 text-sm lg:text-base text-center">
                    Lanjut / Edit Keterangan Perumahan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Flash Message Notifikasi --}}
        <x-alert />

        {{-- Table Card --}}
        <div class="bg-white border rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50 border-b border-gray-100">
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-16">
                                No Urut
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Lengkap
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Hubungan Keluarga
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($anggotas as $anggota)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="px-6 py-4 text-sm text-center text-gray-600 font-medium">
                                    {{ $anggota->nomor_urut }}
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    {{ $anggota->nama }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span
                                        class="inline-flex px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700">
                                        {{ $anggota->hubungan_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.anggota.show', $anggota) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-slate-500 hover:bg-slate-600 text-white rounded-lg text-xs font-medium shadow-sm transition">
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-medium">Belum ada data anggota keluarga</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

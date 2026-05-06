@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- HEADER: Dibuat lebih tegas dengan visual yang bersih -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Data Usaha</h1>
            <p class="text-slate-500 font-medium">Kelola dan pantau seluruh direktori usaha lokal</p>
        </div>

        <a href="{{ route('admin.usaha.create') }}"
           class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 text-sm font-bold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Usaha
        </a>
    </div>

    <!-- SUCCESS MESSAGE: Dibuat lebih halus (Soft UI) -->
    @if(session('success'))
        <div class="flex items-center bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl text-sm shadow-sm animate-fade-in">
            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- TABLE CARD: Menggunakan border lembut dan shadow khas dashboard modern -->
    <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-200 overflow-hidden">

        @if($usahas->count())

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50/80 border-b border-slate-200 text-slate-400 uppercase text-[10px] font-black tracking-[0.1em]">
                    <tr>
                        <th class="px-6 py-4">Informasi Usaha</th>
                        <th class="px-6 py-4">Pemilik</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4 text-center">Koordinat (Lat, Long)</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach($usahas as $u)
                    <tr class="hover:bg-blue-50/30 transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 text-base group-hover:text-blue-600 transition-colors leading-tight">
                                    {{ $u->nama_usaha }}
                                </span>
                                <span class="text-xs text-slate-400 mt-0.5">Terdaftar pada direktori</span>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center text-slate-600 font-medium">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center mr-3 text-slate-400 font-bold text-xs uppercase border border-slate-200">
                                    {{ substr($u->nama_pemilik, 0, 1) }}
                                </div>
                                {{ $u->nama_pemilik }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $u->kategori_usaha ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $u->no_hp ?? '-' }}
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center">
                                <span class="inline-flex items-center bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg text-slate-500 text-xs font-mono tracking-tighter">
                                    <svg class="w-3 h-3 mr-1.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.828a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ number_format($u->latitude, 6) }}, {{ number_format($u->longitude, 6) }}
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @else

        <!-- EMPTY STATE: Didesain agar tidak terlihat membosankan -->
        <div class="text-center py-20">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 rounded-full mb-4 border-2 border-dashed border-slate-200">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Belum ada data usaha</h3>
            <p class="text-slate-500 text-sm mb-6">Database Anda saat ini masih kosong.</p>
            <a href="{{ route('admin.usaha.create') }}"
               class="inline-flex items-center text-blue-600 font-bold text-sm hover:text-blue-700">
                Tambahkan data pertama sekarang
                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        @endif

    </div>

</div>

@endsection
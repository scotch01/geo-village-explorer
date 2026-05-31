@extends('layouts.admin')

@section('content')

    <div class="space-y-8 animate-fade-in">

        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                    Data <span class="text-blue-600">Bangunan</span>
                </h1>
                <p class="text-slate-500 mt-2 font-medium">
                    Kelola data lokasi, bangunan, usaha dan pemetaan wilayah berbasis GIS.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.tempat.create') }}"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-2xl shadow-xl shadow-blue-200 text-sm font-bold transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Data
                </a>
            </div>
        </div>

        <!-- NOTIFICATION (Aurora Style) -->
        @if (session('success'))
            <div
                class="relative overflow-hidden bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 shadow-sm">
                <div class="absolute right-0 top-0 w-24 h-full bg-emerald-400/10 blur-2xl"></div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500 shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- FILTER CARD -->
        <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 shadow-sm relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-slate-50 rounded-full blur-3xl opacity-50"></div>

            <form method="GET" class="relative z-10">
                <div class="grid lg:grid-cols-4 gap-6">
                    <!-- SEARCH -->
                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">
                            Pencarian
                        </label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama lokasi..."
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium text-slate-700">
                        </div>
                    </div>

                    <!-- SEKTOR -->
                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">
                            Sektor
                        </label>
                        <select name="sektor"
                            class="w-full px-4 py-3 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium text-slate-700 appearance-none">
                            <option value="">Semua Sektor</option>
                            {{-- @foreach ($sektors as $key => $label)
                                <option value="{{ $key }}" @selected(request('sektor') == $key)>{{ $label }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>

                    <!-- DESA -->
                    @if (auth()->user()->isMasterAdmin())
                        <div class="space-y-2">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">
                                Wilayah Desa
                            </label>
                            <select name="desa"
                                class="w-full px-4 py-3 bg-slate-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium text-slate-700 appearance-none">
                                <option value="">Semua Desa</option>
                                @foreach ($desas as $desa)
                                    <option value="{{ $desa->id }}" @selected(request('desa') == $desa->id)>{{ $desa->nama_desa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- ACTIONS -->
                    <div class="flex items-end gap-3">
                        <button
                            class="flex-1 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-bold py-3 transition-all active:scale-95 shadow-lg shadow-slate-200">
                            Filter
                        </button>
                        <a href="{{ route('admin.tempat.index') }}"
                            class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition-all active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- DATA TABLE -->
        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            @if ($tempats->total() > 0)
                <!-- TABLE HEADER/PAGING CONTROL -->
                <div
                    class="px-8 py-6 border-b border-slate-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/30">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                            {{ $tempats->total() }}
                        </span>
                        Entri Lokasi Ditemukan
                    </h3>

                    <form method="GET" class="flex items-center gap-3">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rows:</span>
                        <select name="per_page" onchange="this.form.submit()"
                            class="pl-3 pr-8 py-1.5 text-xs bg-white border border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 font-bold text-slate-700 cursor-pointer">
                            @foreach ([10, 25, 50, 100] as $v)
                                <option value="{{ $v }}" {{ request('per_page', 10) == $v ? 'selected' : '' }}>
                                    {{ $v }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-black">
                                <th class="px-8 py-5 text-center w-20">No</th>
                                <th class="px-8 py-5">Detail Tempat</th>
                                <th class="px-8 py-5">Sektor</th>
                                <th class="px-8 py-5">Wilayah</th>
                                <th class="px-8 py-5">Alamat</th>
                                <th class="px-8 py-5 text-center">
                                    Status Pendataan
                                </th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($tempats as $index => $tempat)
                                <tr class="group hover:bg-slate-50/50 transition-all">
                                    <td class="px-8 py-6 text-center font-bold text-slate-400">
                                        {{ $tempats->firstItem() + $index }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <div
                                            class="font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                            {{ $tempat->nama_tempat }}
                                        </div>
                                        @if ($tempat->nama_pemilik)
                                            <div
                                                class="flex items-center gap-1.5 text-[11px] text-slate-400 mt-1 font-bold uppercase tracking-tight">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                {{ $tempat->nama_pemilik }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="inline-flex px-3 py-1.5 rounded-xl bg-blue-50 text-blue-700 text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                            {{-- {{ \App\Models\Tempat::sektorLabel($tempat->sektor) }} --}}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="font-bold text-slate-600 text-sm">
                                            {{ $tempat->desa->nama_desa ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="text-slate-500 text-sm italic font-medium line-clamp-2 max-w-xs">
                                            {{ $tempat->alamat }}
                                        </p>
                                    </td>
                                    <td class="px-8 py-6 text-center">

                                        @if ($tempat->status_pendataan === 'selesai')
                                            <span
                                                class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                                Selesai
                                            </span>
                                        @elseif($tempat->status_pendataan === 'parsial')
                                            <span
                                                class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                                Sebagian
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                                Belum
                                            </span>
                                        @endif

                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.tempat.survey', $tempat) }}"
                                                class="px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 text-xs font-semibold hover:bg-blue-200 transition">
                                                Pendataan
                                            </a>
                                            <a href="{{ route('admin.tempat.edit', $tempat->id) }}"
                                                class="p-2 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white transition-all shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.tempat.destroy', $tempat->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                @if ($tempats instanceof \Illuminate\Pagination\LengthAwarePaginator && $tempats->hasPages())
                    <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/20">
                        {{ $tempats->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <!-- EMPTY STATE -->
                <div class="py-28 text-center px-6 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-50/20 to-transparent"></div>
                    <div class="relative z-10">
                        <div class="w-24 h-24 bg-slate-100 rounded-[2rem] flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A2 2 0 013 15.487V6.513a2 2 0 011.553-1.943L9 2l5.447 2.724A2 2 0 0116 6.513v8.974a2 2 0 01-1.553 1.943L9 20zm0-18v18m0-18l5.447 2.724M9 20l-5.447-2.724" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Belum Ada Data Lokasi</h2>
                        <p class="text-slate-500 mt-3 max-w-md mx-auto font-medium">
                            Mulai bangun sistem pemetaan wilayah desa dengan menambahkan entri tempat pertama Anda.
                        </p>
                        <a href="{{ route('admin.tempat.create') }}"
                            class="inline-flex mt-8 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-2xl font-bold transition-all active:scale-95 shadow-xl shadow-blue-100">
                            Buat Data Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

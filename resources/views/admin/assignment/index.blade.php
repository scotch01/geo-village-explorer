@extends('layouts.admin')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto px-2 sm:px-0 animate-fade-in">

        <x-back-button :href="route('admin.user.index')">
            Kembali
        </x-back-button>

        <div
            class="flex items-center justify-between flex-wrap gap-4 bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
            <div>
                <h1 class="text-2xl lg:text-3xl font-black tracking-tight text-slate-900">
                    Assignment PML - PCL
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Kelola hubungan pemetaan pengawas (PML) dengan petugas lapangan (PCL) secara terpusat.
                </p>
            </div>

            <button type="submit" form="assignment-form"
                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-2xl font-bold text-sm shadow-md shadow-blue-600/10 transition-all active:scale-95 text-center">
                Simpan Assignment
            </button>
        </div>

        <x-alert />

        <form id="assignment-form" method="POST" action="{{ route('admin.pengawas-assignment.store') }}">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/70">
                        <div class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded-lg bg-blue-100 text-blue-700 font-bold text-xs">A</span>
                            <h2 class="text-base font-black text-slate-900 tracking-tight">
                                Daftar Pengawas (PML)
                            </h2>
                        </div>
                        <p class="text-xs text-slate-500 mt-1.5 pl-9">
                            Pilih salah satu baris pengawas aktif untuk menampilkan atau mengubah penugasan.
                        </p>
                    </div>

                    <div class="p-4 space-y-2.5 max-h-[500px] overflow-y-auto divide-y divide-transparent">
                        @foreach ($pengawas as $pml)
                            @php $isPmlSelected = $selectedPml == $pml->id; @endphp
                            <label
                                class="flex items-center gap-4 p-3.5 rounded-2xl border transition-all cursor-pointer select-none group
                                {{ $isPmlSelected
                                    ? 'border-blue-500 bg-blue-50/40 ring-1 ring-blue-500/20'
                                    : 'border-slate-100 hover:border-slate-200 hover:bg-slate-50/80' }}">

                                <div class="flex items-center justify-center shrink-0">
                                    <input type="radio" name="pml_id" value="{{ $pml->id }}"
                                        class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500/30 focus:ring-offset-0 transition cursor-pointer"
                                        onchange="window.location = '?pml_id={{ $pml->id }}'"
                                        {{ $isPmlSelected ? 'checked' : '' }}>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div
                                        class="font-bold text-sm text-slate-900 group-hover:text-blue-900 transition-colors">
                                        {{ $pml->name }}
                                    </div>
                                    <div class="text-xs font-semibold text-slate-400 mt-0.5 uppercase tracking-wider">
                                        PML / Pengawas Lapangan
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/70">
                        <div class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-6 h-6 rounded-lg bg-emerald-100 text-emerald-700 font-bold text-xs">B</span>
                            <h2 class="text-base font-black text-slate-900 tracking-tight">
                                Daftar PCL (Admin Desa)
                            </h2>
                        </div>
                        <p class="text-xs text-slate-500 mt-1.5 pl-9">
                            Beri tanda centang pada satu atau beberapa mitra lapangan untuk di-assign ke PML terpilih.
                        </p>
                    </div>

                    <div class="p-4 space-y-2.5 max-h-[500px] overflow-y-auto">
                        @php
                            $assignedPcls = collect();
                            if (isset($existing[$selectedPml])) {
                                $assignedPcls = $existing[$selectedPml]->pluck('pcl_id');
                            }
                        @endphp

                        @foreach ($pcls as $pcl)
                            @php $isPclChecked = $assignedPcls->contains($pcl->id); @endphp
                            <label
                                class="flex items-center gap-4 p-3.5 rounded-2xl border transition-all cursor-pointer select-none group
                                {{ $isPclChecked
                                    ? 'border-emerald-500 bg-emerald-50/30'
                                    : 'border-slate-100 hover:border-slate-200 hover:bg-slate-50/80' }}">

                                <div class="flex items-center justify-center shrink-0">
                                    <input type="checkbox" name="pcl_ids[]" value="{{ $pcl->id }}"
                                        class="w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500/30 focus:ring-offset-0 transition cursor-pointer"
                                        {{ $isPclChecked ? 'checked' : '' }}>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div
                                        class="font-bold text-sm text-slate-900 group-hover:text-emerald-900 transition-colors">
                                        {{ $pcl->name }}
                                    </div>
                                    <div
                                        class="inline-flex items-center mt-1 text-xs font-medium text-slate-500 bg-slate-100 group-hover:bg-white border px-2 py-0.5 rounded-md transition-colors">
                                        Admin Desa: {{ $pcl->desa->nama_desa ?? '-' }}
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div x-data="{
        showConflictModal: {{ session()->has('assignment_conflicts') ? 'true' : 'false' }}
    }" class="space-y-6 max-w-7xl mx-auto px-2 sm:px-0 animate-fade-in">

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

        @if (session('assignment_conflicts'))
            <div x-show="showConflictModal" class="fixed inset-0 z-[99999] flex items-center justify-center"
                style="display:none;" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-3"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-3">

                {{-- BACKDROP --}}
                <div class="fixed inset-0 z-[99999] bg-black/50 backdrop-blur-sm" @click="showConflictModal = false"></div>

                {{-- MODAL --}}
                <div @click.away="showConflictModal = false"
                    class="relative z-[99999] bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl overflow-hidden">

                    {{-- HEADER --}}
                    <div class="px-8 py-6 border-b border-slate-100">

                        <h2 class="text-xl font-black text-slate-900">
                            Assignment Sudah Digunakan
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Beberapa PCL sudah berada di bawah pengawas lain.
                        </p>

                    </div>

                    {{-- BODY --}}
                    <div class="p-8">

                        <div class="space-y-4">

                            @foreach (session('assignment_conflicts') as $conflict)
                                <div class="border border-amber-200 bg-amber-50 rounded-2xl p-4">

                                    <div class="font-bold text-slate-900">
                                        {{ $conflict->pcl->name }}
                                    </div>

                                    <div class="text-sm text-slate-600 mt-1">
                                        Saat ini ditugaskan ke:
                                        <span class="font-semibold">
                                            {{ $conflict->pml->name }}
                                        </span>
                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <div class="mt-6 rounded-2xl bg-slate-50 border border-slate-200 p-4">

                            <p class="text-sm text-slate-700 leading-relaxed">

                                Jika dilanjutkan, assignment lama akan dihapus dan seluruh
                                PCL di atas akan dipindahkan ke pengawas yang sedang dipilih.

                            </p>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">

                        <button type="button" @click="showConflictModal = false"
                            class="px-5 py-2.5 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold transition-all active:scale-95">
                            Batal
                        </button>

                        <form method="POST" action="{{ route('admin.pengawas-assignment.store') }}">
                            @csrf

                            <input type="hidden" name="pml_id" value="{{ session('pending_assignment.pml_id') }}">

                            @foreach (session('pending_assignment.pcl_ids', []) as $pclId)
                                <input type="hidden" name="pcl_ids[]" value="{{ $pclId }}">
                            @endforeach

                            <input type="hidden" name="force_update" value="1">

                            <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold transition-all active:scale-95">
                                Ya, Pindahkan Assignment
                            </button>

                        </form>

                    </div>

                </div>

            </div>
        @endif

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
@push('modals')
@endpush

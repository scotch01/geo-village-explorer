@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                Manajemen <span class="text-blue-600">Data</span>
            </h1>

            <p class="text-slate-500 mt-2 font-medium">
                Kelola seluruh master data dan konfigurasi aplikasi SPECTRA.
            </p>
        </div>

        {{-- MENU --}}
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

            {{-- DESA --}}
            <a href="{{ route('admin.desa.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">
                            Desa
                        </h2>

                        <p class="mt-2 text-slate-500">
                            Kelola data desa yang digunakan dalam sistem.
                        </p>
                    </div>

                    <div
                        class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600group-hover:scale-110transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6" />
                        </svg>
                    </div>
                </div>
            </a>

            {{-- USER --}}
            <a href="{{ route('admin.user.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">
                            User
                        </h2>
                        <p class="mt-2 text-slate-500">
                            Kelola akun administrator dan pengawas.
                        </p>
                    </div>

                    <div
                        class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 group-hover:scale-110 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V9L12 3 2 9v11h5m10 0v-6H7v6m10 0H7" />
                        </svg>
                    </div>
                </div>
            </a>

            {{-- PORTAL --}}
            <a href="{{ route('admin.portal-item.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">
                            Portal Data
                        </h2>
                        <p class="mt-2 text-slate-500">
                            Kelola publikasi dan metadata desa.
                        </p>
                    </div>

                    <div
                        class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-600 group-hover:scale-110 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>
                    </div>
                </div>
            </a>

            {{-- EXPORT --}}
            <a href="{{ route('admin.export.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">
                            Export Data
                        </h2>
                        <p class="mt-2 text-slate-500">
                            Export seluruh data hasil pendataan.
                        </p>
                    </div>

                    <div
                        class="w-16 h-16 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600 group-hover:scale-110 transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-6m3 6V7m3 10v-4m4 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </a>

            {{-- LAYANAN --}}
            <div class="rounded-[2rem] border-2 border-dashed border-slate-300 bg-slate-50 p-8">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-slate-400">
                            Layanan
                        </h2>
                        <p class="mt-2 text-slate-400">
                            Modul akan segera tersedia.
                        </p>
                    </div>

                    <div class="w-16 h-16  rounded-2xl bg-slate-200 flex items-center justify-center text-slate-400">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 9h8M8 13h5m-7 8h12a2 2 0 002-2V7l-4-4H6a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

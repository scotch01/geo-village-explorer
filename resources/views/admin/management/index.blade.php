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

                <div class="flex items-start justify-between h-full">

                    {{-- TEXT --}}
                    <div class="flex-1 pr-4">

                        <h2 class="text-2xl font-black text-slate-900">
                            Desa
                        </h2>

                        <p class="mt-2 text-slate-500 line-clamp-2">
                            Kelola data desa yang digunakan dalam sistem.
                        </p>

                    </div>

                    {{-- ICON --}}
                    <div
                        class="w-14 h-14 shrink-0 rounded-2xl bg-emerald-100 flex items-center justify-center group-hover:scale-110 transition-transform">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6" />

                        </svg>

                    </div>

                </div>

            </a>

            {{-- USER --}}
            <a href="{{ route('admin.user.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">

                <div class="flex items-start justify-between h-full">

                    {{-- TEXT --}}
                    <div class="flex-1 pr-4">

                        <h2 class="text-2xl font-black text-slate-900">
                            User
                        </h2>

                        <p class="mt-2 text-slate-500 line-clamp-2">
                            Kelola akun administrator dan pengawas.
                        </p>

                    </div>

                    {{-- ICON --}}
                    <div
                        class="w-14 h-14 shrink-0 rounded-2xl bg-blue-100  flex items-center justify-center group-hover:scale-110 transition-transform">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" width="1em" height="1em"
                            viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </g>
                        </svg>


                    </div>

                </div>

            </a>

            {{-- PORTAL --}}
            <a href="{{ route('admin.portal-item.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">

                <div class="flex items-start justify-between h-full">

                    {{-- TEXT --}}
                    <div class="flex-1 pr-4">

                        <h2 class="text-2xl font-black text-slate-900">
                            Portal Data
                        </h2>

                        <p class="mt-2 text-slate-500 line-clamp-2">
                            Kelola publikasi dan metadata desa.
                        </p>

                    </div>

                    {{-- ICON --}}
                    <div
                        class="w-14 h-14 shrink-0 rounded-2xl bg-purple-100  flex items-center justify-center group-hover:scale-110 transition-transform">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>

                    </div>

                </div>

            </a>

            {{-- EXPORT --}}
            <a href="{{ route('admin.export.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">

                <div class="flex items-start justify-between h-full">

                    {{-- TEXT --}}
                    <div class="flex-1 pr-4">

                        <h2 class="text-2xl font-black text-slate-900">
                            Export Data
                        </h2>

                        <p class="mt-2 text-slate-500 line-clamp-2">
                            Export seluruh data hasil pendataan.
                        </p>

                    </div>

                    {{-- ICON --}}
                    <div
                        class="w-14 h-14 shrink-0 rounded-2xl bg-amber-100  flex items-center justify-center group-hover:scale-110 transition-transform">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-6m3 6V7m3 10v-4m4 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                </div>

            </a>

            {{-- LAYANAN --}}
            <a href="{{ route('admin.service-setting.index') }}"
                class="group rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm hover:-translate-y-1 hover:shadow-xl transition-all">

                <div class="flex items-start justify-between h-full">

                    {{-- TEXT --}}
                    <div class="flex-1 pr-4">

                        <h2 class="text-2xl font-black text-slate-900">
                            Layanan
                        </h2>

                        <p class="mt-2 text-slate-500 line-clamp-2">
                            Kelola informasi layanan publik setiap desa.
                        </p>

                    </div>

                    {{-- ICON --}}
                    <div
                        class="w-14 h-14 shrink-0 rounded-2xl bg-cyan-100  flex items-center justify-center group-hover:scale-110 transition-transform">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-cyan-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V4H2v16h5m10 0v-6H7v6m10 0H7" />
                        </svg>
                    </div>

                </div>

            </a>
        </div>
    </div>
@endsection

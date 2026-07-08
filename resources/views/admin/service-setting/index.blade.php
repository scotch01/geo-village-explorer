@extends('layouts.admin')

@section('content')

    <div class="space-y-6">

        <x-back-button :href="route('admin.management.index')">
            Kembali
        </x-back-button>

        {{-- HEADER --}}
        <div class="flex items-center justify-between flex-wrap gap-4">

            <div>

                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">

                    Layanan <span class="text-blue-600">Publik</span>

                </h1>

                <p class="text-slate-500 mt-2 font-medium">

                    Kelola informasi layanan publik setiap desa.

                </p>

            </div>

            <a href="{{ route('admin.service-setting.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition-all active:scale-95">

                + Tambah Layanan

            </a>

        </div>

        <x-alert />

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @if ($services->count())

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead
                            class="bg-slate-50 border-b border-slate-100 uppercase text-xs tracking-wider text-slate-500">

                            <tr>

                                <th class="px-6 py-5 text-left">

                                    Desa

                                </th>

                                <th class="px-6 py-5 text-center">

                                    Maklumat

                                </th>

                                <th class="px-6 py-5 text-left">

                                    WhatsApp

                                </th>

                                <th class="px-6 py-5 text-left">

                                    Email

                                </th>

                                <th class="px-6 py-5 text-center">

                                    Status

                                </th>

                                <th class="px-6 py-5 text-center">

                                    Aksi

                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach ($services as $service)

                                <tr class="hover:bg-slate-50 transition">

                                    {{-- DESA --}}
                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-slate-800">

                                            {{ $service->desa->nama_desa }}

                                        </div>

                                    </td>

                                    {{-- MAKLUMAT --}}
                                    <td class="px-6 py-5 text-center">

                                        @if ($service->maklumat_image)

                                            <img
                                                src="{{ asset('storage/'.$service->maklumat_image) }}"
                                                class="w-20 h-20 object-cover rounded-xl border border-slate-200 mx-auto">

                                        @else

                                            <span class="text-slate-400 text-xs">

                                                Belum ada

                                            </span>

                                        @endif

                                    </td>

                                    {{-- WA --}}
                                    <td class="px-6 py-5 text-slate-600">

                                        {{ $service->whatsapp ?? '-' }}

                                    </td>

                                    {{-- EMAIL --}}
                                    <td class="px-6 py-5 text-slate-600">

                                        {{ $service->email ?? '-' }}

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-5 text-center">

                                        @if($service->is_active)

                                            <span
                                                class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">

                                                Aktif

                                            </span>

                                        @else

                                            <span
                                                class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                                                Nonaktif

                                            </span>

                                        @endif

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-5">

                                        <div class="flex justify-center gap-2">

                                            <a
                                                href="{{ route('admin.service-setting.edit',$service) }}"
                                                class="px-4 py-2 rounded-xl bg-amber-100 text-amber-700 hover:bg-amber-200 text-xs font-semibold transition-all active:scale-95">

                                                Edit

                                            </a>

                                            <form
                                                action="{{ route('admin.service-setting.destroy',$service) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus layanan ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200 text-xs font-semibold transition-all active:scale-95">

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

                        Belum ada layanan

                    </div>

                    <p class="text-slate-500 mt-2">

                        Tambahkan layanan pertama.

                    </p>

                </div>

            @endif

        </div>

    </div>

@endsection
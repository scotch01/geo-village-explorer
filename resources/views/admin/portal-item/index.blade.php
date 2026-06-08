@extends('layouts.admin')

@section('content')

    <div class="space-y-6">

        <div class="flex items-center justify-between flex-wrap gap-4">

            <div>

                <h1 class="text-3xl font-black tracking-tight text-slate-900">
                    Portal Items
                </h1>

                <p class="text-slate-500 mt-2">
                    Kelola item publikasi, data desa, metadata, dan informasi lainnya
                </p>

            </div>

            <a href="{{ route('admin.portal-item.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition">

                + Tambah Item

            </a>

        </div>

        <x-alert />

        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @if ($items->count())
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50 border-b border-slate-100 uppercase text-xs text-slate-500 tracking-wider">

                            <tr>

                                <th class="px-6 py-5 text-left">
                                    Judul
                                </th>

                                <th class="px-6 py-5 text-left">
                                    Kategori
                                </th>

                                <th class="px-6 py-5 text-center">
                                    Tipe File
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

                            @foreach ($items as $item)
                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-slate-800">

                                            {{ $item->title }}

                                        </div>

                                        @if ($item->description)
                                            <div class="text-xs text-slate-500 mt-1">

                                                {{ Str::limit($item->description, 80) }}

                                            </div>
                                        @endif

                                    </td>

                                    <td class="px-6 py-5 text-slate-600">

                                        {{ $item->category?->name }}

                                    </td>

                                    <td class="px-6 py-5 text-center">

                                        {{ strtoupper($item->file_type) }}

                                    </td>

                                    <td class="px-6 py-5 text-center">

                                        @if ($item->is_active)
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

                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <a href="{{ route('admin.portal-item.edit', $item) }}"
                                                class="px-4 py-2 rounded-xl bg-amber-100 text-amber-700 hover:bg-amber-200 font-semibold text-xs transition">

                                                Edit

                                            </a>

                                            <form action="{{ route('admin.portal-item.destroy', $item) }}"
                                                method="POST" onsubmit="return confirm('Hapus item ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200 font-semibold text-xs transition">

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

                        Belum ada item

                    </div>

                    <p class="text-slate-500 mt-2 text-sm">

                        Tambahkan item pertama untuk memulai portal data

                    </p>

                </div>
            @endif

        </div>

    </div>

@endsection

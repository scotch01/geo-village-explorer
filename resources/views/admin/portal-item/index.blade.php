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

            <div class="grid grid-cols-2 gap-4">

                <a href="{{ route('admin.portal-category.index') }}"
                    class="bg-slate-600 hover:bg-slate-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition-all active:scale-95">

                    Kelola Kategori

                </a>

                <a href="{{ route('admin.portal-item.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition-all active:scale-95">

                    + Tambah Item

                </a>
            </div>

        </div>

        <x-alert />

        <div>
            <form method="GET" class="bg-white border border-slate-200 rounded-[2rem] p-6 shadow-sm">

                <div class="grid lg:grid-cols-12 gap-4">

                    {{-- DESA --}}
                    <div class="lg:col-span-4">

                        <label class="text-sm font-semibold text-slate-700">
                            Desa
                        </label>

                        <select name="desa_id" class="w-full mt-2 rounded-2xl border-slate-200">

                            <option value="">
                                Semua Desa
                            </option>

                            @foreach ($desas as $desa)
                                <option value="{{ $desa->id }}" @selected(request('desa_id') == $desa->id)>

                                    {{ $desa->nama_desa }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- KATEGORI --}}
                    <div class="lg:col-span-4">

                        <label class="text-sm font-semibold text-slate-700">
                            Kategori
                        </label>

                        <select name="portal_category_id" class="w-full mt-2 rounded-2xl border-slate-200">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('portal_category_id') == $category->id)>

                                    {{ $category->name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- FILE TYPE --}}
                    <div class="lg:col-span-2">

                        <label class="text-sm font-semibold text-slate-700">
                            File Type
                        </label>

                        <select name="file_type" class="w-full mt-2 rounded-2xl border-slate-200">

                            <option value="">
                                Semua
                            </option>

                            @foreach ($fileTypes as $value => $label)
                                <option value="{{ $value }}" @selected(request('file_type') == $value)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- ACTION --}}
                    <div class="lg:col-span-2 flex items-end gap-2">

                        <a href="{{ route('admin.portal-item.index') }}"
                            class="px-4 py-3 rounded-2xl border border-slate-300 text-slate-600 hover:bg-slate-50 transition-all active:scale-95">
                            Reset
                        </a>

                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl py-3 font-semibold transition-all active:scale-95">
                            Filter
                        </button>

                    </div>

                </div>

            </form>
        </div>

        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @if ($items->count())
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead
                            class="bg-slate-50 border-b border-slate-100 uppercase text-xs text-slate-500 tracking-wider">

                            <tr>

                                <th class="px-6 py-5 text-left">
                                    Judul
                                </th>

                                <th class="px-6 py-5 text-left">
                                    Kategori
                                </th>

                                <th class="px-6 py-5 text-left">
                                    Desa
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

                                    <td class="px-6 py-5 text-slate-600">

                                        {{ $item->desa?->nama_desa }}

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
                                                class="px-4 py-2 rounded-xl bg-amber-100 text-amber-700 hover:bg-amber-200 font-semibold text-xs transition-all active:scale-95">

                                                Edit

                                            </a>

                                            <form action="{{ route('admin.portal-item.destroy', $item) }}" method="POST"
                                                onsubmit="return confirm('Hapus item ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200 font-semibold text-xs transition-all active:scale-95">

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

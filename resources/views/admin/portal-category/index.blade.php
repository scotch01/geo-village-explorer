@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-4">

        <div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Kategori Portal
            </h1>

            <p class="text-slate-500 mt-2">
                Kelola kategori publikasi, data desa, metadata, dan informasi lainnya
            </p>

        </div>

        <a
            href="{{ route('admin.portal-category.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition">

            + Tambah Kategori

        </a>

    </div>

    <x-alert />

    <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

        @if($categories->count())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50 border-b border-slate-100 uppercase text-xs text-slate-500 tracking-wider">

                        <tr>

                            <th class="px-6 py-5 text-left">
                                Nama Kategori
                            </th>

                            <th class="px-6 py-5 text-left">
                                Tipe
                            </th>

                            <th class="px-6 py-5 text-center">
                                Urutan
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

                        @foreach($categories as $category)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-5 font-semibold text-slate-800">

                                    {{ $category->name }}

                                </td>

                                <td class="px-6 py-5 text-slate-600">

                                    {{ config('portal.types')[$category->type] ?? $category->type }}

                                </td>

                                <td class="px-6 py-5 text-center text-slate-600">

                                    {{ $category->sort_order }}

                                </td>

                                <td class="px-6 py-5 text-center">

                                    @if($category->is_active)

                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">

                                            Aktif

                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-center gap-2">

                                        <a
                                            href="{{ route('admin.portal-category.edit', $category) }}"
                                            class="px-4 py-2 rounded-xl bg-amber-100 text-amber-700 hover:bg-amber-200 font-semibold text-xs transition">

                                            Edit

                                        </a>

                                        <form
                                            action="{{ route('admin.portal-category.destroy', $category) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus kategori ini?')">

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

                    Belum ada kategori portal

                </div>

                <p class="text-slate-500 mt-2 text-sm">

                    Tambahkan kategori pertama untuk memulai portal data

                </p>

            </div>

        @endif

    </div>

</div>

@endsection
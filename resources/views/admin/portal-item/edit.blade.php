@extends('layouts.admin')

@section('content')

    <div class="max-w-3xl mx-auto space-y-8">

        <div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Perbarui Item
            </h1>

            <p class="text-slate-500 mt-2">
                Perbarui data item untuk diakses oleh publik
            </p>

        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                <div class="font-semibold text-red-700 mb-2">

                    Terdapat data wajib yang belum lengkap:

                </div>

                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif

        <form method="POST" action="{{ route('admin.portal-item.update', $item) }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf
            @method('PUT')

            <div class="p-8 space-y-6">

                <div>

                    <label class="text-sm font-semibold text-slate-700">

                        Ketegori

                    </label>

                    <select name="portal_category_id" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                        <option value="">
                            Pilih Kategori
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('portal_category_id', $item->portal_category_id) == $category->id)>

                                {{ $category->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="text-sm font-semibold text-slate-700">

                        Desa

                    </label>

                    <select name="desa_id" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                        @foreach ($desas as $desa)
                            <option value="{{ $desa->id }}" @selected(old('desa_id', $item->desa_id) == $desa->id)>

                                {{ $desa->nama_desa }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="text-sm font-semibold text-slate-700">

                        Judul

                    </label>

                    <input type="text" name="title" value="{{ old('title', $item->title) }}"
                        class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            Deskripsi

                        </label>

                        <textarea name="description" rows="4" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">{{ old('description', $item->description) }}</textarea>

                    </div>

                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            Jenis File

                        </label>

                        <select name="file_type" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                            @foreach ($fileTypes as $value => $label)
                                <option value="{{ $value }}" @selected(old('file_type', $item->file_type) == $value)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            Link / URL

                        </label>

                        <input type="url" name="url" value="{{ old('url', $item->url) }}"
                            class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                    </div>

                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            Status

                        </label>

                        <select name="is_active" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">
                            <option value="1" @selected(old('is_active', $item->is_active) == 1)>
                                Aktif
                            </option>

                            <option value="0" @selected(old('is_active', $item->is_active) == 0)>
                                Nonaktif
                            </option>
                        </select>

                    </div>

                </div>

            </div>

            <div class="border-t border-slate-100 px-8 py-5 bg-slate-50 flex items-center justify-end gap-4">

                <a href="{{ route('admin.portal-item.index') }}"
                    class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-200 transition-all active:scale-95">

                    Batal

                </a>

                <button
                    class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition-all active:scale-95">

                    Simpan Item

                </button>

            </div>

        </form>

    </div>

@endsection

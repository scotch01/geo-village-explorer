@extends('layouts.admin')

@section('content')

    <div class="max-w-3xl mx-auto space-y-8">

        <div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Tambah Item
            </h1>

            <p class="text-slate-500 mt-2">
                Tambahkan data item untuk diakses oleh publik
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

        <form method="POST" action="{{ route('admin.portal-item.store') }}" enctype="multipart/form-data"
            x-data="{
                fileType: '{{ old('file_type', 'pdf') }}',
                preview: null
            }" class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf

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
                            <option value="{{ $category->id }}">
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

                        <option value="">

                            Pilih Desa

                        </option>

                        @foreach ($desas as $desa)
                            <option value="{{ $desa->id }}" @selected(old('desa_id') == $desa->id)>

                                {{ $desa->nama_desa }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="text-sm font-semibold text-slate-700">

                        Judul

                    </label>

                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Deskripsi --}}
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Deskripsi
                        </label>

                        <textarea name="description" rows="4" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">{{ old('description') }}</textarea>

                    </div>

                    {{-- Jenis File --}}
                    <div>

                        <label class="text-sm font-semibold text-slate-700">
                            Jenis File
                        </label>

                        <select name="file_type" x-model="fileType"
                            class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                            @foreach ($fileTypes as $value => $label)
                                <option value="{{ $value }}" @selected(old('file_type') == $value)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- URL --}}
                    <div x-show="fileType !== 'image'" x-transition>

                        <label class="text-sm font-semibold text-slate-700">
                            Link / URL
                        </label>

                        <input type="url" name="url" value="{{ old('url') }}"
                            class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                    </div>

                    {{-- Upload Image --}}
                    <div x-show="fileType === 'image'" x-transition class="space-y-4">

                        <div>

                            <label class="text-sm font-semibold text-slate-700">

                                Upload Gambar

                            </label>

                            <input type="file" name="image" accept="image/*"
                                class="
                block w-full mt-2
                text-sm text-slate-500
                file:mr-3
                file:py-2.5
                file:px-4
                file:rounded-2xl
                file:border-0
                file:text-sm
                file:font-bold
                file:bg-blue-50
                file:text-blue-700
                hover:file:bg-blue-100
                file:transition-colors
                cursor-pointer
                border
                border-slate-200
                rounded-2xl
                bg-slate-50
            "
                                @change="
                const file = $event.target.files[0];

                if(file){

                    preview = URL.createObjectURL(file);

                }else{

                    preview = null;

                }
            ">

                            <p class="mt-2 text-xs text-slate-500">

                                JPG, JPEG, PNG akan otomatis dikonversi menjadi WebP.

                            </p>

                        </div>

                        <template x-if="preview">

                            <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">

                                <img :src="preview" class="w-full max-h-72 object-contain">

                            </div>

                        </template>

                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            Status

                        </label>

                        <select name="is_active" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                            <option value="1">
                                Aktif
                            </option>

                            <option value="0">
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
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition-all active:scale-95">

                    Simpan Item

                </button>

            </div>

        </form>

    </div>

@endsection

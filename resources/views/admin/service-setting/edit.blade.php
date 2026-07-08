@extends('layouts.admin')

@section('content')

    <div class="max-w-5xl mx-auto space-y-8">

        <div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">

                Perbarui Layanan

            </h1>

            <p class="text-slate-500 mt-2">

                Perbarui informasi layanan dan metode pelayanan.

            </p>

        </div>

        @if ($errors->any())

            <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

                <div class="font-semibold text-red-700 mb-2">

                    Terdapat data yang belum lengkap.

                </div>

                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            action="{{ route('admin.service-setting.update', $service) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">

            @csrf
            @method('PUT')

            @include('admin.service-setting._form')

            <div
                class="border-t border-slate-100 px-8 py-5 bg-slate-50 flex items-center justify-end gap-4">

                <a
                    href="{{ route('admin.service-setting.index') }}"
                    class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-200 transition-all active:scale-95">

                    Batal

                </a>

                <button
                    class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-amber-100 transition-all active:scale-95">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

@endsection
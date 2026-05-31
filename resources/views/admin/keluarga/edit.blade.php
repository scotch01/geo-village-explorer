@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Perbarui Data Keluarga
            </h1>

            <p class="text-gray-500 mt-1">
                {{ $tempat->nama_tempat }}
            </p>

        </div>

        <form method="POST" action="{{ route('admin.keluarga.update', $tempat) }}" class="space-y-6">

            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border p-6">

                <h2 class="font-semibold text-lg mb-5">
                    Identitas Keluarga
                </h2>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Nama Kepala Keluarga
                        </label>

                        <input type="text" name="nama_kepala_keluarga"
                            value="{{ old('nama_kepala_keluarga', $keluarga->nama_kepala_keluarga) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            NIK Kepala Keluarga
                        </label>

                        <input type="text" name="nik_kepala_keluarga"
                            value="{{ old('nik_kepala_keluarga', $keluarga->nik_kepala_keluarga) }}" maxlength="16"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Nomor KK
                        </label>

                        <input type="text" name="nomor_kk" value="{{ old('nomor_kk', $keluarga->nomor_kk) }}" maxlength="16"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                </div>
            </div>

            <div class="bg-white rounded-2xl border p-6">

                <h2 class="font-semibold text-lg mb-5">
                    Alamat
                </h2>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Provinsi
                        </label>

                        <input type="text" name="provinsi" value="{{ old('provinsi', $keluarga->provinsi) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Kabupaten/Kota
                        </label>

                        <input type="text" name="kabupaten" value="{{ old('kabupaten', $keluarga->kabupaten) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Kecamatan
                        </label>

                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $keluarga->kecamatan) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Desa/Kelurahan
                        </label>

                        <input type="text" name="desa" value="{{ old('desa', $keluarga->desa) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Dusun
                        </label>

                        <input type="text" name="dusun" value="{{ old('dusun', $keluarga->dusun) }}"
                            class="w-full rounded-xl border-gray-300">

                    </div>

                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium mb-2">
                            Alamat Lengkap
                        </label>

                        <textarea name="alamat_detail" rows="4" class="w-full rounded-xl border-gray-300">{{ old('alamat_detail', $keluarga->alamat_detail) }}</textarea>

                    </div>

                </div>

                <div class="flex justify-end">

                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl">

                        Simpan Perubahan

                    </button>

                </div>

        </form>

        <form action="{{ route('admin.keluarga.destroy', $tempat) }}" method="POST"
            onsubmit="return confirm('Hapus data keluarga ini?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="px-5 py-3 rounded-xl bg-red-600 text-white">

                Hapus Data

            </button>

        </form>

    </div>
@endsection

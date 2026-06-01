@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        <div>

            <h1 class="text-2xl font-bold">
                Kelola Anggota Keluarga
            </h1>

            <p class="text-gray-500 mt-1">
                {{ $keluarga->nama_kepala_keluarga }}
            </p>

        </div>

        <div>

            <a href="{{ route('admin.anggota.create', $keluarga) }}"
                class="inline-flex px-4 py-2 rounded-xl bg-blue-600 text-white">

                Tambah Anggota

            </a>

            <a href="{{ route('admin.keluarga.edit', $keluarga->tempat) }}"
                class="inline-flex px-4 py-2 rounded-xl bg-green-600 text-white">

                Lanjutkan Keterangan Perumahan

            </a>

        </div>

        <div class="bg-white border rounded-2xl overflow-hidden">

            <table class="w-full">

                <thead>

                    <tr class="bg-slate-50">

                        <th class="px-6 py-4 text-left">
                            No
                        </th>

                        <th class="px-6 py-4 text-left">
                            Nama
                        </th>

                        <th class="px-6 py-4 text-left">
                            Hubungan
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($anggotas as $anggota)
                        <tr class="border-t">

                            <td class="px-6 py-4">

                                {{ $anggota->nomor_urut }}

                            </td>

                            <td class="px-6 py-4 font-medium">

                                {{ $anggota->nama }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $anggota->hubungan_label }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex gap-2">

                                    <a href="{{ route('admin.anggota.edit', $anggota) }}"
                                        class="px-3 py-1 bg-amber-500 text-white rounded-lg text-sm">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.anggota.destroy', $anggota) }}" method="POST"
                                        onsubmit="return confirm('Hapus anggota ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">

                                Belum ada anggota keluarga

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection

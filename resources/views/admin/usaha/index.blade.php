@extends('layouts.admin')

@section('content')

    <div class="space-y-6">

        <div class="bg-white border rounded-2xl p-6">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-2xl font-bold">
                        Data Usaha
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Kelola data usaha/perusahaan pada bangunan ini
                    </p>

                </div>

                <a href="{{ route('admin.usaha.create', $tempat) }}" class="px-4 py-2 bg-green-600 text-white rounded-xl">

                    Tambah Usaha

                </a>

            </div>

        </div>

        @if ($usahas->isEmpty())
            <div class="bg-white border rounded-2xl p-10 text-center">

                <h3 class="font-semibold text-lg">
                    Belum Ada Data Usaha
                </h3>

                <p class="text-gray-500 mt-2">
                    Tambahkan data usaha pertama untuk bangunan ini.
                </p>

            </div>
        @else
            <div class="bg-white border rounded-2xl overflow-hidden">

                <table class="w-full">

                    <thead>

                        <tr class="bg-gray-50">

                            <th class="px-4 py-3 text-left">
                                No
                            </th>

                            <th class="px-4 py-3 text-left">
                                Nama Usaha
                            </th>

                            <th class="px-4 py-3 text-left">
                                Nama Pemilik
                            </th>

                            <th class="px-4 py-3 text-left">
                                Kategori Usaha
                            </th>

                            <th class="px-4 py-3 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($usahas as $usaha)
                            <tr class="border-t">

                                <td class="px-4 py-3">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $usaha->nama_usaha ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $usaha->nama_pemilik ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $usaha->kategori_lapangan_usaha ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-center">

                                    <a href="{{ route('admin.usaha.show', $usaha) }}"
                                        class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm">

                                        Detail

                                    </a>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        @endif
    </div>
@endsection

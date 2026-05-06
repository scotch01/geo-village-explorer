@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Data Tempat
            </h1>

            <p class="text-sm text-gray-500">
                Kelola data lokasi dan pemetaan wilayah
            </p>
        </div>

        <a href="{{ route('admin.tempat.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl shadow-sm text-sm font-semibold transition">
            + Tambah Tempat
        </a>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

        @if($tempats->count())

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">

                    <tr>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Sektor</th>
                        <th class="px-6 py-4 text-left">Alamat</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody class="divide-y">

                    @foreach($tempats as $tempat)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4">

                            <div class="font-semibold text-gray-800">
                                {{ $tempat->nama_tempat }}
                            </div>

                            @if($tempat->nama_pemilik)
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $tempat->nama_pemilik }}
                                </div>
                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                                {{ \App\Models\Tempat::sektorLabel($tempat->sektor) }}
                            </span>

                        </td>

                        <td class="px-6 py-4 text-gray-600 text-sm">
                            {{ $tempat->alamat }}
                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.tempat.edit', $tempat->id) }}"
                                   class="px-3 py-1.5 rounded-lg bg-yellow-100 text-yellow-700 text-xs font-semibold hover:bg-yellow-200 transition">
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.tempat.destroy', $tempat->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-xs font-semibold hover:bg-red-200 transition">
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

        <!-- EMPTY -->
        <div class="py-20 text-center">

            <div class="text-lg font-semibold text-gray-700">
                Belum ada data tempat
            </div>

            <p class="text-sm text-gray-500 mt-2">
                Tambahkan data pertama untuk memulai pemetaan wilayah
            </p>

        </div>

        @endif

    </div>

</div>

@endsection
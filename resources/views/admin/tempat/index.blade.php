@extends('layouts.admin')

@section('content')

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h1 class="text-3xl font-black tracking-tight text-slate-900">
                    Data Tempat
                </h1>

                <p class="text-slate-500 mt-2">
                    Kelola data lokasi, sektor, dan pemetaan wilayah berbasis GIS
                </p>

            </div>

            <div class="flex items-center gap-3">

                <a href="{{ route('admin.tempat.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl shadow-lg shadow-blue-100 text-sm font-semibold transition">

                    + Tambah Tempat

                </a>

            </div>

        </div>

        <!-- SUCCESS -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl text-sm">

                {{ session('success') }}

            </div>
        @endif

        <!-- FILTER -->
        <div class="bg-white border border-slate-200 rounded-[2rem] p-5 shadow-sm">

            <form method="GET">

                <div class="grid lg:grid-cols-4 gap-4">

                    <!-- SEARCH -->
                    <div>

                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-2">
                            Pencarian
                        </label>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama tempat..."
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500">

                    </div>

                    <!-- SEKTOR -->
                    <div>

                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-2">
                            Sektor
                        </label>

                        <select name="sektor"
                            class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">
                                Semua Sektor
                            </option>

                            @foreach ($sektors as $key => $label)
                                <option value="{{ $key }}" @selected(request('sektor') == $key)>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- DESA -->
                    @if (auth()->user()->isMasterAdmin())
                        <div>

                            <label class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-2">
                                Desa
                            </label>

                            <select name="desa"
                                class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500">

                                <option value="">
                                    Semua Desa
                                </option>

                                @foreach ($desas as $desa)
                                    <option value="{{ $desa->id }}" @selected(request('desa') == $desa->id)>

                                        {{ $desa->nama_desa }}

                                    </option>
                                @endforeach

                            </select>

                        </div>
                    @endif

                    <!-- BUTTON -->
                    <div class="flex items-end gap-3">

                        <button
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold py-3 transition">

                            Filter

                        </button>

                        <a href="{{ route('admin.tempat.index') }}"
                            class="px-4 py-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition text-sm font-medium">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">

            @if ($tempats->total() > 0)
                <div class="overflow-x-auto">

                    <div
                        class="bg-gray-50/50 px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                        <form method="GET" class="flex items-center gap-3">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tampilkan:</label>
                            <div class="relative">
                                <select name="per_page" onchange="this.form.submit()"
                                    class="pl-3 pr-8 py-1.5 text-sm bg-white border border-gray-200 rounded-lg focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 appearance-none cursor-pointer font-medium text-gray-700">
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10
                                    </option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25
                                    </option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                    </option>
                                    <option value="50" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>


                    <table class="w-full text-sm">

                        <thead
                            class="bg-slate-50 border-b border-slate-100 uppercase text-xs tracking-wider text-slate-500">

                            <tr>

                                <th class="px-2 py-5 text-center">
                                    No
                                </th>

                                <th class="px-6 py-5 text-left">
                                    Tempat
                                </th>

                                <th class="px-6 py-5 text-left">
                                    Sektor
                                </th>

                                <th class="px-6 py-5 text-left">
                                    Desa
                                </th>

                                <th class="px-6 py-5 text-left">
                                    Alamat
                                </th>

                                <th class="px-6 py-5 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach ($tempats as $index => $tempat)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-6 py-3 text-center">
                                        {{ $tempats->firstItem() + $index }}
                                    </td>
                                    <!-- TEMPAT -->
                                    <td class="px-6 py-5">

                                        <div class="font-bold text-slate-800">
                                            {{ $tempat->nama_tempat }}
                                        </div>

                                        @if ($tempat->nama_pemilik)
                                            <div class="text-xs text-slate-500 mt-1">
                                                {{ $tempat->nama_pemilik }}
                                            </div>
                                        @endif

                                    </td>

                                    <!-- SEKTOR -->
                                    <td class="px-6 py-5">

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">

                                            {{ \App\Models\Tempat::sektorLabel($tempat->sektor) }}

                                        </span>

                                    </td>

                                    <!-- DESA -->
                                    <td class="px-6 py-5 text-slate-600">

                                        {{ $tempat->desa->nama_desa ?? '-' }}

                                    </td>

                                    <!-- ALAMAT -->
                                    <td class="px-6 py-5 text-slate-600 max-w-sm">

                                        <div class="line-clamp-2">
                                            {{ $tempat->alamat }}
                                        </div>

                                    </td>

                                    <!-- ACTION -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <!-- EDIT -->
                                            <a href="{{ route('admin.tempat.edit', $tempat->id) }}"
                                                class="px-3 py-2 rounded-xl bg-yellow-100 text-yellow-700 text-xs font-bold hover:bg-yellow-200 transition">

                                                Edit

                                            </a>

                                            <!-- DELETE -->
                                            <form action="{{ route('admin.tempat.destroy', $tempat->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-3 py-2 rounded-xl bg-red-100 text-red-700 text-xs font-bold hover:bg-red-200 transition">

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                    @if ($tempats instanceof \Illuminate\Pagination\LengthAwarePaginator && $tempats->hasPages())
                        <div class="p-4 border-t">
                            {{ $tempats->appends(request()->query())->links() }}
                        </div>
                    @endif

                </div>
            @else
                <!-- EMPTY -->
                <div class="py-24 text-center px-6">

                    <div class="text-6xl mb-5">
                        🗺️
                    </div>

                    <div class="text-xl font-bold text-slate-700">
                        Belum ada data tempat
                    </div>

                    <p class="text-sm text-slate-500 mt-3 max-w-md mx-auto">
                        Tambahkan data pertama untuk mulai membangun sistem pemetaan wilayah desa berbasis GIS.
                    </p>

                    <a href="{{ route('admin.tempat.create') }}"
                        class="inline-flex mt-6 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl text-sm font-semibold transition">

                        + Tambah Tempat

                    </a>

                </div>
            @endif

        </div>

    </div>

@endsection

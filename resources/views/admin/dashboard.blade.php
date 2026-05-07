@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex items-end justify-between flex-wrap gap-6">

        <div>

            <h1 class="text-4xl font-black tracking-tight text-slate-900">
                Dashboard
            </h1>

            <p class="text-slate-500 mt-3 max-w-2xl">
                Monitoring data wilayah dan persebaran sektor berbasis geospasial.
            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('admin.tempat.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition">

                + Tambah Tempat

            </a>

            <a href="{{ route('public.peta') }}"
               target="_blank"
               class="bg-white border border-slate-200 hover:bg-slate-50 px-5 py-3 rounded-2xl font-semibold text-slate-700 transition">

                🌍 Buka Peta

            </a>

        </div>

    </div>

    <!-- STAT -->
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- TEMPAT -->
        <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">

            <div class="text-sm font-semibold text-slate-500">
                Total Tempat
            </div>

            <div class="text-4xl font-black text-slate-900 mt-4">
                {{ $totalTempat }}
            </div>

        </div>

        <!-- DESA -->
        <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">

            <div class="text-sm font-semibold text-slate-500">
                Total Desa
            </div>

            <div class="text-4xl font-black text-slate-900 mt-4">
                {{ $totalDesa }}
            </div>

        </div>

        <!-- USER -->
        <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">

            <div class="text-sm font-semibold text-slate-500">
                Total User
            </div>

            <div class="text-4xl font-black text-slate-900 mt-4">
                {{ $totalUser }}
            </div>

        </div>

        <!-- SEKTOR -->
        <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">

            <div class="text-sm font-semibold text-slate-500">
                Total Sektor
            </div>

            <div class="text-4xl font-black text-slate-900 mt-4">
                {{ $totalSektor }}
            </div>

        </div>

    </div>

    <!-- CHART + TABLE -->
    <div class="grid xl:grid-cols-3 gap-6">

        <!-- CHART -->
        <div class="xl:col-span-2 bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-xl font-black text-slate-900">
                        Distribusi Sektor
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Persebaran jumlah data berdasarkan sektor
                    </p>

                </div>

            </div>

            <div id="chart-sektor"></div>

        </div>

        <!-- TOP DESA -->
        <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm">

            <h2 class="text-xl font-black text-slate-900">
                Top Desa
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Desa dengan data terbanyak
            </p>

            <div class="mt-6 space-y-4">

                @forelse($topDesa as $item)

                    <div class="flex items-center justify-between">

                        <div>

                            <div class="font-semibold text-slate-800">
                                {{ $item->desa->nama_desa ?? '-' }}
                            </div>

                            <div class="text-xs text-slate-400 mt-1">
                                {{ $item->total }} lokasi
                            </div>

                        </div>

                        <div class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 font-black">
                            {{ $loop->iteration }}
                        </div>

                    </div>

                @empty

                    <div class="text-sm text-slate-400">
                        Belum ada data
                    </div>

                @endforelse

            </div>

        </div>

    </div>

    <!-- RECENT -->
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100">

            <h2 class="text-xl font-black text-slate-900">
                Aktivitas Terbaru
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Data lokasi terbaru yang ditambahkan
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-100 uppercase text-xs text-slate-500 tracking-wider">

                    <tr>
                        <th class="px-6 py-4 text-left">Tempat</th>
                        <th class="px-6 py-4 text-left">Sektor</th>
                        <th class="px-6 py-4 text-left">Desa</th>
                        <th class="px-6 py-4 text-left">Admin</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($recentTempats as $tempat)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-5 font-semibold text-slate-800">
                                {{ $tempat->nama_tempat }}
                            </td>

                            <td class="px-6 py-5">
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase">
                                    {{ $tempat->sektor }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-slate-600">
                                {{ $tempat->desa->nama_desa ?? '-' }}
                            </td>

                            <td class="px-6 py-5 text-slate-600">
                                {{ $tempat->creator->name ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="text-center py-12 text-slate-400">

                                Belum ada data

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

const sektorData = @json($chartSektor);

const chart = new ApexCharts(
    document.querySelector("#chart-sektor"),
    {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },

        series: [{
            name: 'Total',
            data: sektorData.map(item => item.total)
        }],

        xaxis: {
            categories: sektorData.map(item => item.sektor)
        },

        dataLabels: {
            enabled: false
        },

        stroke: {
            curve: 'smooth'
        }
    }
);

chart.render();

</script>

@endpush
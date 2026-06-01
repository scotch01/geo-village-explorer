@extends('layouts.admin')

@section('content')
    <div class="space-y-10 animate-fade-in">

        <!-- HEADER -->
        <div class="flex items-center justify-between flex-wrap gap-8">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                    Dashboard <span class="text-blue-600 block sm:inline">Overview</span>
                </h1>
                <p class="text-slate-500 mt-2 text-lg font-medium">
                    Monitoring data wilayah dan persebaran sektor berbasis geospasial.
                </p>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('public.peta') }}" target="_blank"
                    class="flex items-center gap-2 bg-white border border-slate-200 hover:border-blue-200 hover:bg-blue-50/30 px-6 py-3.5 rounded-2xl font-bold text-slate-700 transition-all active:scale-95 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A2 2 0 013 15.487V6.513a2 2 0 011.553-1.943L9 2l5.447 2.724A2 2 0 0116 6.513v8.974a2 2 0 01-1.553 1.943L9 20zm0-18v18m0-18l5.447 2.724M9 20l-5.447-2.724" />
                    </svg>
                    Buka Peta
                </a>

            </div>
        </div>

        <!-- MAIN GRID -->
        <div class="grid lg:grid-cols-12 gap-8">

            <!-- CHART SECTION -->
            <div class="lg:col-span-8 bg-white rounded-[2.5rem] border border-slate-200 p-8 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                            Distribusi Jenis Bangunan
                        </h2>
                        <p class="text-slate-500 font-medium mt-1">Perbandingan Bangunan Tempat Tinggal, Khusus Usaha, dan
                            Campuran</p>
                    </div>
                </div>

                <div id="chart-jenis-bangunan" class="min-h-[350px]"></div>
            </div>

            <!-- TOP DESA -->
            <div class="lg:col-span-4 bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/20 blur-[80px]"></div>

                <h2 class="text-2xl font-extrabold tracking-tight text-white relative z-10">
                    Leaderboard Desa
                </h2>
                <p class="text-slate-400 font-medium mt-1 relative z-10">Jumlah pendataan terbanyak</p>

                <div class="mt-10 space-y-5 relative z-10">
                    @forelse($topDesa as $item)
                        <div
                            class="flex items-center justify-between bg-white/5 hover:bg-white/10 p-5 rounded-3xl transition-all border border-white/5">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center font-black text-white text-sm shadow-lg">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-100">{{ $item->desa->nama_desa ?? '-' }}</div>
                                    <div class="text-xs text-slate-400">{{ $item->total }} Titik</div>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-500 group-hover:text-blue-400 transition-colors" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    @empty
                        <p class="text-slate-500 italic text-center py-10">Belum ada data desa.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RECENT TABLE (Flat 2.0 Style) -->
        <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-7 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Aktivitas Terbaru</h2>
                    <p class="text-slate-500 font-medium mt-1 uppercase text-[10px] tracking-widest">Live Updates</p>
                </div>
                <button class="p-2 hover:bg-slate-100 rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-black">
                            <th class="px-8 py-5">Detail</th>
                            <th class="px-8 py-5">Jenis Bangunan</th>
                            <th class="px-8 py-5">Desa</th>
                            <th class="px-8 py-5">Kontributor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentTempats as $tempat)
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-8 py-6">
                                    <div class="font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">

                                        {{ $tempat->display_name ?? '-' }}

                                    </div>

                                    @if ($tempat->display_subtitle)
                                        <div class="text-xs text-slate-400 mt-1 font-medium">

                                            {{ $tempat->display_subtitle }}

                                        </div>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="px-3 py-1 rounded-lg bg-blue-50 text-blue-700 text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                        @php
                                            $jenisBangunan = [
                                                'btt' => 'BTT',
                                                'bku' => 'BKU',
                                                'bc' => 'BC',
                                            ];
                                        @endphp

                                        {{ $jenisBangunan[$tempat->jenis_bangunan] ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-slate-500 font-medium italic">
                                    {{ $tempat->desa->nama_desa ?? '-' }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-500 uppercase">
                                            {{ substr($tempat->creator->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span
                                            class="text-sm font-bold text-slate-700 uppercase tracking-tighter">{{ $tempat->creator->name ?? '-' }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-16 text-center text-slate-400 font-medium">Tidak ada data
                                    terbaru.</td>
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
        const jenisBangunanData =
            @json($chartJenisBangunan);

        const options = {

            chart: {
                type: 'donut',
                height: 350,
                fontFamily: 'Inter, sans-serif',
                toolbar: {
                    show: false
                }
            },

            labels: jenisBangunanData.map(
                item => item.label
            ),

            series: jenisBangunanData.map(
                item => item.total
            ),

            colors: [
                '#2563eb', // BTT
                '#10b981', // BKU
                '#f59e0b', // BC
            ],

            legend: {
                position: 'bottom',
                fontSize: '14px',
            },

            dataLabels: {
                enabled: true,
            },

            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function(value) {
                        return value + ' titik';
                    }
                }
            },

            stroke: {
                width: 2
            }
        };

        new ApexCharts(
            document.querySelector(
                '#chart-jenis-bangunan'
            ),
            options
        ).render();
    </script>
@endpush

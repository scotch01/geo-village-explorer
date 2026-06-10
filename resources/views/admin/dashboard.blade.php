@extends('layouts.admin')

@section('content')
    <div class="space-y-10 animate-fade-in px-2 sm:px-0 overflow-hidden">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                    Dashboard <span class="text-blue-600 block sm:inline">Overview</span>
                </h1>
                <p class="text-slate-500 mt-2 text-base sm:text-lg font-medium">
                    Monitoring data wilayah dan persebaran sektor berbasis geospasial.
                </p>
            </div>

            <div class="flex items-center">
                <a href="{{ route('public.spectra') }}" target="_blank"
                    class="w-full sm:w-auto text-center flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-blue-200 hover:bg-blue-50/30 px-6 py-3.5 rounded-2xl font-bold text-slate-700 transition-all active:scale-95 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A2 2 0 013 15.487V6.513a2 2 0 011.553-1.943L9 2l5.447 2.724A2 2 0 0116 6.513v8.974a2 2 0 01-1.553 1.943L9 20zm0-18v18m0-18l5.447 2.724M9 20l-5.447-2.724" />
                    </svg>
                    Buka Peta
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 w-full">

            <div
                class="lg:col-span-8 bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 p-5 lg:p-8 shadow-sm min-w-0 overflow-hidden">
                <div class="flex items-center justify-between mb-6 lg:mb-8">
                    <div>
                        <h2 class="text-xl lg:text-2xl font-extrabold text-slate-900 tracking-tight">
                            Distribusi Jenis Bangunan
                        </h2>
                        <p class="text-slate-500 text-sm lg:text-base font-medium mt-1">
                            Perbandingan Bangunan Tempat Tinggal, Khusus Usaha, dan Campuran
                        </p>
                    </div>
                </div>

                <div class="w-full relative">

                    @if (count($chartJenisBangunan))
                        <div id="chart-jenis-bangunan" class="w-full min-h-[350px]"></div>
                    @else
                        <div class=" min-h-[350px] flex flex-col items-center justify-center text-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-slate-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 17v-6m3 6V7m3 10v-4m4 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z" />
                            </svg>

                            <h3 class="mt-4 text-lg font-bold text-slate-700">
                                Belum Ada Data
                            </h3>

                            <p class=" mt-2 text-sm text-slate-500 max-w-sm">
                                Grafik distribusi jenis bangunan akan muncul setelah data
                                pendataan mulai diinput.
                            </p>

                        </div>
                    @endif

                </div>
            </div>

            <div
                class="lg:col-span-4 bg-slate-900 rounded-3xl lg:rounded-[2.5rem] p-5 lg:p-8 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/20 blur-[80px]"></div>

                <h2 class="text-xl lg:text-2xl font-extrabold tracking-tight text-white relative z-10">
                    Leaderboard Desa
                </h2>
                <p class="text-slate-400 text-sm lg:text-base font-medium mt-1 relative z-10">Jumlah pendataan terbanyak</p>

                <div class="mt-6 lg:mt-10 space-y-4 relative z-10">
                    @forelse($topDesa as $item)
                        <div
                            class="flex items-center justify-between bg-white/5 hover:bg-white/10 p-4 lg:p-5 rounded-2xl lg:rounded-3xl transition-all border border-white/5">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl lg:rounded-2xl bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center font-black text-white text-sm shadow-lg shrink-0">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-100 truncate text-sm lg:text-base">
                                        {{ $item->desa->nama_desa ?? '-' }}</div>
                                    <div class="text-xs text-slate-400">{{ $item->total }} Data</div>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-500 group-hover:text-blue-400 transition-colors shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

        <div class="bg-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
            <div
                class="px-6 py-5 lg:px-8 lg:py-7 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                <div>
                    <h2 class="text-xl lg:text-2xl font-extrabold text-slate-900 tracking-tight">Aktivitas Terbaru</h2>
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
                <table class="w-full text-left min-w-[600px]">
                    <thead>
                        <tr class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-black">
                            <th class="px-6 py-4 lg:px-8 lg:py-5">Detail</th>
                            <th class="px-6 py-4 lg:px-8 lg:py-5">Jenis Bangunan</th>
                            <th class="px-6 py-4 lg:px-8 lg:py-5">Desa</th>
                            <th class="px-6 py-4 lg:px-8 lg:py-5">Kontributor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentTempats as $tempat)
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-6 py-5 lg:px-8 lg:py-6">
                                    <div class="font-extrabold text-slate-800 group-hover:text-blue-600 transition-colors">
                                        {{ $tempat->display_name ?? '-' }}
                                    </div>
                                    @if ($tempat->display_subtitle)
                                        <div class="text-xs text-slate-400 mt-1 font-medium">
                                            {{ $tempat->display_subtitle }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-5 lg:px-8 lg:py-6">
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
                                <td class="px-6 py-5 lg:px-8 lg:py-6 text-slate-500 font-medium italic">
                                    {{ $tempat->desa->nama_desa ?? '-' }}
                                </td>
                                <td class="px-6 py-5 lg:px-8 lg:py-6">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-500 uppercase shrink-0">
                                            {{ substr($tempat->creator->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span
                                            class="text-sm font-bold text-slate-700 uppercase tracking-tighter truncate max-w-[120px]">{{ $tempat->creator->name ?? '-' }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-6 py-12 lg:px-8 lg:py-16 text-center text-slate-400 font-medium">
                                    Tidak ada data terbaru.
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
        const jenisBangunanData = @json($chartJenisBangunan);

        const options = {
            chart: {
                type: 'donut',
                height: 350,
                // PERUBAHAN DISINI: Memaksa ApexCharts untuk responsif penuh mengikuti lebar pembungkusnya
                width: '100%',
                fontFamily: 'Inter, sans-serif',
                toolbar: {
                    show: false
                }
            },
            labels: jenisBangunanData.map(item => item.label),
            series: jenisBangunanData.map(item => item.total),
            colors: ['#2563eb', '#10b981', '#f59e0b'],
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
            document.querySelector('#chart-jenis-bangunan'),
            options
        ).render();
    </script>
@endpush

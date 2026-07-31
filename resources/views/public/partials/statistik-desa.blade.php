<section id="statistik-desa" class="py-24 bg-gradient-to-br from-purple-100 via-white to-blue-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="relative bg-gradient-to-br from-slate-50 to-white rounded-3xl lg:rounded-[2.5rem] border border-slate-200 shadow-sm pt-10 lg:pt-12 pb-10 lg:pb-12 px-6 lg:px-10">

            {{-- Ribbon title banner --}}
            <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-10">
                <div
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-700 to-blue-600 text-white text-xs lg:text-sm font-black uppercase tracking-[0.2em] shadow-lg shadow-blue-900/20 text-center whitespace-nowrap">
                    Statistik Desa
                </div>
            </div>

            <p class="text-center text-slate-500 text-sm lg:text-base font-medium mt-4 mb-10 lg:mb-12">
                Ketuk atau arahkan kursor ke tiap angka untuk melihat rincian per desa.
            </p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-0">

                {{-- KEPALA KELUARGA --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <div @mouseenter="open = true" @mouseleave="open = false" @click="open = !open"
                        class="w-36 h-36 lg:w-40 lg:h-40 rounded-full border-4 border-blue-100 bg-blue-50 flex flex-col items-center justify-center cursor-pointer transition-colors hover:border-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3v-6h6v6h3a1 1 0 001-1V10" />
                        </svg>
                        <div class="text-3xl font-black text-blue-700">
                            {{ number_format($statistikDesa['totalKeluarga']) }}
                        </div>
                        <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wide text-center px-3">
                            Kepala Keluarga
                        </div>
                    </div>

                    <div x-show="open" x-cloak x-transition
                        class="absolute z-20 top-full mt-3 left-1/2 -translate-x-1/2 w-56 bg-slate-900 text-white rounded-2xl shadow-xl p-4">
                        <div class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-2">
                            Per Desa
                        </div>
                        <div class="space-y-1.5 max-h-48 overflow-y-auto">
                            @forelse ($statistikDesa['perDesaKeluarga'] as $row)
                                <div class="flex items-center justify-between text-sm gap-3">
                                    <span class="text-slate-300 truncate">{{ $row->nama_desa }}</span>
                                    <span class="font-bold shrink-0">{{ $row->total }}</span>
                                </div>
                            @empty
                                <div class="text-sm text-slate-400 italic">Belum ada data.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- connector --}}
                <div class="hidden md:block w-10 lg:w-16 h-px bg-slate-300"></div>

                {{-- PENDUDUK (center, lebih besar) --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <div @mouseenter="open = true" @mouseleave="open = false" @click="open = !open"
                        class="w-44 h-44 lg:w-52 lg:h-52 rounded-full border-4 border-emerald-100 bg-gradient-to-br from-emerald-50 to-white flex flex-col items-center justify-center shadow-inner cursor-pointer transition-colors hover:border-emerald-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-emerald-600 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4.13a4 4 0 100-8 4 4 0 000 8zm6 3.13a4 4 0 00-3-3.87M6 8.13A4 4 0 003 12" />
                        </svg>
                        <div class="text-4xl font-black text-emerald-700">
                            {{ number_format($statistikDesa['totalPenduduk']) }}
                        </div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">
                            Penduduk
                        </div>
                    </div>

                    <div x-show="open" x-cloak x-transition
                        class="absolute z-20 top-full mt-3 left-1/2 -translate-x-1/2 w-56 bg-slate-900 text-white rounded-2xl shadow-xl p-4">
                        <div class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-2">
                            Per Desa
                        </div>
                        <div class="space-y-1.5 max-h-48 overflow-y-auto">
                            @forelse ($statistikDesa['perDesaPenduduk'] as $row)
                                <div class="flex items-center justify-between text-sm gap-3">
                                    <span class="text-slate-300 truncate">{{ $row->nama_desa }}</span>
                                    <span class="font-bold shrink-0">{{ $row->total }}</span>
                                </div>
                            @empty
                                <div class="text-sm text-slate-400 italic">Belum ada data.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- connector --}}
                <div class="hidden md:block w-10 lg:w-16 h-px bg-slate-300"></div>

                {{-- USAHA --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <div @mouseenter="open = true" @mouseleave="open = false" @click="open = !open"
                        class="w-36 h-36 lg:w-40 lg:h-40 rounded-full border-4 border-amber-100 bg-amber-50 flex flex-col items-center justify-center cursor-pointer transition-colors hover:border-amber-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-amber-600 mb-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2" />
                        </svg>
                        <div class="text-3xl font-black text-amber-700">
                            {{ number_format($statistikDesa['totalUsaha']) }}
                        </div>
                        <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wide text-center px-3">
                            Usaha
                        </div>
                    </div>

                    <div x-show="open" x-cloak x-transition
                        class="absolute z-20 top-full mt-3 left-1/2 -translate-x-1/2 w-56 bg-slate-900 text-white rounded-2xl shadow-xl p-4">
                        <div class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-2">
                            Per Desa
                        </div>
                        <div class="space-y-1.5 max-h-48 overflow-y-auto">
                            @forelse ($statistikDesa['perDesaUsaha'] as $row)
                                <div class="flex items-center justify-between text-sm gap-3">
                                    <span class="text-slate-300 truncate">{{ $row->nama_desa }}</span>
                                    <span class="font-bold shrink-0">{{ $row->total }}</span>
                                </div>
                            @empty
                                <div class="text-sm text-slate-400 italic">Belum ada data.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

            {{-- JENIS BANGUNAN (BTT, BKU, BC, BL) --}}
            @php
                $jenisBangunanStyle = [
                    'btt' => ['border' => 'border-indigo-100', 'hoverBorder' => 'hover:border-indigo-300', 'bg' => 'bg-indigo-50', 'text' => 'text-indigo-700', 'icon' => 'text-indigo-600'],
                    'bku' => ['border' => 'border-amber-100', 'hoverBorder' => 'hover:border-amber-300', 'bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'icon' => 'text-amber-600'],
                    'bc' => ['border' => 'border-purple-100', 'hoverBorder' => 'hover:border-purple-300', 'bg' => 'bg-purple-50', 'text' => 'text-purple-700', 'icon' => 'text-purple-600'],
                    'bl' => ['border' => 'border-slate-200', 'hoverBorder' => 'hover:border-slate-400', 'bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'icon' => 'text-slate-500'],
                ];
            @endphp

            <div class="mt-10 lg:mt-12 flex flex-wrap items-start justify-center gap-6 lg:gap-8">
                @foreach ($statistikDesa['jenisBangunan'] as $item)
                    @php $style = $jenisBangunanStyle[$item['kode']]; @endphp
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <div @mouseenter="open = true" @mouseleave="open = false" @click="open = !open"
                            class="w-28 h-28 lg:w-32 lg:h-32 rounded-full border-4 {{ $style['border'] }} {{ $style['bg'] }} flex flex-col items-center justify-center cursor-pointer transition-colors {{ $style['hoverBorder'] }}">
                            @switch($item['kode'])
                                @case('btt')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $style['icon'] }} mb-0.5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3v-6h6v6h3a1 1 0 001-1V10" />
                                    </svg>
                                @break

                                @case('bku')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $style['icon'] }} mb-0.5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2" />
                                    </svg>
                                @break

                                @case('bc')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $style['icon'] }} mb-0.5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0-10h4m-4 4h4m-4 4h4" />
                                    </svg>
                                @break

                                @case('bl')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $style['icon'] }} mb-0.5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 17H8v-3l8.586-8.586z" />
                                    </svg>
                                @break
                            @endswitch

                            <div class="text-2xl lg:text-3xl font-black {{ $style['text'] }}">
                                {{ number_format($item['total']) }}
                            </div>
                            <div class="text-xs lg:text-sm font-bold text-slate-500 uppercase tracking-wide text-center">
                                {{ strtoupper($item['kode']) }}
                            </div>
                        </div>

                        <div x-show="open" x-cloak x-transition
                            class="absolute z-20 top-full mt-3 left-1/2 -translate-x-1/2 w-60 bg-slate-900 text-white rounded-2xl shadow-xl p-4">
                            <div class="text-xs font-bold text-white mb-1">
                                {{ preg_replace('/^\d+\.\s*/', '', $item['label']) }}
                            </div>
                            <div class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-2">
                                Per Desa
                            </div>
                            <div class="space-y-1.5 max-h-48 overflow-y-auto">
                                @forelse ($item['perDesa'] as $row)
                                    <div class="flex items-center justify-between text-sm gap-3">
                                        <span class="text-slate-300 truncate">{{ $row->nama_desa }}</span>
                                        <span class="font-bold shrink-0">{{ $row->total }}</span>
                                    </div>
                                @empty
                                    <div class="text-sm text-slate-400 italic">Belum ada data.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

</section>

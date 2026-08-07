@php
    // TODO: Ganti URL ini dengan link gambar peta bersih (tanpa teks) yang sudah diupload ke Cloudinary
    // Sementara kita menggunakan gambar referensi yang kamu berikan sebagai placeholder background
    $mapBackgroundImage = 'https://res.cloudinary.com/dxkbjmmoo/image/upload/v1785651055/WhatsApp_Image_2026-08-02_at_11.53.36_hztinc.jpg'; 
@endphp

<section id="hero" class="relative w-full min-h-screen lg:min-h-[550px] xl:min-h-[650px] overflow-hidden bg-slate-900 flex items-center flex-col justify-center lg:flex-row">
    
    {{-- 1. Background Map Layer --}}
    <div class="absolute inset-0 w-full h-full">
        <img src="{{ $mapBackgroundImage }}" class="w-full h-full object-cover object-right opacity-30 lg:opacity-100" alt="Peta Kota Pariaman">
    </div>

    {{-- 2. Blue Shape Layer (Desktop Only) --}}
    <div class="absolute inset-y-0 left-0 w-[65%] xl:w-[60%] bg-gradient-to-br from-navy-700 via-navy-500 to-navy-600 hidden lg:block shadow-[20px_0_50px_rgba(0,0,0,0.5)] z-10"
         style="clip-path: polygon(0 0, 90% 0, 75% 100%, 0 900%);">
        
        {{-- Ambient highlight inside the blue panel --}}
        <div class="pointer-events-none absolute top-0 -left-20 w-96 h-96 rounded-full bg-white/5 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-0 left-20 w-72 h-72 rounded-full bg-blue-500/10 blur-3xl"></div>
        
        {{-- Subtle grid pattern --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 24px 24px;"></div>
    </div>

    {{-- Mobile Dark Gradient (To make text readable on mobile) --}}
    <div class="absolute inset-0 bg-gradient-to-b from-navy-900/95 via-navy-900/80 to-slate-900/95 lg:hidden z-0"></div>

    {{-- 3. Map Overlays (HTML pins and cards) - Desktop Only --}}
    <div class="absolute inset-0 hidden lg:block z-10 pointer-events-none">
        
        {{-- Title Peta di Kanan Atas --}}
        <div class="absolute top-[8%] right-[5%] xl:right-[8%] text-white text-right">
            <h3 class="text-3xl font-black tracking-tight drop-shadow-lg">PETA KOTA PARIAMAN</h3>
            <p class="text-sm font-semibold text-slate-200 drop-shadow-md">Tiga Desa Target Program Desa Cantik 2026</p>
        </div>

        {{-- Desa Pasir Sunur (Yellow) - Top Right --}}
        <!-- <div class="absolute top-[22%] right-[5%] xl:right-[10%] flex items-center gap-4">
            <div class="bg-white/95 backdrop-blur rounded-2xl p-4 shadow-xl border-l-4 border-descan-400 min-w-[240px] pointer-events-auto hover:-translate-y-1 transition-transform cursor-default">
                <h4 class="font-bold text-descan-600 mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    Desa Pasir Sunur
                </h4>
                <div class="grid grid-cols-[auto_1fr] gap-x-3 gap-y-1 text-xs text-slate-600">
                    <span>Luas Wilayah</span> <span class="font-bold text-slate-800 text-right">265,45 ha</span>
                    <span>Penduduk</span> <span class="font-bold text-slate-800 text-right">1.124 jiwa</span>
                </div>
                <div class="mt-2 pt-2 border-t border-slate-200 text-xs">
                    <span class="text-slate-500 block mb-1">Potensi Unggulan</span>
                    <span class="font-semibold text-slate-800 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-descan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        UMKM Kerupuk
                    </span>
                </div>
            </div>
            <div class="relative w-10 h-10 bg-descan-400 rounded-full flex items-center justify-center shadow-lg ring-4 ring-white/30 shrink-0 pointer-events-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                <span class="absolute -bottom-1 w-1 h-1 bg-white rounded-full"></span>
            </div>
        </div> -->

        {{-- Desa Kampung Apar (Blue) - Middle Center --}}
        <!-- <div class="absolute top-[50%] right-[22%] xl:right-[26%] flex items-center gap-4 flex-row-reverse">
            <div class="bg-white/95 backdrop-blur rounded-2xl p-4 shadow-xl border-l-4 border-blue-500 min-w-[240px] pointer-events-auto hover:-translate-y-1 transition-transform cursor-default">
                <h4 class="font-bold text-blue-700 mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Desa Kampung Apar
                </h4>
                <div class="grid grid-cols-[auto_1fr] gap-x-3 gap-y-1 text-xs text-slate-600">
                    <span>Luas Wilayah</span> <span class="font-bold text-slate-800 text-right">189,12 ha</span>
                    <span>Penduduk</span> <span class="font-bold text-slate-800 text-right">1.837 jiwa</span>
                </div>
                <div class="mt-2 pt-2 border-t border-slate-200 text-xs">
                    <span class="text-slate-500 block mb-1">Potensi Unggulan</span>
                    <span class="font-semibold text-slate-800 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        Perikanan & UMKM
                    </span>
                </div>
            </div>
            <div class="relative w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center shadow-lg ring-4 ring-white/30 shrink-0 pointer-events-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                <span class="absolute -bottom-1 w-1 h-1 bg-white rounded-full"></span>
            </div>
        </div> -->

        {{-- Desa Sungai Kasai (Green) - Bottom --}}
        <!-- <div class="absolute bottom-[10%] right-[10%] xl:right-[15%] flex items-center gap-4">
            <div class="bg-white/95 backdrop-blur rounded-2xl p-4 shadow-xl border-l-4 border-green-500 min-w-[240px] pointer-events-auto hover:-translate-y-1 transition-transform cursor-default">
                <h4 class="font-bold text-green-700 mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Desa Sungai Kasai
                </h4>
                <div class="grid grid-cols-[auto_1fr] gap-x-3 gap-y-1 text-xs text-slate-600">
                    <span>Luas Wilayah</span> <span class="font-bold text-slate-800 text-right">223,67 ha</span>
                    <span>Penduduk</span> <span class="font-bold text-slate-800 text-right">2.315 jiwa</span>
                </div>
                <div class="mt-2 pt-2 border-t border-slate-200 text-xs">
                    <span class="text-slate-500 block mb-1">Potensi Unggulan</span>
                    <span class="font-semibold text-slate-800 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                        Kelapa & Wisata
                    </span>
                </div>
            </div>
            <div class="relative w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shadow-lg ring-4 ring-white/30 shrink-0 pointer-events-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                <span class="absolute -bottom-1 w-1 h-1 bg-white rounded-full"></span>
            </div>
        </div> -->

        {{-- Legend --}}
        <!-- <div class="absolute bottom-6 right-6 bg-slate-900/80 backdrop-blur rounded-xl p-3 border border-white/20 text-xs text-white pointer-events-auto">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-4 h-3 bg-white/20 border border-white/50 rounded-sm"></div>
                <span>Wilayah Kota Pariaman</span>
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                <span>Desa Target Desa Cantik 2026</span>
            </div>
        </div> -->
    </div>

    {{-- 4. Content Container (Text & CTA) --}}
    <div class="relative z-20 w-full max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-0 pt-32 lg:pt-0">
        <div class="w-full lg:w-[50%] xl:w-[45%]">
            
            <h1 class="text-4xl xl:text-5xl font-black text-white leading-tight tracking-tight">
                SPECTRA
            </h1>
            <div class="mt-2 h-1 w-16 rounded-full bg-descan-500"></div>

            <h2 class="mt-4 text-base xl:text-lg font-semibold text-blue-100 lg:max-w-md">
                Sistem Pemetaan Terpadu Potensi Ekonomi dan Sosial Masyarakat Desa
            </h2>

            <div class="mt-6 self-start inline-flex items-center gap-2 pl-4 pr-5 py-2.5 rounded-xl border-l-4 border-descan-500 bg-white/10 backdrop-blur">
                <span class="font-bold text-descan-400">Satu Data, Satu Peta,</span>
                <span class="font-bold text-white">Satu Arah Pembangunan</span>
            </div>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="#peta" class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-navy-700 font-semibold shadow-lg hover:bg-blue-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition group-hover:scale-110 text-descan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Jelajahi Peta
                </a>
                <a href="#tentang" class="px-6 py-3 rounded-xl border border-white/40 font-semibold text-white hover:bg-white/10 transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>

            {{-- Stats Grid (4 items) --}}
            <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-1 -p-2 rounded-2xl border border-white/10 bg-white/5 backdrop-blur ring-1 ring-black/5 shadow-xl shadow-navy-900/50">
                {{-- Stat 1 --}}
                <div class="flex flex-col items-center text-center p-2">
                    <div class="w-5 h-5 rounded-full bg-descan-500/20 text-descan-400 flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <span class="font-bold text-white text-lg leading-none">3</span>
                    <span class="text-[11px] text-slate-300 mt-1 leading-tight">Desa Target</span>
                </div>
                {{-- Stat 2 --}}
                <div class="flex flex-col items-center text-center p-2 border-l sm:border-white/10 border-transparent sm:pl-2">
                    <div class="w-5 h-5 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    </div>
                    <span class="font-bold text-white text-lg leading-none">2026</span>
                    <span class="text-[11px] text-slate-300 mt-1 leading-tight">Tahun<br>Pencanangan</span>
                </div>
                {{-- Stat 3 --}}
                <div class="flex flex-col items-center text-center p-2 sm:border-l border-white/10 sm:pl-2">
                    <div class="w-5 h-5 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                    </div>
                    <span class="font-bold text-white text-lg leading-none">1 Peta</span>
                    <span class="text-[11px] text-slate-300 mt-1 leading-tight">Kota<br>Pariaman</span>
                </div>
                {{-- Stat 4 --}}
                <div class="flex flex-col items-center text-center p-2 border-l border-white/10 pl-2">
                    <div class="w-5 h-5 rounded-full bg-purple-500/20 text-purple-400 flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>
                    </div>
                    <span class="font-bold text-white text-lg leading-none">Satu Data</span>
                    <span class="text-[11px] text-slate-300 mt-1 leading-tight">Indonesia</span>
                </div>
            </div>

        </div>
    </div>

    {{-- Mobile Village List (Below text content, only visible on mobile) --}}
    <!-- <div class="relative z-20 w-full px-6 lg:hidden pb-16 space-y-4 mt-8">
        <h3 class="text-xl font-bold text-white border-b border-white/10 pb-2 mb-4">Desa Target Desa Cantik</h3>
        
        {{-- Mobile Card Pasir Sunur --}}
        <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border-l-4 border-descan-400">
            <h4 class="font-bold text-descan-400 mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                Desa Pasir Sunur
            </h4>
            <div class="grid grid-cols-[auto_1fr] gap-x-2 text-sm text-slate-300">
                <span>Luas:</span> <span class="font-semibold text-white">265,45 ha</span>
                <span>Penduduk:</span> <span class="font-semibold text-white">1.124 jiwa</span>
            </div>
            <div class="mt-2 text-sm text-slate-300 border-t border-white/10 pt-2">
                Potensi: <span class="font-semibold text-white">UMKM Kerupuk</span>
            </div>
        </div>

        {{-- Mobile Card Kampung Apar --}}
        <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border-l-4 border-blue-500">
            <h4 class="font-bold text-blue-400 mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                Desa Kampung Apar
            </h4>
            <div class="grid grid-cols-[auto_1fr] gap-x-2 text-sm text-slate-300">
                <span>Luas:</span> <span class="font-semibold text-white">189,12 ha</span>
                <span>Penduduk:</span> <span class="font-semibold text-white">1.837 jiwa</span>
            </div>
            <div class="mt-2 text-sm text-slate-300 border-t border-white/10 pt-2">
                Potensi: <span class="font-semibold text-white">Perikanan & UMKM</span>
            </div>
        </div>

        {{-- Mobile Card Sungai Kasai --}}
        <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border-l-4 border-green-500">
            <h4 class="font-bold text-green-400 mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                Desa Sungai Kasai
            </h4>
            <div class="grid grid-cols-[auto_1fr] gap-x-2 text-sm text-slate-300">
                <span>Luas:</span> <span class="font-semibold text-white">223,67 ha</span>
                <span>Penduduk:</span> <span class="font-semibold text-white">2.315 jiwa</span>
            </div>
            <div class="mt-2 text-sm text-slate-300 border-t border-white/10 pt-2">
                Potensi: <span class="font-semibold text-white">Kelapa & Wisata</span>
            </div>
        </div>
    </div> -->

</section>
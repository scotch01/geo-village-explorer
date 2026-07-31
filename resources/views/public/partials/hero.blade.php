@php
    // TODO: Ganti masing-masing URL dummy di bawah ini dengan link foto asli dokumentasi desa.
    // (Sementara memakai foto contoh dari picsum.photos agar terlihat bagaimana tampilannya dengan foto asli.)
    $heroSlideshowImages = [
        'https://picsum.photos/seed/spectra-desa-1/1200/700', // TODO: ganti dengan foto asli 1
        'https://picsum.photos/seed/spectra-desa-2/1200/700', // TODO: ganti dengan foto asli 2
        'https://picsum.photos/seed/spectra-desa-3/1200/700', // TODO: ganti dengan foto asli 3
        'https://picsum.photos/seed/spectra-desa-4/1200/700', // TODO: ganti dengan foto asli 4
        'https://picsum.photos/seed/spectra-desa-5/1200/700', // TODO: ganti dengan foto asli 5
        'https://picsum.photos/seed/spectra-desa-6/1200/700', // TODO: ganti dengan foto asli 6
        'https://picsum.photos/seed/spectra-desa-7/1200/700', // TODO: ganti dengan foto asli 7
        'https://picsum.photos/seed/spectra-desa-8/1200/700', // TODO: ganti dengan foto asli 8
        'https://picsum.photos/seed/spectra-desa-9/1200/700', // TODO: ganti dengan foto asli 9
        'https://picsum.photos/seed/spectra-desa-10/1200/700', // TODO: ganti dengan foto asli 10
    ];
@endphp

<section id="hero" class="relative overflow-hidden bg-white">

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16 lg:pt-10 lg:pb-24"
        x-data='{
            slide: 0,
            images: @json($heroSlideshowImages),
            timer: null,
            init() {
                this.timer = setInterval(() => {
                    this.slide = (this.slide + 1) % this.images.length;
                }, 3500);
            }
        }'>

        {{-- ============ DESKTOP: single overlapping composition ============ --}}
        <div class="relative hidden lg:block pt-8 pb-8">

        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-blue-950/20 ring-1 ring-black/5 min-h-[560px] xl:min-h-[600px]">

            {{-- Photo slideshow (full bleed background) --}}
            <template x-for="(img, index) in images" :key="index">
                <img :src="img" x-show="slide === index"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0 w-full h-full object-cover" alt="Dokumentasi kegiatan desa">
            </template>

            {{-- Subtle bottom gradient so the photo grounds into the card --}}
            <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/25 to-transparent"></div>

            {{-- Gallery caption chip --}}
            <div class="absolute top-6 left-[59%] z-10 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-black/30 backdrop-blur text-white text-xs font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 17a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                Galeri Kegiatan Desa
            </div>

            {{-- Back layer for depth --}}
            <div class="absolute inset-y-0 left-0 w-[58%] translate-x-2 translate-y-2 bg-blue-950/30"
                style="clip-path: polygon(0 0, 88% 0, 66% 100%, 0 100%);"></div>

            {{-- Diagonal ribbon panel: stretches to the card's full height so the blue always reaches the bottom, never hangs short --}}
            <div class="absolute inset-y-0 left-0 w-[58%] bg-gradient-to-br from-indigo-950 via-blue-800 to-sky-600 flex flex-col justify-center px-14 xl:px-16 py-10 overflow-hidden"
                style="clip-path: polygon(0 0, 88% 0, 66% 100%, 0 100%);">

                {{-- Ambient highlight + watermark texture --}}
                <div class="pointer-events-none absolute -top-16 -left-10 w-72 h-72 rounded-full bg-white/10 blur-3xl"></div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="pointer-events-none absolute -bottom-10 -left-8 w-56 h-56 text-white/5 rotate-12">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1112 6.5a2.5 2.5 0 010 5z" />
                </svg>

                <span
                    class="relative self-start inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-white/15 text-white text-sm font-bold ring-1 ring-white/20 backdrop-blur">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-300" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 2l1.7 4.6L16 8l-4.3 1.4L10 14l-1.7-4.6L4 8l4.3-1.4L10 2z" />
                    </svg>
                    Program Desa Cantik
                </span>

                <h1 class="relative mt-6 text-4xl xl:text-5xl font-black text-white leading-tight tracking-tight">
                    SPECTRA
                </h1>
                <div class="relative mt-2 h-1 w-16 rounded-full bg-amber-400"></div>

                <h2 class="relative mt-4 max-w-md text-base xl:text-lg font-semibold text-blue-100">
                    Sistem Pemetaan Citra Terpadu Potensi Ekonomi dan Sosial Masyarakat Desa
                </h2>

                <div
                    class="relative mt-6 self-start flex items-center gap-2 pl-4 pr-5 py-2.5 rounded-xl border-l-4 border-amber-400 bg-white/10 backdrop-blur">
                    <span class="font-bold text-amber-300">
                        Satu Data, Satu Peta,
                    </span>
                    <span class="font-bold text-white">
                        Satu Arah Pembangunan
                    </span>
                </div>

                <p class="relative mt-6 max-w-sm text-sm xl:text-base text-blue-100 leading-relaxed">
                    Pemetaan potensi sosial ekonomi desa yang akurat dan berkelanjutan melalui pemanfaatan data
                    statistik yang berkualitas.
                </p>

                <div class="relative mt-8 flex flex-wrap gap-4">

                    <a href="#peta"
                        class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-blue-700 font-semibold shadow-lg shadow-blue-950/20 hover:bg-blue-50 hover:shadow-xl transition">
                        Jelajahi Peta
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition group-hover:translate-x-0.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>

                    <a href="#tentang"
                        class="px-6 py-3 rounded-xl border border-white/40 font-semibold text-white hover:bg-white/10 transition">
                        Pelajari Lebih Lanjut
                    </a>

                </div>

            </div>

        </div>

            {{-- Floating badge, straddling the photo's bottom edge (outside the overflow-hidden box so it isn't clipped) --}}
            <div class="absolute bottom-8 right-10 translate-y-1/2 z-10">
                <div
                    class="w-64 rounded-2xl bg-gradient-to-r from-blue-700 to-sky-600 text-white text-center font-bold py-3 shadow-lg shadow-blue-900/30">
                    DESA CERDAS
                </div>
            </div>

            {{-- Decorative diagonal accents, straddling the photo's top edge --}}
            <div class="pointer-events-none absolute top-8 right-10 -translate-y-1/2 flex items-start gap-2.5 z-10">
                <div class="w-3.5 h-24 rounded-full bg-blue-700/90 -skew-x-12"></div>
                <div class="w-3.5 h-24 rounded-full bg-sky-400/70 -skew-x-12"></div>
                <div class="w-3.5 h-24 rounded-full bg-amber-300/70 -skew-x-12"></div>
            </div>

        </div>

        {{-- ============ MOBILE / TABLET: stacked layout ============ --}}
        <div class="lg:hidden space-y-6">

            {{-- Content panel --}}
            <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-indigo-950 via-blue-800 to-sky-600 px-6 py-10 sm:px-10 shadow-xl shadow-blue-950/20">

                <div class="pointer-events-none absolute -top-16 -left-10 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>

                <span
                    class="relative inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-white/15 text-white text-sm font-bold ring-1 ring-white/20 backdrop-blur">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-300" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M10 2l1.7 4.6L16 8l-4.3 1.4L10 14l-1.7-4.6L4 8l4.3-1.4L10 2z" />
                    </svg>
                    Program Desa Cantik
                </span>

                <h1 class="relative mt-6 text-4xl sm:text-5xl font-black text-white leading-tight tracking-tight">
                    SPECTRA
                </h1>
                <div class="relative mt-2 h-1 w-16 rounded-full bg-amber-400"></div>

                <h2 class="relative mt-4 text-base sm:text-lg font-semibold text-blue-100">
                    Sistem Pemetaan Citra Terpadu Potensi Ekonomi dan Sosial Masyarakat Desa
                </h2>

                <div
                    class="relative mt-6 inline-flex flex-wrap items-center gap-2 pl-4 pr-5 py-2.5 rounded-xl border-l-4 border-amber-400 bg-white/10 backdrop-blur">
                    <span class="font-bold text-amber-300">
                        Satu Data, Satu Peta,
                    </span>
                    <span class="font-bold text-white">
                        Satu Arah Pembangunan
                    </span>
                </div>

                <p class="relative mt-6 max-w-xl text-sm sm:text-base text-blue-100 leading-relaxed">
                    Pemetaan potensi sosial ekonomi desa yang akurat dan berkelanjutan melalui pemanfaatan data
                    statistik yang berkualitas.
                </p>

                <div class="relative mt-8 flex flex-wrap gap-4">

                    <a href="#peta"
                        class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-blue-700 font-semibold shadow-lg shadow-blue-950/20 hover:bg-blue-50 transition">
                        Jelajahi Peta
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition group-hover:translate-x-0.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>

                    <a href="#tentang"
                        class="px-6 py-3 rounded-xl border border-white/40 font-semibold text-white hover:bg-white/10 transition">
                        Pelajari Lebih Lanjut
                    </a>

                </div>

            </div>

            {{-- Photo slideshow --}}
            <div class="relative">

                <div class="rounded-3xl overflow-hidden shadow-xl shadow-blue-950/20 aspect-video relative bg-slate-100">

                    <template x-for="(img, index) in images" :key="index">
                        <img :src="img" x-show="slide === index"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0 w-full h-full object-cover" alt="Dokumentasi kegiatan desa">
                    </template>

                    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-black/25 to-transparent"></div>

                    <div class="absolute top-4 left-4 z-10 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-black/30 backdrop-blur text-white text-xs font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 17a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                        Galeri Kegiatan Desa
                    </div>

                </div>

                <div class="absolute bottom-0 inset-x-0 flex justify-center translate-y-1/2">
                    <div
                        class="w-11/12 rounded-2xl bg-gradient-to-r from-blue-700 to-sky-600 text-white text-center font-bold py-3 shadow-lg shadow-blue-900/30">
                        DESA CERDAS
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>
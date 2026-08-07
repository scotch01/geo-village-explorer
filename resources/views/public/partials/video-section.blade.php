{{-- Section: Dokumentasi Rangkaian Kegiatan --}}
<section id="dokumentasi" class="relative py-24 bg-gradient-to-b from-navy-700 via-navy-900 to-slate-900 overflow-hidden">

    {{-- Decorative elements --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-navy-700/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-descan-500/15 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center max-w-3xl mx-auto mb-14">

            <h2 class="mt-6 text-3xl lg:text-5xl font-black text-white">
                Dokumentasi Rangkaian Kegiatan
            </h2>

            <p class="mt-6 text-lg text-slate-300 leading-relaxed">
                Saksikan rangkaian kegiatan pelaksanaan program Desa Cinta Statistik
                di Kota Pariaman secara langsung melalui video dokumentasi berikut.
            </p>

        </div>

        {{-- Video Player Container --}}
        <div class="relative max-w-5xl mx-auto">

            {{-- Glow effect behind video --}}
            <div class="absolute -inset-4 bg-gradient-to-r from-navy-700/30 via-blue-500/20 to-descan-500/20 rounded-3xl blur-2xl"></div>

            {{-- Video wrapper --}}
            <div class="relative rounded-2xl overflow-hidden shadow-2xl
                ring-1 ring-white/10 bg-black">

                <video
                    id="video-dokumentasi"
                    class="w-full aspect-video"
                    controls
                    preload="metadata"
                    poster="{{ asset('videos/poster.jpg') }}">

                    <source
                        src="{{ asset('videos/dokumentasi.mp4') }}"
                        type="video/mp4">

                    <source
                        src="{{ asset('videos/dokumentasi.webm') }}"
                        type="video/webm">

                    Browser Anda tidak mendukung pemutaran video.

                </video>

            </div>

            {{-- Video caption --}}
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">

                <div class="flex items-center gap-3 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-blue-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>
                        Dokumentasi pelaksanaan program Desa Cantik — Kota Pariaman, 2026
                    </span>
                </div>

            </div>

        </div>

        {{-- Galeri Foto --}}
        @include('public.partials.gallery-section')

    </div>

</section>

<footer class="bg-navy-900 text-white">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">

        <div class="grid lg:grid-cols-3 gap-12">

            {{-- BRAND --}}
            <div>

                <div class="flex items-center gap-3">

                    <div
                        class="w-12 h-12 rounded-2xl bg-navy-700 flex items-center justify-center font-bold text-lg ">

                        S

                    </div>

                    <div>

                        <h3 class="font-black text-xl">

                            SPECTRA

                        </h3>

                        <p class="text-slate-400 text-sm">

                            Desa Cantik

                        </p>

                    </div>

                </div>

                <p class="mt-5 text-slate-400 leading-relaxed">

                    Sistem Pemetaan Terpadu Potensi
                    Ekonomi dan Sosial Masyarakat Desa
                    berbasis geospasial untuk mendukung
                    pembangunan desa berbasis data.

                </p>

            </div>

            {{-- MENU --}}
            <div>

                <h4 class="font-bold mb-4">

                    Navigasi

                </h4>

                <div class="space-y-3">

                    <a href="{{ route('public.spectra') }}#hero" class="block text-slate-400 hover:text-white transition">

                        Beranda

                    </a>

                    <a href="{{ route('public.spectra') }}#desa-cantik" class="block text-slate-400 hover:text-white transition">

                        Desa Cantik

                    </a>

                    <a href="{{ route('public.spectra') }}#tentang" class="block text-slate-400 hover:text-white transition">

                        Tentang

                    </a>

                    <a href="{{ route('public.spectra') }}#peta" class="block text-slate-400 hover:text-white transition">

                        Peta

                    </a>

                    <a href="{{ route('public.publication') }}" class="block text-slate-400 hover:text-white transition">

                        Publikasi

                    </a>

                    <a href="{{ route('public.service') }}" class="block text-slate-400 hover:text-white transition">

                        Layanan

                    </a>

                </div>

            </div>

            {{-- KONTAK --}}
            <div>

                <h4 class="font-bold mb-4">

                    Kontak

                </h4>

                <div class="space-y-3 text-slate-400">

                    <p>

                        Badan Pusat Statistik
                        Kota Pariaman

                    </p>

                    <p>

                        Email: bps1377@bps.go.id

                    </p>

                    <p>
                        Homepage:
                        <a href="http://pariamankota.bps.go.id" class="hover:underline"
                            target="_blank">http://pariamankota.bps.go.id</a>
                    </p>



                    <p>

                        Kota Pariaman, Sumatera Barat

                    </p>

                </div>

            </div>

        </div>

        <div
            class="mt-12 pt-8 border-t border-slate-800 flex flex-col md:flex-row gap-3 justify-between items-center">

            <p class="text-slate-500 text-sm">

                © {{ date('Y') }}
                <span class="]">
                    SPECTRA | BPS Kota Pariaman
                </span>.
                All rights reserved.

            </p>

            <p class="text-sm text-blue-400 font-medium">

                Powered by BPS Kota Pariaman

            </p>

        </div>

    </div>

</footer>

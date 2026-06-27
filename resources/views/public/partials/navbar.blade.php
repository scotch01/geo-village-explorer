<nav x-data="{ open: false }" class="sticky top-0 z-50 backdrop-blur-md border-b border-slate-200/60 bg-white/80 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="#" class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-black text-lg">
                    S
                </div>

                <div>

                    <div class="font-black text-slate-900">
                        SPECTRA
                    </div>

                    <div class="text-xs text-slate-500">
                        Desa Cantik
                    </div>

                </div>

            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">

                <a href="{{ route('public.spectra') }}#hero"
                    class="text-sm font-semibold text-slate-700 hover:text-blue-600">
                    Beranda
                </a>

                <a href="{{ route('public.spectra') }}#desa-cantik"
                    class="text-sm font-semibold text-slate-700 hover:text-blue-600">
                    Desa Cantik
                </a>

                <a href="{{ route('public.spectra') }}#tentang"
                    class="text-sm font-semibold text-slate-700 hover:text-blue-600">
                    Tentang
                </a>

                <a href="{{ route('public.spectra') }}#peta"
                    class="text-sm font-semibold text-slate-700 hover:text-blue-600">
                    Peta
                </a>

                <a href="{{ route('public.publication') }}"
                    class="text-sm font-semibold text-slate-700 hover:text-blue-600">
                    Portal Data
                </a>

            </div>

            {{-- Mobile Toggle --}}
            <button @click="open=!open" class="md:hidden p-2 rounded-lg border border-slate-200">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

            </button>

        </div>

    </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="absolute top-16 left-0 right-0 md:hidden bg-white border-t border-slate-100 shadow-xl z-50">

            <div class="flex flex-col pt-4 gap-3 p-4">

                <a href="{{ route('public.spectra') }}#hero" class="font-medium text-slate-700">
                    Beranda
                </a>

                <a href="{{ route('public.spectra') }}#desa-cantik" class="font-medium text-slate-700">
                    Desa Cantik
                </a>

                <a href="{{ route('public.spectra') }}#tentang" class="font-medium text-slate-700">
                    Tentang
                </a>

                <a href="{{ route('public.spectra') }}#peta" class="font-medium text-slate-700">
                    Peta
                </a>

                <a href="{{ route('public.publication') }}" class="font-medium text-slate-700">
                    Portal Data
                </a>

            </div>

        </div>

</nav>

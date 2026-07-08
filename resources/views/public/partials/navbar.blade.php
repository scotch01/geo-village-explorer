<nav x-data="{
    open: false,
    homeMenu: false
}"
    class="sticky top-0 z-50 backdrop-blur-md border-b border-slate-200/60 bg-white/80 shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('public.spectra') }}" class="flex items-center gap-3">

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

            {{-- ========================= --}}
            {{-- Desktop Menu --}}
            {{-- ========================= --}}
            <div class="hidden md:flex items-center gap-8">

                {{-- BERANDA DROPDOWN --}}
                <div class="relative" @mouseenter="homeMenu=true" @mouseleave="homeMenu=false">

                    <button
                        class="flex items-center gap-2 text-sm font-semibold text-slate-700 hover:text-blue-600 transition">

                        Beranda

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition duration-200"
                            :class="homeMenu ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                        </svg>

                    </button>

                    <div x-show="homeMenu" x-transition x-cloak
                        class="absolute left-0 mt-3 w-52 bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden">

                        <a href="{{ route('public.spectra') }}#hero"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-50">

                            Beranda

                        </a>

                        <a href="{{ route('public.spectra') }}#desa-cantik"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-50">

                            Desa Cantik

                        </a>

                        <a href="{{ route('public.spectra') }}#tentang"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-50">

                            Tentang

                        </a>

                        <a href="{{ route('public.spectra') }}#peta"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-slate-50">

                            Peta

                        </a>

                    </div>

                </div>

                {{-- PORTAL --}}
                <a href="{{ route('public.publication') }}"
                    class="text-sm font-semibold transition border-b-2 pb-1 {{ request()->routeIs('public.publication') ? 'text-blue-600 border-blue-600' : 'text-slate-700 border-transparent hover:text-blue-600' }}">

                    Portal Data

                </a>

                {{-- LAYANAN --}}
                <a href="{{ route('public.service') }}"
                    class="text-sm font-semibold transition border-b-2 pb-1 {{ request()->routeIs('public.service') ? 'text-blue-600 border-blue-600' : 'text-slate-700 border-transparent hover:text-blue-600' }}">

                    Layanan

                </a>

            </div>

            {{-- Mobile Toggle --}}
            <div class="flex items-center lg:hidden">
                <button @click="open = !open"
                    class="text-slate-600 hover:text-slate-950 p-2 rounded-xl hover:bg-slate-100 focus:outline-none transition-all">
                    <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- MOBILE MENU --}}
    {{-- ========================= --}}
    <div x-show="open" @click.outside="open=false"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute top-16 left-0 right-0 md:hidden bg-white border-t border-slate-100
            shadow-xl z-50">

        <div class="p-4 space-y-2">

            {{-- BERANDA --}}
            <div>

                <button @click="homeMenu=!homeMenu"
                    class="w-full flex justify-between items-center py-2 font-medium text-slate-700">

                    <span>

                        Beranda

                    </span>

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition"
                        :class="homeMenu ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                    </svg>

                </button>

                <div x-show="homeMenu" x-collapse
                    class="ml-4 mt-2 flex flex-col gap-3">

                    <a href="{{ route('public.spectra') }}#hero">

                        Beranda

                    </a>

                    <a href="{{ route('public.spectra') }}#desa-cantik">

                        Desa Cantik

                    </a>

                    <a href="{{ route('public.spectra') }}#tentang">

                        Tentang

                    </a>

                    <a href="{{ route('public.spectra') }}#peta">

                        Peta

                    </a>

                </div>

            </div>

            <a href="{{ route('public.publication') }}" class="block py-2 font-medium text-slate-700">

                Portal Data

            </a>

            <a href="{{ route('public.service') }}" class="block py-2 font-medium text-slate-700">

                Layanan

            </a>

        </div>

    </div>

</nav>

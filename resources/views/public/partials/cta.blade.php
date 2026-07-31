<section id="layanan-portal" class="py-24 bg-gradient-to-b from-blue-50 via-white to-slate-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 lg:space-y-8">

        {{-- LAYANAN MANDIRI --}}
        <div class="relative rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl shadow-blue-950/10 grid md:grid-cols-[1.1fr_1.3fr_1fr]">

            {{-- Illustration panel --}}
            <div class="relative bg-gradient-to-br from-blue-800 to-blue-700 p-8 flex flex-col justify-center overflow-hidden min-h-[200px]">

                <div class="pointer-events-none absolute -bottom-8 -left-8 w-40 h-40 rounded-full bg-white/10 blur-2xl">
                </div>

                <h3 class="relative text-3xl lg:text-4xl font-black text-white leading-none tracking-tight">
                    LAYANAN<br>MANDIRI
                </h3>

                {{-- Flat illustration: two people at a shared laptop, chatting --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 140"
                    class="relative mt-6 w-full max-w-[260px]">
                    <ellipse cx="120" cy="118" rx="90" ry="8" fill="#000000" opacity="0.12" />

                    {{-- person left --}}
                    <path d="M30 112c0-26 16-40 33-40s33 14 33 40z" fill="#fbbf24" />
                    <rect x="72" y="86" width="22" height="9" rx="4.5" fill="#f4c9a1"
                        transform="rotate(-12 72 86)" />
                    <circle cx="63" cy="55" r="17" fill="#f4c9a1" />
                    <path d="M46 50a17 17 0 0134 0c0-14-8-22-17-22s-17 8-17 22z" fill="#3b2a1a" />

                    {{-- laptop --}}
                    <rect x="95" y="78" width="50" height="32" rx="3" fill="#0f172a" />
                    <rect x="99" y="82" width="42" height="22" rx="1.5" fill="#38bdf8" />
                    <rect x="104" y="87" width="20" height="3" rx="1.5" fill="#e0f2fe" opacity="0.9" />
                    <rect x="104" y="93" width="28" height="3" rx="1.5" fill="#e0f2fe" opacity="0.6" />
                    <rect x="90" y="108" width="60" height="6" rx="2" fill="#0f172a" />

                    {{-- person right --}}
                    <path d="M150 112c0-24 15-37 31-37s31 13 31 37z" fill="#38bdf8" />
                    <rect x="148" y="88" width="20" height="8" rx="4" fill="#f4c9a1"
                        transform="rotate(14 148 88)" />
                    <circle cx="181" cy="58" r="16" fill="#f4c9a1" />
                    <path d="M165 54a16 16 0 0132 0c0-13-7-20-16-20s-16 7-16 20z" fill="#1e293b" />

                    {{-- chat bubble --}}
                    <rect x="182" y="16" width="38" height="24" rx="7" fill="#ffffff" />
                    <path d="M190 40l-5 9 11-9z" fill="#ffffff" />
                    <circle cx="192" cy="28" r="2.2" fill="#1d4ed8" />
                    <circle cx="201" cy="28" r="2.2" fill="#1d4ed8" />
                    <circle cx="210" cy="28" r="2.2" fill="#1d4ed8" />
                </svg>

            </div>

            {{-- Identity panel --}}
            <div class="relative flex flex-col items-center justify-center text-center gap-2 p-8 bg-gradient-to-br from-slate-800 to-slate-900">

                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center ring-1 ring-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                    </svg>
                </div>

                <h4 class="mt-2 text-lg font-bold text-white">
                    Layanan Administrasi Desa
                </h4>

                <p class="text-sm text-slate-300 max-w-xs">
                    Ajukan permohonan layanan administrasi desa secara online, kapan saja tanpa perlu datang langsung.
                </p>

            </div>

            {{-- Alert + CTA panel --}}
            <div class="flex flex-col items-center justify-center gap-4 p-8 bg-gradient-to-br from-slate-100 to-white">

                <div class="flex items-start gap-2 text-slate-500 text-sm text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-500 shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>
                        Hubungi admin desa jika belum memiliki akses layanan.
                    </span>
                </div>

                <a href="{{ route('public.service') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-700 text-white font-bold shadow-lg shadow-blue-950/20 hover:bg-blue-600 transition">
                    Buka Layanan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>

            </div>

        </div>

        {{-- PORTAL DATA --}}
        <div class="relative rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl shadow-slate-900/10 grid md:grid-cols-[1.1fr_1.3fr_1fr]">

            {{-- Illustration panel --}}
            <div class="relative bg-gradient-to-br from-amber-500 to-amber-400 p-8 flex flex-col justify-center overflow-hidden min-h-[200px]">

                <div class="pointer-events-none absolute -bottom-8 -right-8 w-40 h-40 rounded-full bg-white/10 blur-2xl">
                </div>

                <h3 class="relative text-3xl lg:text-4xl font-black text-slate-900 leading-none tracking-tight">
                    PORTAL<br>DATA
                </h3>

                {{-- Flat illustration: colorful bar chart with a magnifying glass --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 140"
                    class="relative mt-6 w-full max-w-[260px]">
                    <ellipse cx="120" cy="118" rx="90" ry="8" fill="#000000" opacity="0.08" />

                    <rect x="24" y="70" width="26" height="42" rx="3" fill="#1e293b" opacity="0.85" />
                    <rect x="58" y="48" width="26" height="64" rx="3" fill="#0f172a" />
                    <rect x="92" y="26" width="26" height="86" rx="3" fill="#1d4ed8" />
                    <rect x="126" y="58" width="26" height="54" rx="3" fill="#0ea5e9" />
                    <path d="M20 112h140" stroke="#0f172a" stroke-width="3" stroke-linecap="round" />

                    <circle cx="196" cy="44" r="23" fill="#fef3c7" />
                    <circle cx="196" cy="44" r="23" fill="none" stroke="#0f172a" stroke-width="5" />
                    <path d="M212 60l16 16" stroke="#0f172a" stroke-width="6" stroke-linecap="round" />
                </svg>

            </div>

            {{-- Identity panel --}}
            <div class="relative flex flex-col items-center justify-center text-center gap-2 p-8 bg-gradient-to-br from-slate-800 to-slate-900">

                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center ring-1 ring-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-amber-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 7a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 11h16M9 7v14" />
                    </svg>
                </div>

                <h4 class="mt-2 text-lg font-bold text-white">
                    Publikasi Data Desa
                </h4>

                <p class="text-sm text-slate-300 max-w-xs">
                    Akses publikasi data, artikel, dan statistik desa yang dikumpulkan dan diolah secara terbuka.
                </p>

            </div>

            {{-- Alert + CTA panel --}}
            <div class="flex flex-col items-center justify-center gap-4 p-8 bg-gradient-to-br from-slate-100 to-white">

                <div class="flex items-start gap-2 text-slate-500 text-sm text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-500 shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                    </svg>
                    <span>
                        Data terbuka untuk seluruh masyarakat, gratis tanpa perlu login.
                    </span>
                </div>

                <a href="{{ route('public.publication') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-400 text-slate-900 font-bold shadow-lg hover:bg-amber-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                    Buka Portal
                </a>

            </div>

        </div>

    </div>

</section>

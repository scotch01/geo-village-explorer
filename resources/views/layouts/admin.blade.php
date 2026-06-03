<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('bps.ico') }}" sizes="any">

    {{-- ALPINEJS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Font: Inter untuk kesan modern & clean -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- MARKER CLUSTER -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

    <title>Admin Panel - Desa Cantik</title>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Subtle Aurora Background Effect */
        .aurora-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 0% 0%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(147, 51, 234, 0.05) 0%, transparent 50%);
            background-color: #f8fafc;
        }

        /* Glassmorphism for Navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="min-h-screen text-slate-900 antialiased">

    <div class="aurora-bg"></div>

    <!-- NAVBAR -->
    <nav x-data="{ open: false }"
        class="glass-nav sticky top-0 z-50 border-b border-slate-200/60 bg-white/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <div class="flex items-center gap-2 group">
                <div
                    class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-200 transition-transform group-hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-800">
                    Desa<span class="text-blue-600"> Cantik</span>
                </span>
            </div>

            <div class="hidden lg:flex items-center bg-slate-100/50 p-1.5 rounded-2xl border border-slate-200/50">
                @if (auth()->user()->isMasterAdmin() || auth()->user()->isAdminDesa() || auth()->user()->isPengawas())
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.tempat.index') }}"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.tempat.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                        Bangunan
                    </a>

                    @if (auth()->user()->isMasterAdmin())
                        <a href="{{ route('admin.desa.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.desa.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            Desa
                        </a>
                        <a href="{{ route('admin.user.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.user.*') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                            User
                        </a>
                    @endif
                @endif
            </div>

            <div class="hidden lg:flex items-center gap-6">

                @php
                    $roleLabel = match (auth()->user()->role) {
                        'master_admin' => 'Master Admin',
                        'pengawas' => 'Pengawas',
                        'admin_desa' => 'Agen Statistik',
                        default => 'User',
                    };
                @endphp

                <div class="flex flex-col items-end">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        {{ $roleLabel }}
                    </span>

                    <span class="text-sm font-bold text-slate-700">
                        {{ auth()->user()->name }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors border border-transparent hover:border-red-100">
                        <svg xmlns="http://www.w3.org/2000/xl" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

            <div class="flex items-center lg:hidden">
                <button @click="open = !open"
                    class="text-slate-600 hover:text-slate-950 p-2 rounded-xl hover:bg-slate-100 focus:outline-none transition-colors">
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

        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="absolute left-0 right-0 top-20 lg:hidden border-b border-t border-slate-200/60 bg-white shadow-xl max-h-[calc(100vh-5rem)] overflow-y-auto z-50">

            <div class="px-4 py-3 space-y-1">
                @if (auth()->user()->isMasterAdmin() || auth()->user()->isAdminDesa() || auth()->user()->isPengawas())
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-3 rounded-xl text-base font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('admin.tempat.index') }}"
                        class="block px-4 py-3 rounded-xl text-base font-medium transition-all {{ request()->routeIs('admin.tempat.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        Bangunan
                    </a>

                    @if (auth()->user()->isMasterAdmin())
                        <a href="{{ route('admin.desa.index') }}"
                            class="block px-4 py-3 rounded-xl text-base font-medium transition-all {{ request()->routeIs('admin.desa.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            Desa
                        </a>
                        <a href="{{ route('admin.user.index') }}"
                            class="block px-4 py-3 rounded-xl text-base font-medium transition-all {{ request()->routeIs('admin.user.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            User
                        </a>
                    @endif
                @endif
            </div>

            <div class="p-4 border-t border-slate-100 bg-slate-50/70 flex items-center justify-between">
                @php
                    $roleLabel = match (auth()->user()->role) {
                        'master_admin' => 'Master Admin',
                        'pengawas' => 'Pengawas',
                        'admin_desa' => 'Agen Statistik',
                        default => 'User',
                    };
                @endphp

                <div class="flex flex-col">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        {{ $roleLabel }}
                    </span>

                    <span class="text-sm font-bold text-slate-700">
                        {{ auth()->user()->name }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-red-500 bg-white hover:bg-red-50 shadow-sm border border-slate-200/60 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto p-6 md:p-8">
        @yield('content')
    </main>

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            () => {

                document
                    .querySelectorAll(
                        '.exclusive-checkbox'
                    )
                    .forEach(
                        checkbox => {

                            checkbox.addEventListener(
                                'change',
                                () => {

                                    const group =
                                        checkbox.dataset.group;

                                    const all =
                                        document.querySelectorAll(
                                            `[data-group="${group}"]`
                                        );

                                    const exclusive = [...all].find(
                                        item =>
                                        item.dataset.exclusive === '1'
                                    );

                                    if (
                                        exclusive.checked
                                    ) {

                                        all.forEach(item => {

                                            if (item !== exclusive) {

                                                item.checked = false;
                                                item.disabled = true;
                                            }

                                        });

                                    } else {

                                        all.forEach(item => {
                                            item.disabled = false;
                                        });

                                        const othersChecked = [...all]
                                            .filter(
                                                item =>
                                                item !== exclusive
                                            )
                                            .some(
                                                item =>
                                                item.checked
                                            );

                                        if (othersChecked) {

                                            exclusive.disabled = true;

                                        } else {

                                            exclusive.disabled = false;
                                        }
                                    }

                                }
                            );

                        }
                    );

            }
        );
    </script>
    @stack('scripts')
</body>

</html>

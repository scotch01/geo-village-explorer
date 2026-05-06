<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- LEAFLET -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- MARKER CLUSTER -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

    <title>Admin Panel</title>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            <div class="font-bold text-gray-800">
                🌍 SIPETA
            </div>

            <div class="flex items-center gap-4">

                @if (auth()->user()->isMasterAdmin())
                    <a href="{{ route('admin.tempat.index') }}">
                        Tempat
                    </a>
                    <a href="{{ route('admin.desa.index') }}">
                        Desa
                    </a>

                    <a href="{{ route('admin.user.index') }}">
                        User
                    </a>
                @endif
                <span class="text-sm text-gray-500">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="text-sm text-red-500">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>
    <!-- LEAFLET -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- MARKER CLUSTER -->
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
</body>

</html>

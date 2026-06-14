<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Login - SPECTRA
    </title>

    <link rel="icon" href="{{ asset('bps.ico') }}" sizes="any">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ALPINEJS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white border border-slate-200 rounded-[2rem] shadow-sm p-8">

        {{-- Heading --}}
        <div class="text-center mt-5">

            <h1 class="text-3xl font-black text-slate-900">
                SPECTRA
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Sistem Pemetaan Terpadu Potensi Ekonomi dan Sosial Masyarakat Desa
            </p>

        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="mt-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">

                {{ session('status') }}

            </div>
        @endif

        {{-- Error --}}
        @if ($errors->any())

            <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4">

                <ul class="list-disc ml-5 text-sm text-red-700 space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5 mt-6" x-data="{ showPassword: false }">

            @csrf

            {{-- Email --}}
            <div>

                <label class=" block text-sm font-semibold text-slate-700 mb-2">
                    Email
                </label>

                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username"
                    class ="w-full rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-blue-500">

            </div>

            {{-- Password --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Password
                </label>

                <input :type="showPassword ? 'text' : 'password'" name="password" required
                    autocomplete="current-password"
                    class="w-full rounded-2xl border-slate-200
            focus:border-blue-500 focus:ring-blue-500">

            </div>

            <label class="flex items-center gap-3 text-sm text-slate-600">

                <input type="checkbox" x-model="showPassword"
                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                <span>
                    Tampilkan Password
                </span>

            </label>

            {{-- Help --}}
            <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4">

                <p class="text-sm text-blue-700 text-center">
                    Hubungi Master Admin jika lupa kata sandi.
                </p>

            </div>

            {{-- Button --}}
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-2xl transition-all active:scale-95">
                Masuk
            </button>

        </form>

        <a href="{{ route('public.spectra') }}"
            class="mt-3 -mb-3 block text-center text-sm font-medium text-slate-500 hover:text-blue-600">
            ← Kembali ke Halaman Publik
        </a>

    </div>

</body>

</html>

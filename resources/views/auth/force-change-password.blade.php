<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Ganti Password
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('bps.ico') }}" sizes="any">

    {{-- ALPINEJS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-[2rem] border border-slate-200 shadow-sm p-8">

        {{-- Logo --}}
        <div class="flex justify-center mb-6">

            <div
                class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-black text-xl">
                S
            </div>

        </div>

        {{-- Heading --}}
        <div class="text-center">

            <h1 class="text-2xl font-black text-slate-900">
                Ganti Password
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Anda wajib mengganti password sebelum melanjutkan ke sistem.
            </p>

        </div>

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

        <form method="POST" action="{{ route('password.force.update') }}" class="space-y-5 mt-6"
            x-data="{ showPassword: false }">

            @csrf

            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Password Baru
                </label>

                <input :type="showPassword ? 'text' : 'password'" name="password" required autofocus
                    class="w-full rounded-2xl border-slate-200">

            </div>

            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Konfirmasi Password
                </label>

                <input :type="showPassword ? 'text' : 'password'" name="password_confirmation" required
                    class="w-full rounded-2xl border-slate-200">

            </div>

            <label class="flex items-center gap-3 text-sm text-slate-600">

                <input type="checkbox" x-model="showPassword"
                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                <span>
                    Tampilkan Password
                </span>

            </label>

            <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4">

                <p class="text-sm text-blue-700">
                    Gunakan minimal 8 karakter dengan kombinasi huruf besar,
                    huruf kecil, angka, atau simbol.
                </p>

            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-2xl transition-all active:scale-95">

                Simpan Password

            </button>

        </form>

    </div>

</body>

</html>

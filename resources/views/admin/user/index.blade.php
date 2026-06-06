@extends('layouts.admin')

@section('content')

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between flex-wrap gap-4">

            <div>

                <h1 class="text-3xl font-black tracking-tight text-slate-900">
                    Manajemen User
                </h1>

                <p class="text-slate-500 mt-2">
                    Kelola akun admin desa dan hak akses sistem
                </p>

            </div>

            <a href="{{ route('admin.user.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition">

                + Tambah User

            </a>

        </div>

        <!-- Flash Message -->
        <x-alert />

        <!-- TABLE -->
        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @if ($users->count())
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50 border-b border-slate-100 uppercase text-xs text-slate-500 tracking-wider">

                            <tr>
                                <th class="px-6 py-5 text-left">Nama</th>
                                <th class="px-6 py-5 text-left">Email</th>
                                <th class="px-6 py-5 text-left">Role</th>
                                <th class="px-6 py-5 text-left">Desa</th>
                                <th class="px-6 py-5 text-center">Aksi</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach ($users as $user)
                                <tr class="hover:bg-slate-50 transition">

                                    <!-- NAMA -->
                                    <td class="px-6 py-5 font-semibold text-slate-800">
                                        {{ $user->name }}
                                    </td>

                                    <!-- EMAIL -->
                                    <td class="px-6 py-5 text-slate-600">
                                        {{ $user->email }}
                                    </td>

                                    <!-- ROLE -->
                                    <td class="px-6 py-5">

                                        @if ($user->role === 'master_admin')
                                            <span
                                                class="px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-bold">
                                                Master Admin
                                            </span>
                                        @elseif($user->role === 'pengawas')
                                            <span
                                                class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                Pengawas
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold">
                                                Admin Desa
                                            </span>
                                        @endif

                                    </td>

                                    <!-- DESA -->
                                    <td class="px-6 py-5 text-slate-600">
                                        {{ $user->desa->nama_desa ?? '-' }}
                                    </td>

                                    <!-- AKSI -->
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-center gap-2">

                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="px-4 py-2 rounded-xl bg-amber-100 text-amber-700 hover:bg-amber-200 font-semibold text-xs transition">

                                                Edit

                                            </a>

                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus user ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200 font-semibold text-xs transition">

                                                        Hapus

                                                    </button>

                                                </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            @else
                <div class="py-24 text-center">

                    <div class="text-lg font-bold text-slate-700">
                        Belum ada user
                    </div>

                    <p class="text-slate-500 mt-2 text-sm">
                        Tambahkan akun admin desa pertama
                    </p>

                </div>
            @endif

        </div>

    </div>

@endsection

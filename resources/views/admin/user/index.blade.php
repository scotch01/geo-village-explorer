@extends('layouts.admin')

@section('content')

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between flex-wrap gap-4">

            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                    Manajemen <span class="text-blue-600">User</span>
                </h1>
                <p class="text-slate-500 mt-2 font-medium">
                    Kelola akun admin desa dan hak akses sistem
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.pengawas-assignment.index') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-green-100 transition-all active:scale-95 text-center">

                    PML - PCL

                </a>

                <a href="{{ route('admin.user.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition-all active:scale-95">

                    + Tambah User

                </a>
            </div>


        </div>

        <!-- Flash Message -->
        <x-alert />

        @if (session('generated_password'))
            <div class="mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 p-4">

                <div class="font-bold text-yellow-900">
                    Password Sementara
                </div>

                <div class="mt-2 font-mono text-lg">
                    {{ session('generated_password') }}
                </div>

                <div class="mt-2 text-sm text-yellow-700">
                    Simpan password ini karena hanya ditampilkan sekali.
                </div>

            </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @if ($users->count())
                <div
                    class="px-8 py-6 border-b border-slate-50 bg-slate-50/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                    <h3 class="font-bold text-slate-800 flex items-center gap-2">

                        <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xs">

                            {{ $users->total() }}

                        </span>

                        User Ditemukan

                    </h3>

                    <form method="GET" class="flex items-center gap-3">

                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">

                            Rows:

                        </span>

                        <select name="per_page" onchange="this.form.submit()"
                            class="pl-3 pr-8 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700">

                            @foreach ([25, 50, 100] as $v)
                                <option value="{{ $v }}" @selected(request('per_page', 25) == $v)>

                                    {{ $v }}

                                </option>
                            @endforeach

                        </select>

                    </form>

                </div>
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead
                            class="bg-slate-50 border-b border-slate-100 uppercase text-xs text-slate-500 tracking-wider">

                            <tr>
                                <th class="px-6 py-5 text-center w-20">No</th>
                                <th class="px-6 py-5 text-left">Nama</th>
                                <th class="px-6 py-5 text-left">Email</th>
                                <th class="px-6 py-5 text-left">Role</th>
                                <th class="px-6 py-5 text-left">Desa</th>
                                <th class="px-6 py-5 text-center">Aksi</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach ($users as $index => $user)
                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-6 py-5 text-center font-bold text-slate-400">
                                        {{ $users->firstItem() + $index }}
                                    </td>

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
                                                class="px-4 py-2 rounded-xl bg-amber-100 text-amber-700 hover:bg-amber-200 font-semibold text-xs transition-all active:scale-95">

                                                Edit

                                            </a>

                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus user ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="px-4 py-2 rounded-xl bg-red-100 text-red-700 hover:bg-red-200 font-semibold text-xs transition-all active:scale-95">

                                                        Hapus

                                                    </button>

                                                </form>
                                            @endif

                                            @if ($user->id !== auth()->id())
                                                <form method="POST"
                                                    action="{{ route('admin.user.reset-password', $user) }}"
                                                    onsubmit="
                                                    return confirm(
                                                        'Reset password user ini?'
                                                    )
                                                ">
                                                    @csrf

                                                    <button type="submit"
                                                        class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 font-semibold text-xs transition-all active:scale-95">
                                                        Reset Password
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

                @if ($users->hasPages())
                    <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/20">
                        {{ $users->links() }}
                    </div>
                @endif
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

@extends('layouts.admin')

@section('content')

    <div class="max-w-3xl mx-auto space-y-8">

        <!-- HEADER -->
        <div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Tambah User
            </h1>

            <p class="text-slate-500 mt-2">
                Tambahkan akun admin dan assign wilayah desa
            </p>

        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                <div class="font-semibold text-red-700 mb-2">
                    Terdapat data yang belum lengkap:
                </div>

                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>

            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.user.store') }}"
            class="bg-white border border-slate-200 rounded-[2rem] shadow-sm overflow-hidden">

            @csrf

            <div class="p-8 space-y-6">

                <!-- NAMA -->
                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Nama
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                </div>

                <!-- EMAIL -->
                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                </div>

                <!-- PASSWORD -->
                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Password
                    </label>

                    <input type="password" name="password" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50"
                        required>

                </div>

                <!-- ROLE -->
                <div>

                    <label class="text-sm font-semibold text-slate-700">
                        Role
                    </label>

                    <select name="role" id="role" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50"
                        required>

                        <option value="master_admin">
                            Master Admin
                        </option>

                        <option value="pengawas">
                            Pengawas
                        </option>

                        <option value="admin_desa">
                            Admin Desa
                        </option>

                    </select>

                </div>

                <!-- DESA -->
                <div id="desa-wrapper">

                    <label class="text-sm font-semibold text-slate-700">
                        Desa
                    </label>

                    <select name="id_desa" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                        <option value="">
                            -- Pilih Desa --
                        </option>

                        @foreach ($desas as $desa)
                            <option value="{{ $desa->id }}">
                                {{ $desa->nama_desa }}
                            </option>
                        @endforeach

                    </select>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-slate-100 px-8 py-5 bg-slate-50 flex items-center justify-end gap-4">

                <a href="{{ route('admin.user.index') }}"
                    class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-200 transition">

                    Batal

                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold shadow-lg shadow-blue-100 transition">

                    Simpan User

                </button>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const role = document.getElementById('role');
            const desaWrapper = document.getElementById('desa-wrapper');

            function toggleDesa() {

                if (role.value === 'master_admin') {

                    desaWrapper.classList.add('hidden');

                } else {

                    desaWrapper.classList.remove('hidden');
                }
            }

            role.addEventListener('change', toggleDesa);

            toggleDesa();

        });
    </script>

@endsection

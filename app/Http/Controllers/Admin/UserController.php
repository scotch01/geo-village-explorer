<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('desa')
            ->latest()
            ->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $desas = Desa::orderBy('nama_desa')->get();

        return view('admin.user.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:6',

            'role' => 'required|in:master_admin,pengawas,admin_desa',

            'id_desa' => 'nullable|exists:desas,id',
        ]);

        $validated['password'] =
            Hash::make($validated['password']);

        User::create($validated);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $desas = Desa::orderBy('nama_desa')->get();

        return view('admin.user.edit', compact(
            'user',
            'desas'
        ));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $user->id,

            'role' => 'required|in:master_admin,pengawas,admin_desa',

            'id_desa' => 'nullable|exists:desas,id',
        ]);

        if ($request->filled('password')) {

            $validated['password'] =
                Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.user.index')
            ->with('warning', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {

            return back()
                ->with('success', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('danger', 'User berhasil dihapus');
    }
}
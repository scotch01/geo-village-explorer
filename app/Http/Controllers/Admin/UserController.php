<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

            'role' => 'required|in:master_admin,pengawas,admin_desa',

            'id_desa' => 'nullable|exists:desas,id',
        ]);

        User::create([

            'name'
                => $validated['name'],

            'email'
                => $validated['email'],

            'password'
                => Hash::make(
                    $tempPassword
                ),

            'role'
                => $validated['role'],

            'id_desa'
                => $validated['id_desa'] ?? null,

            'must_change_password'
                => true,

        ]);

        return redirect()
            ->route('admin.user.index')
            ->with(
                'generated_password',
                $tempPassword
            )
            ->with(
                'success',
                'User berhasil ditambahkan'
            );
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

        $user->update($validated);

        return redirect()
            ->route('admin.user.index')
            ->with('warning', 'User berhasil diperbarui');
    }

    public function resetPassword(
        User $user
    )
    {
        if (
            $user->id === auth()->id()
        ) {

            return back()
                ->with(
                    'danger',
                    'Tidak dapat mereset akun sendiri'
                );

        }

        $tempPassword =
            Str::random(10);

        $user->update([

            'password'
                => Hash::make(
                    $tempPassword
                ),

            'must_change_password'
                => true,

        ]);

        return redirect()
            ->route(
                'admin.user.index'
            )
            ->with(
                'generated_password',
                $tempPassword
            )
            ->with(
                'warning',
                'Password berhasil direset'
            );
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
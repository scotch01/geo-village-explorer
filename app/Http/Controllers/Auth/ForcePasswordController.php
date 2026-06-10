<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForcePasswordController extends Controller
{
    public function show()
    {
        return view(
            'auth.force-change-password'
        );
    }

    public function update(
        Request $request
    )
    {
        $request->validate([

            'password'
                => [
                    'required',
                    'min:8',
                    'confirmed',
                ],

        ]);

        $user =
            auth()->user();

        $user->update([

            'password'
                => Hash::make(
                    $request->password
                ),

            'must_change_password'
                => false,

        ]);

        return redirect()
            ->route(
                'admin.dashboard'
            )
            ->with(
                'success',
                'Password berhasil diperbarui'
            );
    }
}
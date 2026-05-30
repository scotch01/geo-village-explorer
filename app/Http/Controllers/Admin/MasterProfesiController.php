<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterProfesi;

class MasterProfesiController extends Controller
{
    public function search(Request $request)
    {
        return MasterProfesi::query()

            ->when(
                $request->q,
                fn ($query) =>
                    $query
                        ->where('kode', 'like', "%{$request->q}%")
                        ->orWhere('nama', 'like', "%{$request->q}%")
            )

            ->orderBy('kode')

            ->limit(20)

            ->get([
                'id',
                'kode',
                'nama'
            ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PmlPclAssignment;

class PengawasAssignmentController extends Controller
{
    public function index()
    {
        $pengawas = User::query()
            ->where('role', 'pengawas')
            ->orderBy('name')
            ->get();

        $pcls = User::query()
            ->where('role', 'admin_desa')
            ->orderBy('name')
            ->get();

        $existing = PmlPclAssignment::query()
            ->get()
            ->groupBy('pml_id');

        $selectedPml =
            request('pml_id')
            ?? $pengawas->first()?->id;

        return view(
            'admin.assignment.index',
            compact(
                'pengawas',
                'pcls',
                'existing',
                'selectedPml'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'pml_id' => ['required'],
            'pcl_ids' => ['array']
        ]);

        PmlPclAssignment::query()
            ->where(
                'pml_id',
                $request->pml_id
            )
            ->delete();

        foreach (
            $request->pcl_ids ?? []
            as $pclId
        ) {

            PmlPclAssignment::create([
                'pml_id' => $request->pml_id,
                'pcl_id' => $pclId,
            ]);
        }

        return back()->with(
            'success',
            'Assignment berhasil disimpan'
        );
    }
}

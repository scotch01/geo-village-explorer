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

        if (empty($request->pcl_ids)) {

            return back()->with(
                'warning',
                'Pilih minimal satu PCL terlebih dahulu'
            );
        }

        /**
         * CEK CONFLICT
         */
        if (!$request->boolean('force_update')) {

            $conflicts =
                PmlPclAssignment::query()
                    ->with([
                        'pml',
                        'pcl'
                    ])
                    ->whereIn(
                        'pcl_id',
                        $request->pcl_ids ?? []
                    )
                    ->where(
                        'pml_id',
                        '!=',
                        $request->pml_id
                    )
                    ->get();

            if ($conflicts->isNotEmpty()) {

                return back()
                    ->withInput()
                    ->with(
                        'assignment_conflicts',
                        $conflicts
                    )
                    ->with(
                        'pending_assignment',
                        [
                            'pml_id' => $request->pml_id,
                            'pcl_ids' => $request->pcl_ids ?? [],
                        ]
                    );
            }
        }

        /**
         * HAPUS ASSIGNMENT LAMA
         * UNTUK PCL YANG DIPILIH
         */
        foreach (
            $request->pcl_ids ?? []
            as $pclId
        ) {

            PmlPclAssignment::query()
                ->where(
                    'pcl_id',
                    $pclId
                )
                ->delete();
        }

        /**
         * HAPUS ASSIGNMENT
         * PML SAAT INI
         */
        PmlPclAssignment::query()
            ->where(
                'pml_id',
                $request->pml_id
            )
            ->delete();

        /**
         * SIMPAN BARU
         */
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

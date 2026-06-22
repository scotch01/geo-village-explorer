<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Constants\Tempat\JenisBangunan;

class TempatController extends Controller
{
    /**
     * Display listing
     */
    public function index(Request $request)
    {
        $query = Tempat::query()
            ->with([
                'desa',
                'creator'
            ]);

        /**
         * RBAC
         */
        if (auth()->user()->isAdminDesa() || auth()->user()->isPengawas()) {

            $query->whereNotNull('id_desa')
                ->where(
                    'id_desa',
                    auth()->user()->id_desa
                );
        }

        /**
         * SEARCH
         */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Kepala keluarga
                $q->whereHas('keluarga', function ($query) use ($search) {

                    $query->where(
                        'nama_kepala_keluarga',
                        'like',
                        "%{$search}%"
                    );
                })

                // Anggota keluarga
                ->orWhereHas(
                    'keluarga.anggotaKeluargas',
                    function ($query) use ($search) {

                        $query->where(
                            'nama',
                            'like',
                            "%{$search}%"
                        );
                    }
                )

                // Usaha
                ->orWhereHas('usahas', function ($query) use ($search) {

                    $query->where(
                        'nama_usaha',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'nama_pemilik',
                        'like',
                        "%{$search}%"
                    );
                });
            });
        }

        /**
         * FILTER JENIS BANGUNAN
         */
        if ($request->filled('jenis_bangunan')) {

            $query->where(
                'jenis_bangunan',
                $request->jenis_bangunan
            );
        }

        /**
         * FILTER DESA
         */
        if (
            auth()->user()->isMasterAdmin()
            && $request->filled('desa')
        ) {

            $query->where(
                'id_desa',
                $request->desa
            );
        }

        /**
         * FILTER PETUGAS
         */
        if ($request->filled('creator')) {

            $query->where(
                'created_by',
                $request->creator
            );
        }

        /**
         * PAGINATION
         */
        $perPage     = $request->get('per_page', 20);
        $tempats = $query
            ->with([
                'keluarga',
                'usahas',
                'creator',
            ])
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $creatorQuery = \App\Models\User::query()
            ->where('role', 'admin_desa');

        if (
            auth()->user()->isAdminDesa()
            || auth()->user()->isPengawas()
        ) {
            $creatorQuery->where(
                'id_desa',
                auth()->user()->id_desa
            );
        }

        $creators = $creatorQuery
            ->orderBy('name')
            ->get();

        return view('admin.tempat.index', [
            'tempats' => $tempats,

            'desas' => \App\Models\Desa::orderBy('nama_desa')->get(),

            'jenisBangunan'
                => \App\Constants\Tempat\JenisBangunan::OPTIONS,

            'creators' => $creators,
        ]);
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.tempat.create');
    }

    /**
     * Store data
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'jenis_bangunan' => [
                'required',
                Rule::in(
                    array_keys(
                        JenisBangunan::OPTIONS
                    )
                )
            ],

        ]);

        $validated['id_desa'] =
            auth()->user()->id_desa;

        $validated['created_by'] =
            auth()->id();

        $validated['nama_tempat'] = '-';

        $validated['alamat'] = '-';

        if ($request->hasFile('foto_bangunan')) {

            $validated['foto_bangunan'] =
                $request
                    ->file('foto_bangunan')
                    ->store('tempat', 'public');
        }

        $tempat = Tempat::create($validated);

        return redirect()
            ->route('admin.tempat.survey', $tempat)
            ->with('success', 'Data bangunan berhasil ditambahkan');
    }

    /**
     * Show detail
     */
    public function show(Tempat $tempat)
    {
        if (!auth()->user()->canViewTempat($tempat)) {
            abort(403);
        }

        return view('admin.tempat.show', compact('tempat'));
    }

    /**
     * Edit form
     */
    public function edit(Tempat $tempat)
    {
        if (!auth()->user()->canEditTempat($tempat)) {
            abort(403);
        }

        return view('admin.tempat.edit', compact('tempat'));
    }

    /**
     * Update data
     */
    public function update(Request $request, Tempat $tempat)
    {
        if (!auth()->user()->canEditTempat($tempat)) {
            abort(403);
        }

        $validated = $request->validate([
            'jenis_bangunan' => [
                'required',
                Rule::in(
                    array_keys(
                        JenisBangunan::OPTIONS
                    )
                )
            ],

        ]);

        $validated['nama_tempat'] = '-';

        $validated['alamat'] = '-';

        if ($request->hasFile('foto_bangunan')) {

            if ($tempat->foto_bangunan) {

                Storage::disk('public')
                    ->delete(
                        $tempat->foto_bangunan
                    );
            }

            $validated['foto_bangunan'] =
                $request
                    ->file('foto_bangunan')
                    ->store('tempat', 'public');
        }

        $tempat->update($validated);

        return redirect()
            ->route('admin.tempat.survey', $tempat)
            ->with('warning', 'Data bangunan berhasil diperbarui');
    }

    /**
     * Delete
     */
    public function destroy(Tempat $tempat)
    {
        if (!auth()->user()->isMasterAdmin()) {

            abort(403);
        }

        if ($tempat->foto_bangunan) {

            Storage::disk('public')
                ->delete(
                    $tempat->foto_bangunan
                );
        }

        $tempat->delete();

        return redirect()
            ->route('admin.tempat.index')
            ->with('danger', 'Data bangunan berhasil dihapus');
    }

    public function survey(Tempat $tempat)
    {
        if (!auth()->user()->canViewTempat($tempat)) {
            abort(403);
        }

        $tempat->load([
            'keluarga.anggotaKeluargas',
            'usahas',
        ]);

        return view(
            'admin.tempat.survey',
            compact('tempat')
        );
    }

    public function updateSurvey(
        Request $request,
        Tempat $tempat
    )
    {
        if (!auth()->user()->canEditTempat($tempat)) {
            abort(403);
        }

        $data = [];

        if ($request->hasFile('foto_bangunan')) {

            if ($tempat->foto_bangunan) {

                Storage::disk('public')
                    ->delete(
                        $tempat->foto_bangunan
                    );
            }

            $data['foto_bangunan']
                = $request
                    ->file('foto_bangunan')
                    ->store(
                        'bangunan',
                        'public'
                    );
        }

        if ($request->has('catatan')) {

            $data['catatan']
                = $request->catatan;
        }

        if (
            !$request->hasFile('foto_bangunan')
            && !$request->filled('catatan')
        ) {
            return back()->with(
                'danger',
                'Tidak ada data yang disimpan'
            );
        }

        $tempat->update($data);

        return back()->with(
            'success',
            'Data berhasil disimpan'
        );
    }
}
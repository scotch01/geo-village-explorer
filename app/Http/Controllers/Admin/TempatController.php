<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use Illuminate\Http\Request;
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
        if (auth()->user()->isAdminDesa()) {

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

                $q->where(
                    'nama_tempat',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'alamat',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'nama_pemilik',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        /**
         * FILTER SEKTOR
         */
        if ($request->filled('sektor')) {

            $query->where(
                'sektor',
                $request->sektor
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
         * PAGINATION
         */
        $tempats = $query
            ->with([
                'keluarga',
                'usaha',
            ])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.tempat.index', [
            'tempats' => $tempats,
            // 'sektors' => Tempat::SEKTOR,
            'desas' => \App\Models\Desa::orderBy('nama_desa')->get(),
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
            'nama_tempat' => 'required|string|max:255',

            'jenis_bangunan' => [
                'required',
                Rule::in(
                    array_keys(
                        JenisBangunan::OPTIONS
                    )
                )
            ],

            'alamat' => 'required|string',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $validated['id_desa'] =
            auth()->user()->id_desa;

        $validated['created_by'] =
            auth()->id();

        if ($request->hasFile('foto_bangunan')) {

            $validated['foto_bangunan'] =
                $request
                    ->file('foto_bangunan')
                    ->store('tempat', 'public');
        }

        Tempat::create($validated);

        return redirect()
            ->route('admin.tempat.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show detail
     */
    public function show(Tempat $tempat)
    {
        $this->authorizeTempatAccess($tempat);

        return view('admin.tempat.show', compact('tempat'));
    }

    /**
     * Edit form
     */
    public function edit(Tempat $tempat)
    {
        $this->authorizeTempatAccess($tempat);

        return view('admin.tempat.edit', compact('tempat'));
    }

    /**
     * Update data
     */
    public function update(Request $request, Tempat $tempat)
    {
        $this->authorizeTempatAccess($tempat);

        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:255',

            'jenis_bangunan' => [
                'required',
                Rule::in(
                    array_keys(
                        JenisBangunan::OPTIONS
                    )
                )
            ],

            'alamat' => 'required|string',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        if ($request->hasFile('foto_bangunan')) {

            $validated['foto_bangunan'] =
                $request
                    ->file('foto_bangunan')
                    ->store('tempat', 'public');
        }

        $tempat->update($validated);

        return redirect()
            ->route('admin.tempat.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Delete
     */
    public function destroy(Tempat $tempat)
    {
        $this->authorizeTempatAccess($tempat);

        $tempat->delete();

        return redirect()
            ->route('admin.tempat.index')
            ->with('success', 'Data berhasil dihapus');
    }

    private function authorizeTempatAccess(Tempat $tempat)
    {
        $user = auth()->user();

        if ($user->isMasterAdmin()) {
            return;
        }

        if ($tempat->id_desa !== $user->id_desa) {
            abort(403, 'Unauthorized');
        }
    }

    public function survey(Tempat $tempat)
    {
        $this->authorizeTempatAccess($tempat);

        $tempat->load([
            'keluarga.anggotaKeluargas',
            'usaha',
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
        $data = [];

        if ($request->hasFile('foto_bangunan')) {

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

        $tempat->update($data);

        return back()->with(
            'success',
            'Data berhasil disimpan'
        );
    }
}
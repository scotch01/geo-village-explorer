<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use Illuminate\Http\Request;

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
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('admin.tempat.index', [
            'tempats' => $tempats,
            'sektors' => Tempat::SEKTOR,
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
            'sektor' => 'required|string|max:100',

            'nama_pemilik' => 'nullable|string|max:255',
            'alamat' => 'required|string',

            'no_hp' => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string',

            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        /**
         * Dynamic metadata
         */
        $metadata = [];

        // contoh sektor ekonomi
        if ($request->sektor === 'ekonomi') {

            $metadata['skala_usaha'] = $request->skala_usaha;
            $metadata['jumlah_karyawan'] = $request->jumlah_karyawan;
        }

        $validated['metadata'] = $metadata;

        $validated['id_desa'] =
            auth()->user()->id_desa;

        $validated['created_by'] =
            auth()->id();

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
            'sektor' => 'required|string|max:100',

            'nama_pemilik' => 'nullable|string|max:255',
            'alamat' => 'required|string',

            'no_hp' => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string',

            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $metadata = [];

        if ($request->sektor === 'ekonomi') {

            $metadata['skala_usaha'] = $request->skala_usaha;
            $metadata['jumlah_karyawan'] = $request->jumlah_karyawan;
        }

        $validated['metadata'] = $metadata;

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
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::latest()->get();

        return view('admin.desa.index', compact('desas'));
    }

    public function create()
    {
        return view('admin.desa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kode_desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi'  => 'nullable|string|max:255',
        ]);

        Desa::create($validated);

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Desa berhasil ditambahkan');
    }

    public function edit(Desa $desa)
    {
        return view('admin.desa.edit', compact('desa'));
    }

    public function update(Request $request, Desa $desa)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kode_desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi'  => 'nullable|string|max:255'
        ]);

        $desa->update($validated);

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Desa berhasil diperbarui');
    }

    public function destroy(Desa $desa)
    {
        $desa->delete();

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Desa berhasil dihapus');
    }
}
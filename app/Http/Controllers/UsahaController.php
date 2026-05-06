<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use Illuminate\Http\Request;

class UsahaController extends Controller
{
    public function index()
    {
        $usahas = Usaha::latest()->get();

        return view('admin.usaha.index', compact('usahas'));
    }

    public function create()
    {
        return view('admin.usaha.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'kategori_usaha' => 'nullable|string|max:100',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'deskripsi' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        Usaha::create($validated);

        return redirect()
            ->route('admin.usaha.index')
            ->with('success', 'Data usaha berhasil ditambahkan');
    }

    public function peta()
    {
        $usahas = Usaha::where('is_active', true)
            ->get(['id','nama_usaha','nama_pemilik','alamat','latitude','longitude']);

        return view('public.peta', compact('usahas'));
    }
}

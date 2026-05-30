<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;

class KeluargaController extends Controller
{
    public function create(Tempat $tempat)
    {
        return view(
            'admin.keluarga.create',
            compact('tempat')
        );
    }
}
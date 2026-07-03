<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function index()
    {
        return view('admin.management.index');
    }
}
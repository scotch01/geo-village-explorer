<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TempatController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicMapController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MasterProfesiController;
use App\Http\Controllers\Admin\KeluargaController;
use App\Http\Controllers\Admin\AnggotaKeluargaController;
use App\Http\Controllers\Admin\UsahaController;

Route::get('/', function () {
    return redirect('/peta');
});

Route::get('/peta', [PublicMapController::class, 'index'])
    ->name('public.peta');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:master_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('desa', DesaController::class);

    Route::resource('user', UserController::class);
});

Route::middleware(['auth', 'role:master_admin,admin_desa'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('tempat', TempatController::class);

    Route::get('/tempat/{tempat}/survey', [TempatController::class, 'survey'])
        ->name('tempat.survey');

    Route::put('/tempat/{tempat}/survey', [TempatController::class, 'updateSurvey'])
        ->name('tempat.updateSurvey');

    // Data Usaha
    Route::get('/tempat/{tempat}/usaha/create', [UsahaController::class, 'create'])
        ->name('usaha.create');

    Route::post('/tempat/{tempat}/usaha', [UsahaController::class, 'store'])
        ->name('usaha.store');

    Route::get('/tempat/{tempat}/usaha/edit', [UsahaController::class, 'edit'])
        ->name('usaha.edit');

    Route::put('/tempat/{tempat}/usaha', [UsahaController::class, 'update'])
        ->name('usaha.update');

    Route::delete('/tempat/{tempat}/usaha', [UsahaController::class, 'destroy'])
        ->name('usaha.destroy');

    // Data Keluarga
    Route::get('/tempat/{tempat}/keluarga/create', [KeluargaController::class, 'create'])
        ->name('keluarga.create');

    Route::post('/tempat/{tempat}/keluarga', [KeluargaController::class, 'store'])
        ->name('keluarga.store');

    Route::get('/tempat/{tempat}/keluarga/edit', [KeluargaController::class, 'edit'])
        ->name('keluarga.edit');

    Route::put('/tempat/{tempat}/keluarga', [KeluargaController::class, 'update'])
        ->name('keluarga.update');

    Route::delete('/tempat/{tempat}/keluarga', [KeluargaController::class, 'destroy'])
        ->name('keluarga.destroy');

    // Data Anggota Keluarga
    Route::get('/keluarga/{keluarga}/anggota', [AnggotaKeluargaController::class, 'index'])
        ->name('anggota.index');
        
    Route::get('/keluarga/{keluarga}/anggota/create', [AnggotaKeluargaController::class, 'create'])
        ->name('anggota.create');

    Route::post('/keluarga/{keluarga}/anggota', [AnggotaKeluargaController::class, 'store'])
        ->name('anggota.store');

    Route::get('/anggota/{anggota}/edit', [AnggotaKeluargaController::class, 'edit'])
        ->name('anggota.edit');

    Route::put('/anggota/{anggota}', [AnggotaKeluargaController::class, 'update'])
        ->name('anggota.update');

    Route::delete('/anggota/{anggota}', [AnggotaKeluargaController::class, 'destroy'])
        ->name('anggota.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/master-profesi/search', [MasterProfesiController::class, 'search']);

});

require __DIR__.'/auth.php';

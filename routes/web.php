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

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get(
        '/admin/master-profesi/search',
        [MasterProfesiController::class, 'search']
    );

});

require __DIR__.'/auth.php';

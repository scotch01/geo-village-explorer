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
use App\Http\Controllers\Admin\PortalCategoryController;
use App\Http\Controllers\Admin\PortalItemController;
use App\Http\Controllers\PortalPublicController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Auth\ForcePasswordController;
use App\Http\Controllers\Admin\PengawasAssignmentController;
use App\Http\Controllers\Admin\ManagementController;

// Public Page

Route::get('/', [PublicMapController::class, 'index'])
    ->name('public.spectra');

Route::get('/portal-data', [PortalPublicController::class, 'publication'])
    ->name('public.publication');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/force-change-password', [ForcePasswordController::class, 'show'])
        ->name('password.force.change');

    Route::post('/force-change-password', [ForcePasswordController::class, 'update'])
        ->name('password.force.update');

});

Route::middleware(['auth', 'force.password', 'role:master_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('desa', DesaController::class);

    Route::resource('user', UserController::class);

    Route::get('/management', [ManagementController::class, 'index'])
        ->name('management.index');

    Route::post('/user/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('user.reset-password');

    Route::get('/pengawas-assignment', [PengawasAssignmentController::class, 'index'])
        ->name('pengawas-assignment.index');

    Route::post('/pengawas-assignment', [PengawasAssignmentController::class, 'store'])
        ->name('pengawas-assignment.store');

    Route::resource('portal-category', PortalCategoryController::class);

    Route::resource('portal-item', PortalItemController::class);

    Route::get('/export', [ExportController::class, 'index'])
        ->name('export.index');

    Route::get('/export/download', [ExportController::class, 'download'])
        ->name('export.download');
});

Route::middleware(['auth', 'force.password', 'role:master_admin,admin_desa,pengawas'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('tempat', TempatController::class);

    Route::get('/tempat/{tempat}/survey', [TempatController::class, 'survey'])
        ->name('tempat.survey');

    Route::put('/tempat/{tempat}/survey', [TempatController::class, 'updateSurvey'])
        ->name('tempat.updateSurvey');

    // Data Usaha
    Route::get('/tempat/{tempat}/usaha', [UsahaController::class, 'index'])
        ->name('usaha.index');

    Route::get('/tempat/{tempat}/usaha/create', [UsahaController::class, 'create'])
        ->name('usaha.create');

    Route::post('/tempat/{tempat}/usaha', [UsahaController::class, 'store'])
        ->name('usaha.store');

    Route::get('/tempat/usaha/{usaha}', [UsahaController::class, 'show'])
        ->name('usaha.show');

    Route::get('/usaha/{usaha}/edit', [UsahaController::class, 'edit'])
    ->name('usaha.edit');

    Route::put('/usaha/{usaha}', [UsahaController::class, 'update'])
    ->name('usaha.update');

    Route::delete('/usaha/{usaha}', [UsahaController::class, 'destroy'])
    ->name('usaha.destroy');

    // Data Keluarga
    Route::get('/tempat/{tempat}/keluarga/create', [KeluargaController::class, 'create'])
        ->name('keluarga.create');

    Route::post('/tempat/{tempat}/keluarga', [KeluargaController::class, 'store'])
        ->name('keluarga.store');

    Route::get('/tempat/{tempat}/keluarga', [KeluargaController::class, 'show'])
        ->name('keluarga.show');

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

    Route::get('/anggota/{anggota}', [AnggotaKeluargaController::class, 'show'])
        ->name('anggota.show');

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

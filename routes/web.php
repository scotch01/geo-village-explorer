<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TempatController;
use App\Http\Controllers\Admin\DesaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicMapController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/peta', [PublicMapController::class, 'index'])
    ->name('public.peta');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:master_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    //
});

Route::middleware(['auth', 'role:master_admin,admin_desa'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('tempat', TempatController::class);

    Route::resource('desa', DesaController::class);

    Route::resource('user', UserController::class);

});

require __DIR__.'/auth.php';

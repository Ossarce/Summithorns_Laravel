<?php

use App\Http\Controllers\EntryCategoryController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function() {
    return view('admin.index');
})->name('admin.panel');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('future.profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/admin/spots', SpotController::class);
Route::resource('/admin/entries/categories', EntryCategoryController::class);
Route::resource('/admin/entries', EntryController::class);

Route::prefix('/admin/spots/{spot}/zones')->group(function () {
    Route::get('/', [ZoneController::class, 'index'])->name('zones.index');
    Route::get('/create', [ZoneController::class, 'create'])->name('zones.create');
    Route::post('/', [ZoneController::class, 'store'])->name('zones.store');
    Route::get('/{zone}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
    Route::put('/{zone}', [ZoneController::class, 'update'])->name('zones.update');
    Route::delete('/{zone}', [ZoneController::class, 'destroy'])->name('zones.destroy');
});


require __DIR__.'/auth.php';

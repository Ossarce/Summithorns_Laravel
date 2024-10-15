<?php

use App\Http\Controllers\EntryCategoryController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/admin/spots', SpotController::class);
Route::resource('/admin/entries/categories', EntryCategoryController::class);
Route::resource('/admin/entries', EntryController::class);


require __DIR__.'/auth.php';

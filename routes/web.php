<?php

use App\Http\Controllers\BoulderController;
use App\Http\Controllers\BoulderGradeController;
use App\Http\Controllers\ClimbingRouteController;
use App\Http\Controllers\ClimbingTypeController;
use App\Http\Controllers\EntryCategoryController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\RouteGradeController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

// Rutas Públicas
Route::get('/', [PublicPageController::class, 'home'])->name('public.home');
Route::get('nosotros', [PublicPageController::class, 'us'])->name('public.us');
Route::get('spots', [PublicPageController::class, 'spots'])->name('public.spots');
Route::get('spots/{id}', [PublicPageController::class, 'spot'])->name('public.spot');
Route::get('blog', [PublicPageController::class, 'blog'])->name('public.blog');
Route::get('entry/{id}', [PublicPageController::class, 'entry'])->name('public.entry');
Route::get('contact', [PublicPageController::class, 'contact'])->name('public.contact');
Route::post('contact', [PublicPageController::class, 'submit'])->name('public.submit');


Route::post('/spots/{id}/like', [LikeController::class, 'toggleLikeSpot'])->name('spots.like');

Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rutas Admin y Colaboradores
Route::get('/admin', function() {
    return view('admin.index');
})->name('admin.panel');

Route::resource('/admin/climbing-types', ClimbingTypeController::class);
Route::resource('/admin/entry-categories', EntryCategoryController::class);
Route::resource('/admin/boulder-grades', BoulderGradeController::class);
Route::resource('/admin/route-grades', RouteGradeController::class);

Route::resource('/admin/spots', SpotController::class);
Route::resource('/admin/entries', EntryController::class);

Route::prefix('/admin/spots/{spot}/zones')->group(function () {
    Route::get('/', [ZoneController::class, 'index'])->name('zones.index');
    Route::get('/create', [ZoneController::class, 'create'])->name('zones.create');
    Route::post('/', [ZoneController::class, 'store'])->name('zones.store');
    Route::get('/{zone}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
    Route::put('/{zone}', [ZoneController::class, 'update'])->name('zones.update');
    Route::delete('/{zone}', [ZoneController::class, 'destroy'])->name('zones.destroy');
});

Route::prefix('/admin/spots/{spot}/zones/{zone}')->group(function () {
    //Rutas Boulders
    Route::get('/boulders', [BoulderController::class, 'index'])->name('boulders.index');
    Route::get('/boulders/create', [BoulderController::class, 'create'])->name('boulders.create');
    Route::post('/boulders', [BoulderController::class, 'store'])->name('boulders.store');
    Route::get('/boulders/{boulder}/edit', [BoulderController::class, 'edit'])->name('boulders.edit');
    Route::put('/boulders/{boulder}', [BoulderController::class, 'update'])->name('boulders.update');
    Route::delete('/boulders/{boulder}', [BoulderController::class, 'destroy'])->name('boulders.destroy');

    // Rutas Deportiva
    Route::get('/routes', [ClimbingRouteController::class, 'index'])->name('routes.index');
    Route::get('/routes/create', [ClimbingRouteController::class, 'create'])->name('routes.create');
    Route::post('/routes', [ClimbingRouteController::class, 'store'])->name('routes.store');
    Route::get('/routes/{climbingRoute}/edit', [ClimbingRouteController::class, 'edit'])->name('routes.edit');
    Route::put('/routes/{climbingRoute}', [ClimbingRouteController::class, 'update'])->name('routes.update');
    Route::delete('/routes/{climbingRoute}', [ClimbingRouteController::class, 'destroy'])->name('routes.destroy');
});


require __DIR__.'/auth.php';

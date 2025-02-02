<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitController;
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


    Route::get('/units', [UnitController::class, 'index']);
    Route::get('/unit/{unitName}', [UnitController::class, 'unitDetails']);
    Route::post('/unit/{unitName}/enable', [UnitController::class, 'enableUnit'])->name('unit.enable');
    Route::post('/unit/{unitName}/disable', [UnitController::class, 'disableUnit'])->name('unit.disable');

});



require __DIR__.'/auth.php';

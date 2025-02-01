<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
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

Route::get('/modules', [ModuleController::class, 'index']);
Route::get('/modules/{moduleName}', [ModuleController::class, 'moduleDetails']);
Route::post('/module/{moduleName}/enable', [ModuleController::class, 'enableModule'])->name('module.enable');
Route::post('/module/{moduleName}/disable', [ModuleController::class, 'disableModule'])->name('module.disable');


require __DIR__.'/auth.php';

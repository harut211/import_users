<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FileUploadController;
use \App\Http\Controllers\ProcessFileController;

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
    Route::post('/file-upload', [FileUploadController::class, 'upload'])->name('upload');
    Route::get('/select-headers/{filename}', [ProcessFileController::class, 'index'])->name('select-headers');
    Route::post('/store',[ProcessFileController::class, 'store'])->name('store');
    Route::get('/show',[ProcessFileController::class, 'show'])->name('show');
});

require __DIR__.'/auth.php';

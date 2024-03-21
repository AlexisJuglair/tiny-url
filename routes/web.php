<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', [LinkController::class, 'index'])->name('link.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/link/create', [LinkController::class, 'create'])->name('link.create');
    Route::post('/link/store', [LinkController::class, 'store'])->name('link.store');
    Route::get('/link/{link}/edit', [LinkController::class, 'edit'])->name('link.edit');
    Route::put('/link/{link}', [LinkController::class, 'update'])->name('link.update');
    Route::delete('/link/{link}', [LinkController::class, 'destroy'])->name('link.destroy');
});

Route::get('/{id}/{alias}', [LinkController::class, 'show'])
    ->where(['id', '[0-9]+', 'alias' => '[a-z0-9\-_]{6,8}'])
    ->name('link.show');

Route::get('/login', [AuthController::class, 'login'])->name('login.get')->middleware('guest');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post')->middleware('guest');
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;

Route::get('/', function () {
    return redirect()->route('tikits.index');
});

Route::resource('tikits', TiketController::class);
Route::patch('tikits/{tikit}/status', [TiketController::class, 'updateStatus'])
     ->name('tikits.updateStatus');

     Route::resource('tikits', TiketController::class);
Route::patch('tikits/{tikit}/status', [TiketController::class, 'updateStatus'])
     ->name('tikits.updateStatus');

     Route::get('/buat-tiket', [TiketController::class, 'userForm'])->name('user.form');
Route::post('/buat-tiket', [TiketController::class, 'userStore'])->name('user.store');

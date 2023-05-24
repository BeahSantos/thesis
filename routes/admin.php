<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RecycleBinController;
use App\Http\Controllers\Admin\ThesisController;

//Authentication
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('adminAuth')->group(function () {
    Route::get('/thesis-archives', [ThesisController::class, 'index'])->name('index')->middleware('preventBackHistory');
    Route::post('/store', [ThesisController::class, 'store'])->name('store');
    Route::put('/update/{thesis}', [ThesisController::class, 'update'])->name('update');
    Route::delete('/delete/{thesis}', [ThesisController::class, 'destroy'])->name('destroy');
    Route::get('/search', [ThesisController::class, 'searchCourse'])->name('search_course');
    Route::get('/recycle-bin', [RecycleBinController::class, 'index'])->name('recycle_bin.index');
    Route::post('/recycle-bin/{thesis}/restore', [RecycleBinController::class, 'restore'])->name('recycle_bin.restore');
    Route::post('/recycle-bin/{thesis}/delete', [RecycleBinController::class, 'delete'])->name('recycle_bin.delete');
});

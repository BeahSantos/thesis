<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LatestUploadController;
use App\Http\Controllers\MostViewedThesisController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/most-viewed-thesis', [MostViewedThesisController::class, 'index'])->name('most_viewed_thesis.index');
Route::get('/latest-uploads', [LatestUploadController::class, 'index'])->name('latest_upload.index');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

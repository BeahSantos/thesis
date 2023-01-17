<?php

use App\Http\Controllers\AlphabeticalThesisController;
use App\Http\Controllers\MostViewedController;
use App\Http\Controllers\LatestUploadController;
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

Route::get('/', [MostViewedController::class, 'index'])->name('welcome.index');
Route::get('/latest-uploads', [LatestUploadController::class, 'index'])->name('latest_upload.index');
Route::get('/a-z', [AlphabeticalThesisController::class, 'index'])->name('alphabetical_thesis.index');
Route::get('/{thesis}/show', [WelcomeController::class, 'showThesis'])->name('show_thesis');
Route::post('/store', [WelcomeController::class, 'storeStudentInfo'])->name('store_student_info');
Route::get('/download/{file}', [WelcomeController::class, 'download'])->name('download');

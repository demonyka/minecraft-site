<?php

use App\Http\Controllers\LauncherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::inertia('/', 'Home')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::inertia('/cabinet', 'Cabinet/Cabinet')->name('cabinet');
});

Route::get('/launcher/download', [LauncherController::class, 'download'])->name('launcher.download');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailingAnalyticsController;
use App\Http\Controllers\MailingController;
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/analytics', [MailingAnalyticsController::class, 'index'])->name('mailings.analytics');

    Route::post('/clients/importExcel', [ClientController::class, 'importExcel'])->name('clients.importExcel');
    Route::post('/mailings/setActive/{mailing}', [MailingController::class, 'setActive'])->name('mailings.setActive');

    Route::resource('/clients', ClientController::class)->only(['index', 'create', 'store']);
    Route::resource('/mailings', MailingController::class)->only(['index', 'create', 'store']);
});

require __DIR__.'/auth.php';

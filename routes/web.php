<?php

use App\Http\Controllers\ClientController;
use \App\Http\Controllers\MailingController;
use \App\Http\Controllers\MailingAnalyticsController;
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

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::resource('/clients', ClientController::class);
Route::resource('/mailings', MailingController::class);

Route::post('/clients/importExcel', [ClientController::class, 'importExcel'])->name('clients.importExcel');
Route::get('/analytics', [MailingAnalyticsController::class, 'index'])->name('mailings.analytics');


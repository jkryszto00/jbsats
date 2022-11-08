<?php

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

Route::get('/', function () {
    return \inertia('Index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'panel', 'middleware' => 'employer'], function () {
    Route::get('', \App\Http\Controllers\Panel\DashboardController::class)->name('panel.dashboard');

    Route::group(['prefix' => 'company'], function () {
        Route::get('', \App\Http\Controllers\Panel\Company\ShowCompanyController::class)->name('panel.company.show');
        Route::get('create', \App\Http\Controllers\Panel\Company\CreateCompanyController::class)->name('panel.company.create');
        Route::post('create', \App\Http\Controllers\Panel\Company\StoreCompanyController::class)->name('panel.company.store');

        Route::get('edit', \App\Http\Controllers\Panel\Company\EditCompanyController::class)->name('panel.company.edit');
        Route::patch('edit', \App\Http\Controllers\Panel\Company\UpdateCompanyController::class)->name('panel.company.update');
    });
});


require __DIR__.'/auth.php';

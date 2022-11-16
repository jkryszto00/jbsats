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

Route::get('', \App\Http\Controllers\Site\IndexController::class)->name('site.index');
Route::get('jobs', \App\Http\Controllers\Site\JobOffer\IndexJobOfferController::class)->name('site.jobs.index');
Route::get('companies', \App\Http\Controllers\Site\Company\IndexCompanyController::class)->name('site.companies.index');

Route::get('jobs/{jobOffer}', \App\Http\Controllers\Site\JobOffer\ShowJobOfferController::class)->name('site.jobs.show');
Route::get('companies/{company}', \App\Http\Controllers\Site\Company\ShowCompanyController::class)->name('site.companies.show');

Route::post('jobs/{jobOffer}/apply', \App\Http\Controllers\Site\JobOffer\ApplyJobOfferController::class)->name('site.jobs.apply');

Route::group(['prefix' => 'panel', 'middleware' => 'employer'], function () {
    Route::get('', \App\Http\Controllers\Panel\DashboardController::class)->name('panel.dashboard');

    Route::group(['prefix' => 'posting'], function () {
        Route::get('', \App\Http\Controllers\Panel\JobOffer\IndexJobOfferController::class)->name('panel.posting.index');
        Route::get('new', \App\Http\Controllers\Panel\JobOffer\CreateJobOfferController::class)->name('panel.posting.create');
        Route::post('new', \App\Http\Controllers\Panel\JobOffer\StoreJobOfferController::class)->name('panel.posting.store');

        Route::get('{jobOffer}/edit', \App\Http\Controllers\Panel\JobOffer\EditJobOfferController::class)->name('panel.posting.edit');
        Route::patch('{jobOffer}/edit', \App\Http\Controllers\Panel\JobOffer\UpdateJobOfferController::class)->name('panel.posting.update');

        Route::delete('{jobOffer}', \App\Http\Controllers\Panel\JobOffer\DeleteJobOfferController::class)->name('panel.posting.delete');

        Route::patch('{jobOffer}/publish', \App\Http\Controllers\Panel\JobOffer\PublishJobOfferController::class)->name('panel.posting.publish');
        Route::get('{jobOffer}/preview', \App\Http\Controllers\Panel\JobOffer\PreviewJobOfferController::class)->name('panel.posting.preview');
    });

    Route::group(['prefix' => 'candidates'], function () {
        Route::get('', \App\Http\Controllers\Panel\Apply\IndexApplyController::class)->name('panel.apply.index');
        Route::get('{jobOffer}', \App\Http\Controllers\Panel\Apply\ShowApplyController::class)->name('panel.apply.show');

        Route::patch('{apply}/accept', \App\Http\Controllers\Panel\Apply\AcceptApplyController::class)->name('panel.apply.accept');
        Route::patch('{apply}/reject', \App\Http\Controllers\Panel\Apply\RejectApplyController::class)->name('panel.apply.reject');
    });

    Route::group(['prefix' => 'company'], function () {
        Route::get('', \App\Http\Controllers\Panel\Company\ShowCompanyController::class)->name('panel.company.show');
        Route::get('create', \App\Http\Controllers\Panel\Company\CreateCompanyController::class)->name('panel.company.create');
        Route::post('create', \App\Http\Controllers\Panel\Company\StoreCompanyController::class)->name('panel.company.store');

        Route::get('edit', \App\Http\Controllers\Panel\Company\EditCompanyController::class)->name('panel.company.edit');
        Route::patch('edit', \App\Http\Controllers\Panel\Company\UpdateCompanyController::class)->name('panel.company.update');
    });
});


require __DIR__.'/auth.php';

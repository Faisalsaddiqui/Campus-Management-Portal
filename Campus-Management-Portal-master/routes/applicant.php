<?php

use App\Http\Controllers\Applicant\AcademicDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Applicant\ApplicantController;
use App\Http\Controllers\Applicant\ApplicationController;

//applicant routes

Route::group(['middleware' => ['role:applicant']], function () {
  Route::prefix('applicant')->group(function () {
    Route::get('/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.dashboard');

    //Applications for applicant
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applicant.applications');
    Route::get('/apply', [ApplicationController::class, 'create'])->name('applicant.applications.create');

    Route::post('/apply', [ApplicationController::class, 'store'])->name('applicant.applications.store');

    //Academic Details
    Route::get('/academic_details', [AcademicDetailsController::class, 'index'])->name('applicant.academic-details');
    Route::get('/academic_details/add', [AcademicDetailsController::class, 'create'])->name('applicant.academic-details.create');
    Route::get('/academic_details/{academicDetail}/edit', [AcademicDetailsController::class, 'edit'])->name('applicant.academic-details.edit');

    Route::post('/academic_details/add', [AcademicDetailsController::class, 'store'])->name('applicant.academic-details.store');
  });
});

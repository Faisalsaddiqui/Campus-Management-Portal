<?php

use App\Http\Controllers\Student\CourseDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/enroll', [CourseDetailsController::class, 'enroll']);
// });


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/can_manage_applications', function () {
        return auth()->user()->can('manage_applications');
    })->name('api.admin.manage_applications');
});

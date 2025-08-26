<?php

use App\Http\Controllers\MedicalCheckupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

Route::middleware(['auth'])->group(function () {

    Route::get('/medicalcheckup', [MedicalCheckupController::class, 'index'])->name('medicalcheckup');
    Route::get('/getkunjungan', [MedicalCheckupController::class, 'getKunjungan'])->name('medicalcheckup.getkunjungan');
    Route::get('/gettindakan', [MedicalCheckupController::class, 'gettindakan'])->name('medicalcheckup.gettindakan');

    //Update User Details
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

    // Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

});

Route::get('/portal/{token}', [App\Http\Controllers\PortalController::class, 'index'])->name('portal');
Route::post('/portal-submit/{token}', [App\Http\Controllers\PortalController::class, 'submit'])->name('portal.submit');

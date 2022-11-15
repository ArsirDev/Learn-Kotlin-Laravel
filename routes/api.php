<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('learn-kotlin-login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login'); 

Route::post('learn-kotlin-register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register'); 


// Materi

Route::post('learn-kotlin-set-input-materi', [App\Http\Controllers\MateriController::class, 'setInputMateri'])->middleware('auth:api'); 

Route::post('learn-kotlin-update-materi', [App\Http\Controllers\MateriController::class, 'setUpdate'])->middleware('auth:api'); 

Route::get('learn-kotlin-delete-materi', [App\Http\Controllers\MateriController::class, 'deleteMateri']); 

Route::get('learn-kotlin-get-detail-materi', [App\Http\Controllers\MateriController::class, 'getDetailMateri']); 

Route::get('learn-kotlin-get-all-input-materi', [App\Http\Controllers\MateriController::class, 'getAllInputMateri']); 

Route::get('learn-kotlin-get-input-materi-by-id', [App\Http\Controllers\MateriController::class, 'getInputMateriById'])->middleware('auth:api'); 

// Kuis

Route::post('learn-kotlin-set-input-kuis', [App\Http\Controllers\KuisController::class, 'setInputKuis'])->middleware('auth:api'); 

Route::post('learn-kotlin-update-kuis', [App\Http\Controllers\KuisController::class, 'setUpdate'])->middleware('auth:api'); 

Route::get('learn-kotlin-get-detail-kuis', [App\Http\Controllers\KuisController::class, 'getDetailKuis']); 

Route::get('learn-kotlin-delete-kuis', [App\Http\Controllers\KuisController::class, 'deleteKuis']); 

Route::get('learn-kotlin-get-all-input-kuis', [App\Http\Controllers\KuisController::class, 'getAllInputKuis']); 

Route::get('learn-kotlin-get-input-kuis-by-id', [App\Http\Controllers\KuisController::class, 'getInputKuisById'])->middleware('auth:api'); 



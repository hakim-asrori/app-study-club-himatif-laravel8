<?php

use App\Http\Controllers\API\AppController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
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

Route::prefix('v2/')->group(function () {
    // Authentication
    Route::post('login', [AuthController::class, 'login']);
    Route::post('registration', [AuthController::class, 'registration']);

    // Counting User, Materi, Tugas, dan Bidang Study
    Route::get('counting', [AppController::class, 'counting']);

    // Profile
    Route::get('profile/{id}', [ProfileController::class, 'index']);
    Route::put('profile/{id}', [ProfileController::class, 'update']);
});

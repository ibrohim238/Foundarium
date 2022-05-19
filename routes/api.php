<?php

use App\Http\Controllers\CarController;
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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cars', [CarController::class, 'index'])->name('car.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('car.show');

Route::middleware('auth')->group(function () {
    Route::post('/cars', [CarController::class, 'createOrUpdate'])->name('car.create-or-update');
    Route::delete('/cars/', [CarController::class, 'destroy'])->name('car.destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\ClientController;
use \App\Http\Controllers\API\CarController;


Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('index'); // /clients
    Route::get('/{client}/cars', [ClientController::class, 'getClientCars'])->name('cars.index'); // /clients/{client}/cars
    Route::get('/{client}/cars/{car}/services', [CarController::class, 'getClientCarServices'])->name('cars.services.index'); // /clients/{client}/cars/{car}/services
    Route::post('/search', [ClientController::class, 'searchClient']);
});

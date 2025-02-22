<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\ClientController;

Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/{id}/cars', [ClientController::class, 'getClientCars']);

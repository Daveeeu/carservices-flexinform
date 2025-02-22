<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\ClientController;

Route::get('/clients', [ClientController::class, 'index']);

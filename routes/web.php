<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfertaController;


Route::get('/', [OfertaController::class, 'index']);

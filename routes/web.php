<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfertaController;


Route::redirect('/', '/ofertas');
Route::resource('ofertas', OfertaController::class);

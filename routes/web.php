<?php

use App\Http\Controllers\CicloFormativoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Modulo B: CRUD ciclo Formativo

    Route::resource('ciclos', CicloFormativoController::class);

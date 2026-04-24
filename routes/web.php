<?php

use App\Http\Controllers\CicloFormativoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('ciclos.index');
});

//Modulo B: CRUD ciclo Formativo

    Route::resource('ciclos', CicloFormativoController::class);

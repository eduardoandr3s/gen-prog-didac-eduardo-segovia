<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CicloFormativo;
use Illuminate\Http\Request;

class CicloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // inicializo la variable $ciclos con todos los ciclos ordenados alfabatecimante por la columna nombre
        $ciclos = CicloFormativo::orderBy('nombre')
        ->paginate(10);

        //retorno la vista pasandlole la variable $ciclos
        return view('ciclos.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

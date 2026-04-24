<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CicloFormativoRequest;
use App\Models\CicloFormativo;
use Illuminate\Http\Request;

class CicloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // arranco la query builder para ir añadiendo filtros según lleguen por la URL
        $query = CicloFormativo::query();

        // filtro 1: busco texto libre en nombre o familia profesional usando LIKE
        if ($request->filled('q')) {
            $buscar = $request->input('q');
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'LIKE', "%{$buscar}%")
                    ->orWhere('familia_profesional', 'LIKE', "%{$buscar}%");
            });
        }
        // filtro 2: grado exacto (Grado Superior / Grado Medio)
        if ($request->filled('grado')) {
            $query->where('grado', $request->input('grado'));
        }

        // filtro 3: modalidad exacta (Presencial / Semipresencial)
        if ($request->filled('modalidad')) {
            $query->where('modalidad', $request->input('modalidad'));
        }

        // filtro 4: estado activo/inactivo, convierto el string del select a booleano
        if ($request->filled('estado')) {
            $query->where('activo', $request->input('estado') === 'activos');
        }

        // pagino 10 por página y con withQueryString mantengo los filtros al cambiar de página
        $ciclos = $query->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('ciclos.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * retorno la vista para crear un ciclo
     *
     *
     */
    public function create()
    {
        return view('ciclos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Inserto el nuevo ciclo en la base de datos
     *
     * Al usar CicloFormativoRequest en vez de Request, se valida de forma automatica antes de entrar al método. Si falla antes,
     * redirige a la vista anterior, mostrando los errores.
     */
    public function store(CicloFormativoRequest $request)
    {
        CicloFormativo::create($request->validated());

        return redirect()
            ->route('ciclos.index')
            ->with('success', 'Ciclo formativo creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * Muestro un ciclo con sus relaciones, en este caso las programaciones asociadas.
     *
     */
    public function show(CicloFormativo $ciclo)
    {
        $ciclo->load('programaciones');

        return view('ciclos.show', compact('ciclo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * Con esto muesto el formulario para editar un ciclo que existe
     * laravel lo busca a través de su id
     *
     */
    public function edit(CicloFormativo $ciclo)
    {
        return view('ciclos.edit', compact('ciclo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * metodo para actualizar un ciclo formativo, una vez actualizado devuelve a la vista del ciclo actualizado
     *
     */
    public function update(CicloFormativoRequest $request, CicloFormativo $ciclo)
    {
        $ciclo->update($request->validated());

        return redirect()
            ->route('ciclos.show', $ciclo)
            ->with('success', 'ciclo fromativo actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     * Con este metodo elimino un ciclo formativo de la base de datos,
     * Protejo del borrado a los ciclos que tienen programaciones asociadas,
     * así, protejo la integridad de los datos y la referencia de la relación.
     */
    public function destroy(CicloFormativo $ciclo)
    {
        // con este IF compruebo si hay programaciones asociadas, si es que las hay retorno al index, si no las hay ejecuto el delete.
        if ($ciclo->programaciones()->exists()) {
            return redirect()
                ->route('ciclos.index')
                ->with('error', 'No se puede eliminar el ciclo "' . $ciclo->nombre . '" porque tiene programaciones asociadas.');
        }
        $ciclo->delete();

        //retorno a la vista del index una vez eliminado.
        return redirect()
            ->route('ciclos.index')
            ->with('success', 'Ciclo formativo eliminado correctamente.');
    }
}

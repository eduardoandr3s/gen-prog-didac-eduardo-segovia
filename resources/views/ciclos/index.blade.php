@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Ciclos Formativos</h1>
        <a href="{{ route('ciclos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo ciclo
        </a>
    </div>

{{-- FORMULARIO ED FILTROS --}}

     <form action="{{ route('ciclos.index') }}" method="GET" class="card shadow-sm mb-4">
      <div class="card-body">
          <div class="row g-3 align-items-end">
              <div class="col-md-4">
                  <label for="q" class="form-label">Buscar</label>
                  <input type="text" class="form-control" id="q" name="q"
                         value="{{ request('q') }}"
                         placeholder="Nombre o familia profesional...">
              </div>
              <div class="col-md-2">
                  <label for="grado" class="form-label">Grado</label>
                  <select class="form-select" id="grado" name="grado">
                      <option value="">Todos</option>
                      <option value="Grado Superior" {{ request('grado') === 'Grado Superior' ? 'selected' : '' }}>Grado Superior</option>
                      <option value="Grado Medio" {{ request('grado') === 'Grado Medio' ? 'selected' : '' }}>Grado Medio</option>
                  </select>
              </div>
              <div class="col-md-2">
                  <label for="modalidad" class="form-label">Modalidad</label>
                  <select class="form-select" id="modalidad" name="modalidad">
                      <option value="">Todas</option>
                      <option value="Presencial" {{ request('modalidad') === 'Presencial' ? 'selected' : '' }}>Presencial</option>
                      <option value="Semipresencial" {{ request('modalidad') === 'Semipresencial' ? 'selected' : '' }}>Semipresencial</option>
                  </select>
              </div>
              <div class="col-md-2">
                  <label for="estado" class="form-label">Estado</label>
                  <select class="form-select" id="estado" name="estado">
                      <option value="">Todos</option>
                      <option value="activos" {{ request('estado') === 'activos' ? 'selected' : '' }}>Activos</option>
                      <option value="inactivos" {{ request('estado') === 'inactivos' ? 'selected' : '' }}>Inactivos</option>
                  </select>
              </div>
              <div class="col-md-2 d-flex gap-2">
                  <button type="submit" class="btn btn-primary flex-grow-1">Buscar</button>
                  <a href="{{ route('ciclos.index') }}" class="btn btn-outline-secondary" title="Limpiar filtros">✕</a>
              </div>
          </div>
      </div>
  </form>

  {{-- Contador de resultados con enlace para limpiar filtros si hay alguno activo --}}
  <p class="text-muted small mb-3">
      @if($ciclos->total() === 1)
          1 ciclo encontrado
      @else
          {{ $ciclos->total() }} ciclos encontrados
      @endif
      @if(request()->hasAny(['q', 'grado', 'modalidad', 'estado']))
          · <a href="{{ route('ciclos.index') }}">limpiar filtros</a>
      @endif
  </p>


    @if($ciclos->isEmpty())
        <div class="alert alert-info">
            No hay ciclos formativos registrados todavía.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Familia profesional</th>
                        <th>Grado</th>
                        <th>Modalidad</th>
                        <th class="text-center">Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ciclos as $ciclo)
                        <tr>
                            <td><strong>{{ $ciclo->nombre }}</strong></td>
                            <td>{{ $ciclo->familia_profesional }}</td>
                            <td>{{ $ciclo->grado }}</td>
                            <td>{{ $ciclo->modalidad }}</td>
                            <td class="text-center">
                                @if($ciclo->activo)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('ciclos.show', $ciclo) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                <a href="{{ route('ciclos.edit', $ciclo) }}" class="btn btn-sm btn-outline-warning">Editar</a>

                                {{--
                                    Formu para borrar con confirmación al usuario en caso de que canceleno envío el formulario
                                --}}
                                <form action="{{ route('ciclos.destroy', $ciclo) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Estás seguro de eliminar el ciclo &quot;{{ $ciclo->nombre }}&quot;? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $ciclos->links() }}
        </div>
    @endif
</div>
@endsection

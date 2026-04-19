@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Ciclos Formativos</h1>
        <a href="{{ route('ciclos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo ciclo
        </a>
    </div>

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

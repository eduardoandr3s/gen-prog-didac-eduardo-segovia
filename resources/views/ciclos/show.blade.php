@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Cabecera con acciones --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 mb-1">{{ $ciclo->nombre }}</h1>
            <p class="text-muted mb-0">{{ $ciclo->familia_profesional }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('ciclos.index') }}" class="btn btn-outline-secondary">Volver</a>
            <a href="{{ route('ciclos.edit', $ciclo) }}" class="btn btn-warning">Editar</a>

            {{--
                Form para borrarr un ciclo, mismo comportamiento que en listado, pide confirmación para eliminar y si confirma puede cancelar
            --}}
            <form action="{{ route('ciclos.destroy', $ciclo) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm('¿Estás seguro de eliminar el ciclo &quot;{{ $ciclo->nombre }}&quot;? Esta acción no se puede deshacer.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>

    {{-- Tarjeta con los datos del ciclo formativo--}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h2 class="h5 mb-0">Información del ciclo</h2>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Grado</small>
                    <strong>{{ $ciclo->grado }}</strong>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Modalidad</small>
                    <strong>{{ $ciclo->modalidad }}</strong>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Estado</small>
                    @if($ciclo->activo)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Creado</small>
                    <strong>{{ $ciclo->created_at->format('d/m/Y') }}</strong>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Decreto de referencia</small>
                    <strong>{{ $ciclo->decreto_referencia ?? '—' }}</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- Tarjeta con las programaciones asociadas al ciclo formativo (relación)--}}
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Programaciones didácticas</h2>
            <span class="badge bg-primary rounded-pill">{{ $ciclo->programaciones->count() }}</span>
        </div>
        <div class="card-body">
            @if($ciclo->programaciones->isEmpty())
                <p class="text-muted mb-0">Este ciclo todavía no tiene programaciones didácticas asociadas.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($ciclo->programaciones as $programacion)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>{{ $programacion->titulo }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $programacion->modulo }} ·
                                    Curso {{ $programacion->curso_academico }} ·
                                    {{ $programacion->docente }}
                                </small>
                            </div>
                            <span class="badge bg-info text-dark">{{ $programacion->horas_totales }} h</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection

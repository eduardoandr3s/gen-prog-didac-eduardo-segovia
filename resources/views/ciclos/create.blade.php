@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Nuevo ciclo formativo</h1>
                <a href="{{ route('ciclos.index') }}" class="btn btn-outline-secondary">Volver</a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body"> {{--  Se deja novalidate en la etiqueta del formulario, para devolver los mensajes desde el servidor --}}
                    <form action="{{ route('ciclos.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   id="nombre"
                                   name="nombre"
                                   value="{{ old('nombre') }}"
                                   required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="familia_profesional" class="form-label">Familia profesional <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('familia_profesional') is-invalid @enderror"
                                   id="familia_profesional"
                                   name="familia_profesional"
                                   value="{{ old('familia_profesional') }}"
                                   required>
                            @error('familia_profesional')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="grado" class="form-label">Grado <span class="text-danger">*</span></label>
                                <select class="form-select @error('grado') is-invalid @enderror"
                                        id="grado"
                                        name="grado"
                                        required>
                                    <option value="">-- Selecciona --</option>
                                    <option value="Grado Superior" {{ old('grado') === 'Grado Superior' ? 'selected' : '' }}>Grado Superior</option>
                                    <option value="Grado Medio" {{ old('grado') === 'Grado Medio' ? 'selected' : '' }}>Grado Medio</option>
                                </select>
                                @error('grado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="modalidad" class="form-label">Modalidad <span class="text-danger">*</span></label>
                                <select class="form-select @error('modalidad') is-invalid @enderror"
                                        id="modalidad"
                                        name="modalidad"
                                        required>
                                    <option value="">-- Selecciona --</option>
                                    <option value="Presencial" {{ old('modalidad') === 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="Semipresencial" {{ old('modalidad') === 'Semipresencial' ? 'selected' : '' }}>Semipresencial</option>
                                </select>
                                @error('modalidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="decreto_referencia" class="form-label">Decreto de referencia</label>
                            <input type="text"
                                   class="form-control @error('decreto_referencia') is-invalid @enderror"
                                   id="decreto_referencia"
                                   name="decreto_referencia"
                                   value="{{ old('decreto_referencia') }}"
                                   placeholder="Ej: RD 405/2023, de 29 de mayo">
                            @error('decreto_referencia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="hidden" name="activo" value="0">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="activo"
                                   name="activo"
                                   value="1"
                                   {{ old('activo', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Ciclo activo</label>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('ciclos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Crear ciclo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

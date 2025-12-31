@extends('layouts.layout')

@section('title', 'Editar comentario')

@section('content')

<div class="container" style="max-width:600px;">
    <h1>Editar comentario</h1>

    <form method="POST" action="{{ route('comentarios.update', $comentario) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Comentario</label>
            <textarea name="texto" class="form-control" required>{{ $comentario->texto }}</textarea>
        </div>

        <div class="mb-3">
            <label>Valoración (1 a 5)</label>
            <select name="valoracion" class="form-select" required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @selected($comentario->valoracion == $i)>
                        {{ $i }}⭐
                    </option>
                @endfor
            </select>
        </div>

        <button class="btn btn-primary">Guardar cambios</button>
        <a href="{{ route('producto.show', $comentario->producto_id) }}"
           class="btn btn-secondary">
            Volver
        </a>
    </form>
</div>

@endsection

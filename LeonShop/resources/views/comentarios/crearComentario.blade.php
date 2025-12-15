@extends('layouts/layout')

@section('title', 'Nuevo comentario')

@section('content')

<div class="container" style="max-width:600px;">
    <h2 class="mb-4">Comentar producto</h2>

    <form method="POST" action="{{ route('comentarios.store', $producto) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Valoración</label>
            <select name="valoracion" class="form-select" required>
                <option value="">Selecciona</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Comentario</label>
            <textarea name="texto" class="form-control" rows="4" required></textarea>
        </div>

        <button class="btn btn-primary w-100">
            Enviar comentario
        </button>
    </form>
</div>

@endsection

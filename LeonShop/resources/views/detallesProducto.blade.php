@extends('layouts/layout')

@section('title', $producto->nombre)

@section('content')

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;">

    <h2>{{ $producto->nombre }}</h2>
    <p><strong>Modelo:</strong> {{ $producto->modelo }}</p>
    <p><strong>Precio:</strong> {{ $producto->precio }} €</p>
    <p><strong>Unidades disponibles:</strong> {{ $producto->unidades }}</p>

    <br>

    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
        Volver a la tienda
    </a>

    @auth
    <a href="{{ route('compras.create', $producto) }}" class="btn btn-primary btn-sm">
        Comprar
    </a>
@else
    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
        Comprar
    </a>
@endauth

</div>

@auth
    @if ($puedeComentar)
        <a href="{{ route('comentarios.create', $producto) }}"
           class="btn btn-primary mb-3">
            Añadir comentario
        </a>
    @endif
@endauth

<h3 class="mt-4">Comentarios</h3>

@if ($comentarios->isEmpty())
    <p>No hay comentarios todavía.</p>
@else
    @foreach ($comentarios as $comentario)
    <div class="card mb-3">
        <div class="card-body">

            <strong>{{ $comentario->user->name }}</strong>

            <span class="text-warning ms-2">
                @for ($i = 1; $i <= 5; $i++)
                    {{ $i <= $comentario->valoracion ? '★' : '☆' }}
                @endfor
            </span>

            <p class="mt-2">{{ $comentario->texto }}</p>

            <small class="text-muted">
                {{ $comentario->fecha }}
            </small>

            {{-- ACCIONES --}}
            <div class="mt-2">

                {{-- EDITAR: solo dueño --}}
                @auth
                    @if ($comentario->user_id === auth()->id())
                        <a href="{{ route('comentarios.edit', $comentario) }}"
                           class="btn btn-warning btn-sm">
                            Editar
                        </a>
                    @endif
                @endauth

                {{-- ELIMINAR: solo admin --}}
                @auth
                    @if (auth()->user()->is_admin)
                        <form method="POST"
                              action="{{ route('comentarios.destroy', $comentario) }}"
                              style="display:inline;"
                              onsubmit="return confirm('¿Eliminar este comentario?');">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Eliminar
                            </button>
                        </form>
                    @endif
                @endauth

            </div>

        </div>
    </div>
@endforeach

@endif




@endsection

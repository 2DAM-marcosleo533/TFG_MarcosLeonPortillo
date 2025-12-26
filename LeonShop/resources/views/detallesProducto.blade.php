@extends('layouts/layout')

@section('title', $producto->nombre)

@section('content')

@php
    $imagenProducto = 'imagenes/default.png';

    switch ($producto->tipo) {
        case 'Camiseta':
            $imagenProducto = 'imagenes/camiseta.png';
            break;
        case 'Pantalón':
            $imagenProducto = 'imagenes/pantalon.png';
            break;
        case 'Sudadera':
            $imagenProducto = 'imagenes/sudadera.png';
            break;
        case 'Zapatos':
            $imagenProducto = 'imagenes/zapatos.png';
            break;
        case 'Chaqueta':
            $imagenProducto = 'imagenes/chaqueta.png';
            break;
        case 'Jersey':
            $imagenProducto = 'imagenes/jersey.png';
            break;
        case 'Shorts':
            $imagenProducto = 'imagenes/shorts.png';
            break;
    }
@endphp

{{-- TARJETA PRODUCTO --}}
<div style="
    max-width:700px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:10px;
    display:flex;
    gap:20px;
    align-items:center;
">

    {{-- INFO --}}
    <div style="flex:1;">
        <h2>{{ $producto->nombre }}</h2>
        <p><strong>Modelo:</strong> {{ $producto->modelo }}</p>
        <p><strong>Precio:</strong> {{ $producto->precio }} €</p>
        <p><strong>Unidades disponibles:</strong> {{ $producto->unidades }}</p>
        <p><strong>Tipo:</strong> {{ $producto->tipo }}</p>
        <p><strong>Marca:</strong> {{ $producto->marca->nombre }}</p>
        <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>

        {{-- BOTONES --}}

        <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-return-left"></i>
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

    {{-- IMAGEN --}}
    <div style="width:180px;">
        <img src="{{ asset($imagenProducto) }}"
             alt="{{ $producto->tipo }}"
             style="width:100%; object-fit:contain;">
    </div>
</div>

{{-- BOTÓN NUEVO COMENTARIO --}}
@auth
    @if ($puedeComentar)
        <div class="text-center mt-4">
            <a href="{{ route('comentarios.create', $producto) }}"
               class="btn btn-primary">
                Añadir comentario
            </a>
        </div>
    @endif
@endauth

<h3 class="mt-5">Comentarios</h3>

@if ($comentarios->isEmpty())
    <p>No hay comentarios todavía.</p>
@else

    @foreach ($comentarios as $comentario)

        <div class="card mb-3" style="max-width:700px; margin:auto;">
            <div class="card-body" style="display:flex; gap:20px; align-items:center;">

                {{-- TEXTO --}}
                <div style="flex:1;">
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

                        {{-- EDITAR --}}
                        @auth
                            @if ($comentario->user_id === auth()->id())
                                <a href="{{ route('comentarios.edit', $comentario) }}"
                                   class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                            @endif
                        @endauth

                        {{-- ELIMINAR (ADMIN) --}}
                        @auth
                            @if (auth()->user()->is_admin)
                                <form method="POST"
                                      action="{{ route('comentarios.destroy', $comentario) }}"
                                      style="display:inline;"
                                      onsubmit="return confirm('¿Eliminar este comentario?');">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>

    @endforeach

@endif

@endsection

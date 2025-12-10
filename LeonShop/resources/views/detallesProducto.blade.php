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
</a>
</div>

@endsection

@extends('layouts/layout')

@section('title', 'Inicio')

@section('content')

<h1 style="text-align:center;">LEONSHOP</h1>
<p style="text-align:center;">Bienvenido a nuestra tienda</p>

<div style="
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 30px;
">

@foreach ($productos as $producto)
    <div style="
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    ">

        <h3>{{ $producto->nombre }}</h3>

        <p><strong>Marca:</strong> {{ $producto->marca->nombre }}</p>

        <p><strong>Precio:</strong> {{ $producto->precio }} €</p>

        <p><strong>Unidades:</strong> {{ $producto->unidades }}</p>

        @if ($producto->unidades == 0)
            <p style="color:red; font-weight:bold;">AGOTADO</p>
        @endif

        <a href="{{ route('producto.show', $producto) }}" class="btn btn-primary">
   Comprar
</a>
    </div>
@endforeach

</div>

@endsection

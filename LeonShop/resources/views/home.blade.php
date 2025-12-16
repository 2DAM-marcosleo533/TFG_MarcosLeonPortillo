@extends('layouts/layout')

@section('title', 'Inicio')

@section('content')


<form method="GET" action="{{ route('home') }}" style="max-width:600px; margin:20px auto;">

    {{-- Buscador --}}
    <input type="text"
           name="buscar"
           class="form-control mb-2"
           placeholder="Buscar producto..."
           value="{{ $busqueda ?? '' }}">

    {{-- Filtro marca --}}
    <select name="marca" class="form-select mb-2">
        <option value="">-- Todas las marcas --</option>
        @foreach ($marcas as $marca)
            <option value="{{ $marca->id }}"
                @selected(($marcaSeleccionada ?? '') == $marca->id)>
                {{ $marca->nombre }}
            </option>
        @endforeach
    </select>

    {{-- Filtro tipo --}}
    <select name="tipo" class="form-select mb-2">
        <option value="">-- Todos los tipos --</option>
        @foreach ($tipos as $tipo)
            <option value="{{ $tipo }}"
                @selected(($tipoSeleccionado ?? '') == $tipo)>
                {{ $tipo }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary w-100" type="submit">
        Filtrar
    </button>
</form>


<div style="
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 30px;
">

@foreach ($productos as $producto)

    @php
        $imagen = 'imagenes/default.png';

        switch ($producto->tipo) {
            case 'Camiseta':
                $imagen = 'imagenes/camiseta.png';
                break;
            case 'Pantalón':
                $imagen = 'imagenes/pantalon.png';
                break;
            case 'Sudadera':
                $imagen = 'imagenes/sudadera.png';
                break;
            case 'Zapatos':
                $imagen = 'imagenes/zapatos.png';
                break;
            case 'Chaqueta':
                $imagen = 'imagenes/chaqueta.png';
                break;
            case 'Jersey':
                $imagen = 'imagenes/jersey.png';
                break;
            case 'Shorts':
                $imagen = 'imagenes/shorts.png';
                break;
        }
    @endphp

    <div style="
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    ">

        <img src="{{ asset($imagen) }}"
             alt="{{ $producto->tipo }}"
             style="
                width:100%;
                max-height:150px;
                object-fit:contain;
                margin-bottom:10px;
             ">

        <h3>{{ $producto->nombre }}</h3>

        <p><strong>Marca:</strong> {{ $producto->marca->nombre }}</p>
        <p><strong>Precio:</strong> {{ $producto->precio }} €</p>
        <p><strong>Tipo:</strong> {{ $producto->tipo }}</p>

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

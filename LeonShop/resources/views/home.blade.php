@extends('layouts/layout')

@section('title', 'Inicio')

@section('content')

<style>
    body {
        background:#f5f5f5;
    }

    .titulo {
        text-align:center;
        padding:60px 20px 40px;
    }

    .titulo h1 {
        font-size:52px;
        letter-spacing:4px;
        font-weight:800;
        margin-bottom:10px;
    }

    .titulo p {
        color:#777;
        font-size:18px;
    }

    .filtros {
        max-width:1000px;
        margin:0 auto 50px;
        background:white;
        padding:25px;
        border-radius:18px;
        box-shadow:0 15px 40px rgba(0,0,0,.08);
    }

    .filtros-grid {
        display:grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap:15px;
    }

    .product-grid {
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap:40px;
        padding-bottom:60px;
    }

    .product-card {
        background:white;
        border-radius:22px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,.08);
        transition:.35s;
        position:relative;
    }

    .product-card:hover {
        transform:translateY(-8px);
        box-shadow:0 20px 45px rgba(0,0,0,.15);
    }

    .product-image {
        background:linear-gradient(135deg,#f7f7f7,#eaeaea);
        padding:30px;
        text-align:center;
    }

    .product-image img {
        max-height:200px;
        transition:.4s;
    }

    .product-card:hover img {
        transform:scale(1.08);
    }

    .product-info {
        padding:22px;
    }

    .product-info h3 {
        font-size:20px;
        margin-bottom:6px;
    }

    .product-info .meta {
        color:#888;
        font-size:14px;
        margin-bottom:12px;
    }

    .price {
        font-size:22px;
        font-weight:800;
        margin-bottom:15px;
    }

    .btn-buy {
        width:100%;
        padding:10px;
        border-radius:30px;
        background:black;
        color:white;
        font-weight:600;
        border:none;
        transition:.3s;
        text-decoration:none;
        display:block;
        text-align:center;
    }

    .btn-buy:hover {
        background:#333;
        color:white;
    }

    .sold-out {
        position:absolute;
        top:15px;
        right:-40px;
        background:#c0392b;
        color:white;
        padding:6px 50px;
        font-size:13px;
        font-weight:700;
        transform:rotate(45deg);
    }

    .icono-lupa {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }
    
</style>

{{-- titulo principal --}}
<div class="titulo">
    <h1>LEONSHOP</h1>
    <p>
        Moda urbana | Estilo premium | Edición limitada
    </p>
</div>

{{-- filtros de busqueda--}}
<form method="GET" action="{{ route('home') }}" class="filtros">
    <div class="filtros-grid">

        <div style="position: relative;">
            <input type="text"
                   name="buscar"
                   class="form-control"
                   placeholder="Buscar producto"
                   value="{{ $busqueda ?? '' }}"
                   style="padding-left: 38px;">
            <i class="bi bi-search icono-lupa"></i>
        </div>

        <select name="marca" class="form-select">
            <option value="">Todas las marcas</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}"
                    @selected(($marcaSeleccionada ?? '') == $marca->id)>
                    {{ $marca->nombre }}
                </option>
            @endforeach
        </select>

        <select name="tipo" class="form-select">
            <option value="">Todos los tipos</option>
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo }}"
                    @selected(($tipoSeleccionado ?? '') == $tipo)>
                    {{ $tipo }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-dark px-4 rounded-pill">
            Filtrar
        </button>

    </div>
</form>

{{-- productos que salen para comprar--}}
<div class="product-grid">

@foreach ($productos as $producto)

    @php
        $imagen = 'imagenes/default.png';
        switch ($producto->tipo) {
            case 'Camiseta': $imagen = 'imagenes/camiseta.png'; 
            break;
            case 'Pantalón': $imagen = 'imagenes/pantalon.png'; 
            break;
            case 'Sudadera': $imagen = 'imagenes/sudadera.png'; 
            break;
            case 'Zapatos': $imagen = 'imagenes/zapatos.png'; 
            break;
            case 'Chaqueta': $imagen = 'imagenes/chaqueta.png'; 
            break;
            case 'Jersey': $imagen = 'imagenes/jersey.png'; 
            break;
            case 'Shorts': $imagen = 'imagenes/shorts.png'; 
            break;
        }
    @endphp

    <div class="product-card">

        @if ($producto->unidades == 0)
            <div class="sold-out">AGOTADO</div>
        @endif

        <div class="product-image">
            <img src="{{ asset($imagen) }}" alt="{{ $producto->tipo }}">
        </div>

        <div class="product-info">
            <h3>{{ $producto->nombre }}</h3>

            <div class="meta">
                {{ $producto->marca->nombre }} - {{ $producto->tipo }}
            </div>

            <div class="price">
                {{ $producto->precio }} €
            </div>

            @if ($producto->unidades > 0)
                <a href="{{ route('producto.show', $producto) }}"
                   class="btn-buy">
                    Ver producto
                </a>
            @endif
        </div>
    </div>

@endforeach

</div>

@endsection

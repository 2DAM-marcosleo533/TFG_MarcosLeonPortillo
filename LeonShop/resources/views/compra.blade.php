@extends('layouts/layout')

@section('title', 'Comprar producto')

@section('content')

<style>
    
</style>

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;">

    <h2>{{ $producto->nombre }}</h2>

    {{-- detalles de compra --}}

    <p>
        <strong>
            Precio:
        </strong> 
        {{ $producto->precio }} €
    </p>
    <p>
        <strong>
            Stock disponible:
        </strong>
         {{ $producto->unidades }}
        </p>
    <p>
        
        </p>


    {{-- si hay un error por saldo o stock, se muestra --}}

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    {{-- formulario de la compra --}}

   <form method="POST" action="{{ route('carrito.add', $producto) }}">
    @csrf
    <label>Unidades:</label>
    <input type="number"
       name="cantidad"
       min="1"
       max="{{ $producto->unidades }}"
       required>

    <br><br>
    <button class="btn btn-success">
        Añadir al carrito
    </button>
    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-return-left"></i>
        </a>
</form>




</div>

@endsection

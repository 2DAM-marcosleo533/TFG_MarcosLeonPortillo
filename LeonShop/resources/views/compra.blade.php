@extends('layouts/layout')

@section('title', 'Comprar producto')

@section('content')

<style>
    
</style>

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;">

    <h2>{{ $producto->nombre }}</h2>

    {{-- detalles de compra --}}

    <p><strong>Precio:</strong> {{ $producto->precio }} €</p>
    <p><strong>Stock disponible:</strong> {{ $producto->unidades }}</p>
    <p><strong>Tu saldo:</strong> {{ auth()->user()->saldo }} €</p>


    {{-- si hay un error por saldo o stock, se muestra --}}

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    {{-- formulario de la compra --}}

    <form method="POST" action="{{ route('compras.store', $producto) }}">
        @csrf

        <label>Unidades a comprar:</label><br>
        <input type="number" name="unidades" min="1" required><br><br>

        <label>Selecciona una dirección:</label><br>
        <select name="direccion_id" required>
            @foreach($direcciones as $direccion)
                <option value="{{ $direccion->id }}">
                    Envío: {{ $direccion->direccion_envio }} | Facturación: {{ $direccion->direccion_facturacion }}
                </option>
            @endforeach
        </select><br><br>
        
        <button type="submit" class="btn btn-success btn-sm">
            Confirmar compra
        </button>
    </form>

</div>

@endsection

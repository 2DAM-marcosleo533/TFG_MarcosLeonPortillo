@extends('layouts/layout')

@section('title', 'Comprar producto')

@section('content')

<div style="max-width:600px; margin:auto; background:white; padding:20px; border-radius:10px;">

    <h2>Comprar: {{ $producto->nombre }}</h2>

    <p><strong>Precio:</strong> {{ $producto->precio }} €</p>
    <p><strong>Stock disponible:</strong> {{ $producto->unidades }}</p>
    <p><strong>Tu saldo:</strong> {{ auth()->user()->saldo }} €</p>
    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('compras.store', $producto) }}">
        @csrf

        <label>Unidades a comprar:</label><br>
        <input type="number" name="unidades" min="1" required><br><br>

        <button type="submit" class="btn btn-success btn-sm">
            Confirmar compra
        </button>
    </form>

</div>

@endsection

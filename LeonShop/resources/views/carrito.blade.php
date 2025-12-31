@extends('layouts/layout')

@section('title', 'Comprar carrito')

@section('content')
<h2>Mi carrito</h2>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


@if(empty($carrito))
    <p>El carrito está vacío</p>
@else
<table class="table">

   @foreach($carrito as $item)
<tr>
    <td>
        {{ $item['nombre'] }}
    </td>
    <td>
        {{ $item['cantidad'] }}
    </td>
    <td>
        {{ $item['precio'] }} €
    </td>
    <td>
        {{ $item['cantidad'] * $item['precio'] }} €
    </td>

    <td>
        <form method="POST" action="{{ route('carrito.remove', $item['producto_id']) }}"
              onsubmit="return confirm('¿Eliminar este producto del carrito?')">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach

    <tr>
        <td colspan="3">
            <strong>
                Total:
            </strong>
        </td>
        <td>
            <strong>
                {{ $total }} €
            </strong>
        </td>
</table>

<form method="POST" action="{{ route('carrito.checkout') }}">
    @csrf

    <select name="direccion_id" required>
        @foreach(auth()->user()->direcciones as $direccion)
            <option value="{{ $direccion->id }}">
                {{ $direccion->direccion_envio  }} 
                || 
                {{ $direccion->direccion_facturacion  }} 
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary">
        Comprar carrito
    </button>


</form>


@endif
<a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-return-left"></i>
        </a>

        @endsection
@extends('layouts/layout')

@section('title', 'Informes')

@section('content')

<h2>Informes de la tienda</h2>

<hr>

<h4>Top 5 Usuarios que más han gastado</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Total gastado (€)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topUsuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ number_format($usuario->total_gastado, 2) }} €</td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

<h4>Top 5 Productos más vendidos</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Unidades vendidas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topProductos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->total_vendido }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

<h4>Top 5 Marcas más vendidas</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Marca</th>
            <th>Unidades vendidas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topMarcas as $marca)
            <tr>
                <td>{{ $marca->nombre }}</td>
                <td>{{ $marca->total_vendido }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

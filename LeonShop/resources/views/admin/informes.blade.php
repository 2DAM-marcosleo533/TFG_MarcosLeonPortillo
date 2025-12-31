@extends('layouts/layout')

@section('title', 'Informes')

@section('content')

<style>
    /* Informes */
.informes-table {
    margin-bottom: 30px;
}

/* Botón volver */
.btn-volver-admin {
    display: inline-block;
    background: #666;
    color: white;
    padding: 12px 18px;
    border-radius: 6px;
    width: 5%;
    text-align: center;
    text-decoration: none;
}

.btn-volver-admin:hover {
    background: #555;
    color: white;
}

</style>

<h2>Informes de la tienda</h2>

<hr>

<h4>Top 5 Usuarios que más han gastado</h4>
<table class="table table-bordered informes-table">
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
<table class="table table-bordered informes-table">
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
<table class="table table-bordered informes-table">
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

<br>

<a href="{{ route('admin') }}" class="btn-volver-admin">
    <i class="bi bi-arrow-return-left"></i>
</a>

@endsection

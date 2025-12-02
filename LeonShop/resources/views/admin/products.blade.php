@extends('layouts/layout')

@section('title', 'Lista de productos')

@section('content')

<h1>Lista de productos</h1>

<table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>VIP</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->modelo }}</td>
            <td>{{ $producto->marca_id }}</td>
            <td>{{ $producto->precio }} €</td>
            <td>{{ $producto->unidades }}</td>
            <td>{{ $producto->vip ? 'Sí' : 'No' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

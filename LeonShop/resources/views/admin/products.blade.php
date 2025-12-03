@extends('layouts/layout')

@section('title', 'Lista de productos')

@section('content')

<h1>Lista de productos</h1>

<a href="{{ route('admin.productos.create') }}"
   style="display:inline-block; margin-bottom:15px; padding:10px 15px; background:#999AC6; color:white; text-decoration:none; border-radius:5px;">
    Nuevo producto
</a>

<table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->modelo }}</td>
            <td>{{ $producto->marca->nombre }}</td>
            <td>{{ $producto->precio }} €</td>
            <td>{{ $producto->unidades }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $producto->id) }}"
                   style="margin-right:10px; text-decoration:none; color:#54da77;">
                    Editar
                </a>

                <form method="POST" action="{{ route('admin.products.destroy', $producto->id) }}"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            style="background:none; border:none; color:#fd0000; cursor:pointer; padding:0;">
                        Eliminar
                    </button>
                </form>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@extends('layouts/layout')

@section('title', 'Lista de productos')

@section('content')

<h1>Lista de productos</h1>

<a href="{{ route('admin.productos.create') }}" class="btn btn-success mb-3">Nuevo producto</a>

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
                class="btn btn-primary btn-sm me-2">
                    Editar
                </a>

                <form method="POST" action="{{ route('admin.products.destroy', $producto->id) }}"
                    style="display:inline;" onsubmit="return confirm('¿Eliminar este producto?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@extends('layouts/layout')

@section('title', 'Lista de productos')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Lista de productos</h1>

    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Nuevo producto
    </a>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
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
                       class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form method="POST"
                          action="{{ route('admin.products.destroy', $producto->id) }}"
                          style="display:inline;"
                          onsubmit="return confirm('¿Eliminar este producto?');">
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
</div> {{-- cierre del container --}}

@endsection

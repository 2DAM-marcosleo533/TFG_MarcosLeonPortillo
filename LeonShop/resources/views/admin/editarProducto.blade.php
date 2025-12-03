@extends('layouts/layout')

@section('title', 'Editar Producto')

@section('content')

<h1>Editar Producto</h1>

<form action="{{ route('admin.products.update', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}" required style="display: block; width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="modelo">Modelo</label>
        <input type="text" name="modelo" id="modelo" class="form-control" value="{{ $producto->modelo }}" required style="display: block; width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" class="form-control" value="{{ $producto->precio }}" step="0.01" required style="display: block; width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="unidades">Unidades</label>
        <input type="number" name="unidades" id="unidades" class="form-control" value="{{ $producto->unidades }}" required style="display: block; width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div class="form-group" style="margin-bottom: 15px;">
        <label for="marca_id">Marca</label>
        <select name="marca_id" id="marca_id" class="form-control" required style="display: block; width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">Selecciona una marca</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}" @selected($producto->marca_id === $marca->id)>
                    {{ $marca->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" style="display:inline-block; padding:10px 15px; background:#999AC6; color:white; border:none; border-radius:5px; cursor:pointer;">
        Actualizar Producto
    </button>
    <a href="{{ route('admin.products') }}" style="display:inline-block; margin-left:10px; padding:10px 15px; background:#666; color:white; text-decoration:none; border-radius:5px;">
        Volver
    </a>
</form>

@endsection

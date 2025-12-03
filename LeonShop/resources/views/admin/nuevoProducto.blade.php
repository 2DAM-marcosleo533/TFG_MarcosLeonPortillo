@extends('layouts/layout')

@section('title', 'Nuevo Producto')

@section('content')

<h1>Crear nuevo producto</h1>

<form method="POST" action="{{ route('admin.productos.store') }}">
    @csrf

    <div>
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required>
    </div>

    <div>
        <label>Modelo:</label><br>
        <input type="text" name="modelo" required>
    </div>

    <div>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required>
    </div>

    <div>
        <label>Unidades:</label><br>
        <input type="number" name="unidades" required>
    </div>

    <div>
       
        <div>
    <label>Marca:</label><br>

    <select name="marca_id" required>
        <option value="">-- Selecciona una marca --</option>

        @foreach ($marcas as $marca)
            <option value="{{ $marca->id }}">
                {{ $marca->nombre }}
            </option>
        @endforeach
    </select>
</div>
    </div>

    <br>

    <button type="submit"
        style="background:#999AC6; color:white; padding:10px 15px; border:none; border-radius:5px;">
         Guardar producto
    </button>

</form>

@endsection

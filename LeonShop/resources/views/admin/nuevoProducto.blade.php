@extends('layouts/layout')

@section('title', 'Nuevo Producto')

@section('content')

<style>
    .form-container {
        max-width: 650px;
        margin: 40px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input, select, textarea {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    textarea {
        resize: vertical;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-row .form-group {
        flex: 1;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
    }

    .btn-primary-custom {
         background: #999AC6;
        color: white;
        font-weight: bold;
        padding: 12px 18px;
        border-radius: 6px;
        border: none;
    }

    .btn-secondary {
        background: #777;
        color: white;
    }
</style>

<div class="form-container">

    <h2>Crear nuevo producto</h2>

    <form method="POST" action="{{ route('admin.productos.store') }}">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-group">
            <label>Tipo</label>
            <select name="tipo" required>
                <option value="">
                    Selecciona un tipo
                </option>
                <option value="Camiseta">
                    Camiseta
                </option>
                <option value="Pantalón">
                    Pantalón

                </option>
                <option value="Sudadera">
                    Sudadera
                </option>
                <option value="Zapatos">
                    Zapatos
                </option>
                <option value="Chaqueta">
                    Chaqueta
                </option>
                <option value="Jersey">
                    Jersey
                </option>
                <option value="Shorts">
                    Shorts
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>
                Modelo
            </label>
            <input type="text" name="modelo" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>
                    Precio (€)
                </label>
                <input type="number" step="0.01" name="precio" required>
            </div>

            <div class="form-group">

                <label>
                    Unidades
                </label>
                <input type="number" name="unidades" required>
            </div>
        </div>

        <div class="form-group">
            <label>
                Marca
            </label>
            <select name="marca_id" required>
                <option value="">
                    Selecciona una marca
                </option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">
                        {{ $marca->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>
                Descripción
            </label>
            <textarea name="descripcion" rows="4" required></textarea>
        </div>

        <div class="buttons">
            <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-return-left"></i>
            </a>

            <button type="submit" class="btn-primary-custom">
                Guardar producto
            </button>
        </div>

    </form>

</div>

@endsection

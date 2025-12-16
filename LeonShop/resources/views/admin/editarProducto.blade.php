@extends('layouts/layout')

@section('title', 'Editar Producto')

@section('content')

<div class="container" style="max-width: 600px; margin-top: 30px;">
    
    <h1 class="mb-4">Editar producto</h1>

    <div style="background:white; padding:25px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">

        <form action="{{ route('admin.products.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control"
                       value="{{ $producto->nombre }}" required>
            </div>

            {{-- Tipo --}}
            <div class="mb-3">
                <label class="form-label">Tipo</label>
                 <select name="tipo" class="form-select" required>
        <option value="">-- Selecciona un tipo --</option>
        <option value="Camiseta">Camiseta</option>
        <option value="Pantalón">Pantalón</option>
        <option value="Sudadera">Sudadera</option>
        <option value="Zapatos">Zapatos</option>
        <option value="Chaqueta">Chaqueta</option>
        <option value="Jersey">Jersey</option>
        <option value="Shorts">Shorts</option>          
    </select>
</div>

            {{-- Modelo --}}
            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control"
                       value="{{ $producto->modelo }}" required>
            </div>

            {{-- Precio --}}
            <div class="mb-3">
                <label class="form-label">Precio (€)</label>
                <input type="number" step="0.01" name="precio" class="form-control"
                       value="{{ $producto->precio }}" required>
            </div>

            {{-- Unidades --}}
            <div class="mb-3">
                <label class="form-label">Unidades</label>
                <input type="number" name="unidades" class="form-control"
                       value="{{ $producto->unidades }}" required>
            </div>

            {{-- Marca --}}
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <select name="marca_id" class="form-select" required>
                    <option value="">-- Selecciona una marca --</option>

                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" 
                            @selected($producto->marca_id == $marca->id)>
                            {{ $marca->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-between mt-4">

                <button type="submit" class="btn"
                    style="background:#999AC6; color:white; font-weight:bold; padding:12px 18px; border-radius:6px;">
                    Actualizar Producto
                </button>

                <a href="{{ route('admin.products') }}"
                    class="btn"
                    style="background:#666; color:white; padding:12px 18px; border-radius:6px; width:10%; text-align:center;">
                    <i class="bi bi-arrow-return-left"></i>
                </a>

            </div>

        </form>
    </div>

</div>

@endsection

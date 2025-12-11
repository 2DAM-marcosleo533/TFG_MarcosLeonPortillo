@extends('layouts/layout')

@section('title', 'Nuevo Producto')

@section('content')

<div class="container" style="max-width: 600px; margin-top: 30px;">
    
    <h1 class="mb-4">Crear nuevo producto</h1>

    <div style="background:white; padding:25px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">

        <form method="POST" action="{{ route('admin.productos.store') }}">
            @csrf

            {{-- Nombre --}}
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            {{-- Modelo --}}
            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" required>
            </div>

            {{-- Precio --}}
            <div class="mb-3">
                <label class="form-label">Precio (€)</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>

            {{-- Unidades --}}
            <div class="mb-3">
                <label class="form-label">Unidades</label>
                <input type="number" name="unidades" class="form-control" required>
            </div>

            {{-- Marca --}}
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <select name="marca_id" class="form-select" required>
                    <option value="">-- Selecciona una marca --</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">
                            {{ $marca->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-between gap-2 mt-4">

                <button type="submit"
                    class="btn"
                    style="background:#999AC6; color:white; font-weight:bold; padding:12px 18px; border-radius:6px; width:50%;">
                    Guardar producto
                </button>

                <a href="{{ route('admin.products') }}"
                    class="btn"
                    style="background:#666; color:white; padding:12px 18px; border-radius:6px; width:50%; text-align:center;">
                    Volver
                </a>

            </div>

        </form>
    </div>

</div>

@endsection

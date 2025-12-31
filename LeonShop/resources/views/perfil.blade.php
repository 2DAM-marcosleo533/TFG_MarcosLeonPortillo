@extends('layouts/layout')

@section('title', 'Mi Perfil')

@section('content')

<div style="max-width:700px; margin:auto; background:white; padding:30px; border-radius:10px;">

    <h2>
        Editar Perfil
    </h2>

    {{-- si se actualiza correctamente sale mensaje --}}
    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    {{--formulario de edición de perfil --}}
   <form method="POST" action="{{ route('perfil.update') }}">
    @csrf

    <label>Nombre</label>
    <input type="text" name="name" class="form-control mb-2"
           value="{{ $user->name }}" required>

    <label>Nueva contraseña</label>
    <input type="password" name="password" class="form-control mb-2" required>

    <label>Confirmar contraseña</label>
    <input type="password" name="password_confirmation" class="form-control mb-2" required>

    {{-- si hay algun error sale mensaje --}}
    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <button class="btn btn-primary mt-3">
        Guardar cambios
    </button>
</form>

<hr class="my-4">

<h3>
    Añadir nueva dirección
</h3>

    {{-- formulario para crear direcciones --}}
<form method="POST" action="{{ route('direcciones.store') }}">
    @csrf

    <label>Dirección de envío </label>
    <textarea name="direccion_envio"
              class="form-control mb-2"
              rows="2"
              required></textarea>

    <label>Dirección de facturación</label>
    <textarea name="direccion_facturacion"
              class="form-control mb-2"
              rows="2"
              required></textarea>

    @if ($errors->any())
        <div class="text-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <button class="btn btn-success mt-2">
        Guardar dirección
    </button>
</form>

    {{-- direcciones del usuario guardadas --}}

@if ($direcciones->isNotEmpty())
    <h4 class="mt-4">Mis direcciones</h4>

    @foreach ($direcciones as $direccion)
        <div class="border p-2 mb-2 rounded">
            <strong>Envío:</strong>
            <p>{{ $direccion->direccion_envio }}</p>

            <strong>Facturación:</strong>
            <p>{{ $direccion->direccion_facturacion }}</p>
        </div>
    @endforeach
@endif

    <hr class="my-4">

        {{-- historial de compras del usuario--}}

    <h3>Historial de Compras</h3>

    @if ($compras->isEmpty())
        <p>No tienes compras realizadas</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Unidades</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td>
                            {{ $compra->producto->nombre }}
                        </td>
                        <td>
                            {{ $compra->unidades }}
                        </td>
                        <td>
                            {{ $compra->importe }} €
                        </td>
                        <td>
                            {{ $compra->fecha }}
                        </td>
                        <td>
    @if ($compra->direccion)
        <strong>Envío:</strong>
        <p>
            {{ $compra->direccion->direccion_envio }}
        </p>

        <strong>Facturación:</strong>
        <p>
            {{ $compra->direccion->direccion_facturacion }}
        </p>
    @else
        <p>Sin dirección</p>
    @endif
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

@endsection

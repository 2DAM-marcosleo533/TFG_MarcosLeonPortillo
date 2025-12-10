@extends('layouts/layout')

@section('title', 'Mi Perfil')

@section('content')

<div style="max-width:700px; margin:auto; background:white; padding:30px; border-radius:10px;">

    <h2>Editar Perfil</h2>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

   <form method="POST" action="{{ route('perfil.update') }}">
    @csrf

    <label>Nombre</label>
    <input type="text" name="name" class="form-control mb-2"
           value="{{ $user->name }}" required>

    <label>Nueva contraseña</label>
    <input type="password" name="password" class="form-control mb-2" required>

    <label>Confirmar contraseña</label>
    <input type="password" name="password_confirmation" class="form-control mb-2" required>

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

    <h3>Historial de Compras</h3>

    @if ($compras->isEmpty())
        <p>No has realizado ninguna compra aún.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Unidades</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td>{{ $compra->producto->nombre }}</td>
                        <td>{{ $compra->unidades }}</td>
                        <td>{{ $compra->importe }} €</td>
                        <td>{{ $compra->fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

@endsection

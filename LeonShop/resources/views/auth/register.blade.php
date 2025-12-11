@extends('layouts/layout')

@section('title', 'Registro')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">

    <div style="
        width: 380px;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    ">

        <h2 class="text-center mb-4" style="font-weight: 600;">Crear cuenta</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nombre --}}
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            {{-- Correo --}}
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            {{-- Contraseña --}}
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit"
                class="btn w-100 mt-2"
                style="background:#999AC6; color:white; font-weight:bold; padding:10px; border-radius:6px;">
                Crear cuenta
            </button>
        </form>

        <div class="text-center mt-3">
            <small>¿Ya tienes una cuenta?</small><br>
            <a href="{{ route('login') }}" style="color:#666; text-decoration:none; font-weight:bold;">
                Iniciar sesión
            </a>
        </div>

    </div>

</div>

@endsection

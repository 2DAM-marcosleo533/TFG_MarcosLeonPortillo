@extends('layouts/layout')

@section('title', 'Registro')

@section('content')
    <h1>Registrarse</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit">Crear cuenta</button>
    </form>
@endsection
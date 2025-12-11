@extends('layouts/layout')

@section('title', 'Iniciar sesión')

@section('content')

<style>
    .login-container {
        max-width: 350px;
        margin: 40px auto;
        text-align: center;
    }

    .login-container h1 {
        font-size: 22px;
        margin-bottom: 20px;
        font-family: 'Oswald', sans-serif;
    }

    .login-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
    }

    .login-input {
        width: 100%;
        padding: 12px;
        background-color: #F0EEE5;
        border: none;
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
    }

    .login-button {
        width: 100%;
        padding: 12px;
        background-color: #C06E52;
        color: white;
        border: none;
        font-size: 15px;
        font-family: 'Oswald', sans-serif;
        cursor: pointer;
        transition: 0.2s;
    }

    .login-button:hover {
        background-color: #C06E52;
    }
</style>

<div class="login-container">

    <h1>LOGIN</h1>

    {{-- Icono --}}
    <img class="login-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="icono login">

    {{-- Formulario --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" class="login-input" placeholder="USUARIO" required>

        <input type="password" name="password" class="login-input" placeholder="CONTRASEÑA" required>

        <button type="submit" class="login-button">Entrar</button>
    </form>

</div>

@endsection

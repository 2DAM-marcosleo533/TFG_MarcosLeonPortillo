@extends('layouts/layout')

@section('title', 'Panel Admin')

@section('content')

<h1>Panel de Administración</h1>

<div style="display:flex; flex-direction:column; gap:15px; margin-top:25px;">

    <a href="{{ route('admin.products') }}" 
        style="font-size:18px; text-decoration:none; color:#333;">
        📦 Lista de productos
    </a>

    <a href="{{ route('admin.informes') }}" 
        style="font-size:18px; text-decoration:none; color:#333;">
        📊 Informes
    </a>

    <a href="{{ route('home') }}" 
        style="font-size:18px; text-decoration:none; color:#333;">
        🏠 Ir a la tienda (Home)
    </a>

</div>

@endsection

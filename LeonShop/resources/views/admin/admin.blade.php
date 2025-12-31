@extends('layouts/layout')

@section('title', 'Panel de Administración')

@section('content')

<style>
    .admin-container {
        max-width: 600px;
        margin: 40px auto;
    }

    .admin-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .admin-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .admin-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-decoration: none;
        color: #333;
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 18px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .admin-card:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .admin-card.primary {
        background: #999AC6;
        color: white;
    }

    .admin-icon {
        font-size: 30px;
    }

    .admin-card p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #666;
    }

    .admin-card.primary p {
        color: #eee;
    }
</style>

<div class="admin-container">

    <h1 class="admin-title">Panel de Administración</h1>

    <div class="admin-grid">

        {{-- panel para ver los productos --}}
        <a href="{{ route('admin.products') }}" class="admin-card">
            <span class="admin-icon">📦</span>
            <div>
                <strong>
                    Gestión de productos
                </strong>
                <p>
                    Ver, crear, editar y eliminar productos
                </p>
            </div>
        </a>

        {{-- panel para ver los informes --}}
        <a href="{{ route('admin.informes') }}" class="admin-card">
            <span class="admin-icon">📊</span>
            <div>
                <strong>
                    Informes y estadísticas
                </strong>
                <p>
                    Ventas, productos y marcas más vendidas
                </p>
            </div>
        </a>

        {{-- panel para volver a la tienda --}}
        <a href="{{ route('home') }}" class="admin-card primary">
            <span class="admin-icon">🏠</span>
            <div>
                <strong>
                    Volver a la tienda
                </strong>
                <p>
                    Ir al catálogo de productos
                </p>
            </div>
        </a>

    </div>
</div>

@endsection

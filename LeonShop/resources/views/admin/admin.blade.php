@extends('layouts/layout')

@section('title', 'Panel de Administración')

@section('content')

<div style="max-width:600px; margin:40px auto;">

    <h1 style="text-align:center; margin-bottom:30px;">
        Panel de Administración
    </h1>

    <div style="
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    ">

        {{-- Productos --}}
        <a href="{{ route('admin.products') }}" style="
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
            text-decoration:none;
            color:#333;
            display:flex;
            align-items:center;
            gap:15px;
            font-size:18px;
            transition:transform 0.2s, box-shadow 0.2s;
        " onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 6px 15px rgba(0,0,0,0.15)'"
           onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)'">

            <span style="font-size:30px;">📦</span>
            <div>
                <strong>Gestión de productos</strong>
                <p style="margin:5px 0 0; font-size:14px; color:#666;">
                    Ver, crear, editar y eliminar productos
                </p>
            </div>
        </a>

        {{-- Informes --}}
        <a href="{{ route('admin.informes') }}" style="
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
            text-decoration:none;
            color:#333;
            display:flex;
            align-items:center;
            gap:15px;
            font-size:18px;
            transition:transform 0.2s, box-shadow 0.2s;
        " onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 6px 15px rgba(0,0,0,0.15)'"
           onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)'">

            <span style="font-size:30px;">📊</span>
            <div>
                <strong>Informes y estadísticas</strong>
                <p style="margin:5px 0 0; font-size:14px; color:#666;">
                    Ventas, productos y marcas más vendidas
                </p>
            </div>
        </a>

        {{-- Volver a la tienda --}}
        <a href="{{ route('home') }}" style="
            background:#999AC6;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
            text-decoration:none;
            color:white;
            display:flex;
            align-items:center;
            gap:15px;
            font-size:18px;
            transition:transform 0.2s, box-shadow 0.2s;
        " onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 6px 15px rgba(0,0,0,0.15)'"
           onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)'">

            <span style="font-size:30px;">🏠</span>
            <div>
                <strong>Volver a la tienda</strong>
                <p style="margin:5px 0 0; font-size:14px; color:#eee;">
                    Ir al catálogo de productos
                </p>
            </div>
        </a>

    </div>
</div>

@endsection

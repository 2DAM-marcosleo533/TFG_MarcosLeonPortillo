<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LeonShop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        background-color: #F9F9F9;
        font-family: Arial, sans-serif;
    }

    header {
        background-color: #999AC6;
        padding: 20px;
        color: white;
        font-size: 20px;
        font-weight: bold;
    }

    .content {
        padding: 20px;
        flex: 1; 
    }

    footer {
        background-color: #1C1C1C;
        color: white;
        padding: 20px;
        text-align: center;
    }
</style>

</head>
<body>

    {{-- CABECERA --}}
 <header style="background-color: #999AC6; padding: 20px; color: white; font-size: 20px; font-weight: bold; display:flex; justify-content:space-between; align-items:center;">
    
     <div>
    <a href="{{ auth()->check() && auth()->user()->is_admin ? route('admin') : route('home') }}"
       style="color:white; text-decoration:none; font-weight:bold;">
        LEONSHOP
    </a>
</div>

    <div style="display:flex; gap:15px;">

        @guest
            <a href="{{ route('register') }}" 
               style="color:white; text-decoration:none; font-weight:bold;">
               Registrarse
            </a>

            <a href="{{ route('login') }}" 
               style="color:white; text-decoration:none; font-weight:bold;">
               Iniciar sesión
            </a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button style="background:none; border:none; color:white; font-weight:bold; cursor:pointer;">
                    Cerrar sesión
                </button>
            </form>
        @endauth

    </div>

</header>



    {{-- CONTENIDO DE LA PÁGINA QUE SEA--}}
    <div class="content">
        @yield('content')
    </div>

    {{-- PIE DE PÁGINA --}}
    <footer>
        © {{ date('Y') }} LEONSHOP — Todos los derechos reservados
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

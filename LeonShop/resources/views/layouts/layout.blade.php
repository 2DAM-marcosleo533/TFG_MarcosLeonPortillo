<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LeonShop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;600&family=Oswald:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #F9F9F9;
        font-family: 'Inter', sans-serif; 
        font-size: 14px;
    }

    h1 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 40px;
        letter-spacing: 1px;
    }

    h2 {
        font-family: 'Oswald', sans-serif;
        font-size: 30px;
    }

    header {
        background-color: #999AC6;
        padding: 20px;
        color: white;
        font-size: 20px;
        font-weight: bold;
        font-family: 'Bebas Neue', sans-serif;
    }

    footer {
        background-color: #1C1C1C;
        color: white;
        padding: 20px;
        text-align: center;
        margin-top: 40px;
        font-family: 'Inter', sans-serif;
    }

   .content {
    padding: 20px;
    min-height: calc(100vh - 160px);
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
    <div style="display:flex; align-items:center; gap:15px;">

        <a href="{{ route('perfil.edit') }}"
           style="color:white; text-decoration:none; font-weight:bold;">
            Bienvenido, {{ auth()->user()->name }}!
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button style="background:none; border:none; color:white; font-weight:bold; cursor:pointer;">
                Cerrar sesión
            </button>
        </form>

    </div>
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

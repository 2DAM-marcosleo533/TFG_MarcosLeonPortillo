<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LeonShop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

.login-icon {
        width: 20px;
        height: 20px;
    }


</style>


</head>
<body>

    {{-- CABECERA --}}
 <header style="background-color: #F0EEE5; padding: 20px; color: black; font-size: 20px; font-weight: bold; display:flex; justify-content:space-between; align-items:center;">
    
     <div>
    <a href="{{ auth()->check() && auth()->user()->is_admin ? route('admin') : route('home') }}"
       style="color:black; text-decoration:none; font-weight:bold;">
        LEONSHOP
    </a>
</div>

    <div style="display:flex; gap:15px;">

        @guest
            <a href="{{ route('register') }}" 
               style="color:black; text-decoration:none; font-weight:bold;">
               Registrarse
            </a>

            <a href="{{ route('login') }}" 
               style="color:black; text-decoration:none; font-weight:bold;">
               Iniciar sesión
            </a>
        @endguest

       @auth
    <div style="display:flex; align-items:center; gap:15px;">

        <a href="{{ route('perfil.edit') }}"
           style="color:black; text-decoration:none; font-weight:bold;">
            <img class="login-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="icono login"> {{ auth()->user()->name }}
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button style="background:none; border:none; color:black; font-weight:bold; cursor:pointer;">
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

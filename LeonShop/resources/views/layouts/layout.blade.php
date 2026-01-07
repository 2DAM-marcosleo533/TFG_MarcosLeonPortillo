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
         display: flex;
    flex-direction: column;
    min-height: 100vh;
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

.header-link {
    color: black;
    text-decoration: none;
    font-weight: bold;
}


.header-enlaces {
    display: flex;
    gap: 15px;
    align-items: center;
}


.btn-logout {
    background: none;
    border: none;
    color: black;
    font-weight: bold;
    cursor: pointer;
    padding: 0;
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
    flex: 1;
}


.logo-icono {
        width: 20px;
        height: 20px;
    }


</style>


</head>
<body>

    {{-- parte de la cabecera de la pagina --}}
 <header style="
    background-color:#F0EEE5;
    padding:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
">

    <a href="{{ auth()->check() && auth()->user()->is_admin ? route('admin') : route('home') }}"
       class="header-link">
        LEONSHOP
    </a>

    <div class="header-enlaces">

        <a href="{{ route('carrito.index') }}" class="header-link">
            <i class="bi bi-cart-fill"></i>
        </a>

        @guest
            <a href="{{ route('register') }}" class="header-link">
                Registrarse
            </a>

            <a href="{{ route('login') }}" class="header-link">
                Iniciar sesión
            </a>
        @endguest

        @auth
            <a href="{{ route('perfil.edit') }}" class="header-link">
                <img class="logo-icono"
                     src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                     alt="icono login">
                {{ auth()->user()->name }}
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-logout">
                    Cerrar sesión
                </button>
            </form>
        @endauth

    </div>
</header>



    {{-- contenido de la pagina--}}
    <div class="content">
        @yield('content')
    </div>

    {{-- pie de pagina --}}
    <footer>
        © 2026 LEONSHOP — Todos los derechos reservados
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Fondo personalizado */
        body {
            background-image: url('{{ asset('assets/images/background2.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Sidebar */
        .sidebar {
            background: rgba(50, 50, 50, 0.85); /* Fondo más claro */
            transition: transform 0.3s ease-in-out;
            width: 16rem;
            position: fixed;
            height: 100%;
            z-index: 50;
            display: flex;
            flex-direction: column;
        }

        .hidden-menu {
            transform: translateX(-100%);
        }

        /* Texto con gradiente */
        .gradient-text {
            background: linear-gradient(to right, #f43f5e, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.75rem;
            font-weight: bold;
        }

        /* Botón estilizado */
        .btn-primary {
            background: linear-gradient(to right, #f43f5e, #3b82f6);
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
        }

        .btn-primary:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
        }

        /* Botón de ocultar menú fijo en la parte inferior */
        .btn-hide {
            background: linear-gradient(to right, #3b82f6, #f43f5e);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            width: 90%;
            text-align: center;
            margin: 1rem auto;
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
        }

        .btn-hide:hover {
            transform: translateX(-50%) scale(1.05);
        }

        /* Contenido principal ajustable */
        .content {
            transition: margin-left 0.3s ease, padding 0.3s ease;
            margin-left: 16rem;
            width: calc(100% - 16rem);
        }

        .content.expanded {
            margin-left: 0;
            width: 100%;
        }

        /* Ajustes de opciones del menú */
        .menu-section {
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        nav ul {
            margin: 0;
            padding: 0;
        }

        nav li {
            list-style: none;
        }
    </style>
</head>
<body class="min-h-screen flex">
    <!-- Botón para mostrar el menú en pantallas pequeñas -->
    <button id="showSidebar" class="fixed bottom-6 left-6 btn-primary shadow-lg z-50">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar text-white shadow-lg">
        <div class="p-4 text-center border-b border-gray-500">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-24 mx-auto mb-2">
            <h1 class="gradient-text">Sistema de Inventario</h1>
        </div>
        <nav class="menu-section px-4">
            <ul>
                <li class="relative">
                    <button class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700" onclick="toggleDropdown('dropdown1')">
                        <span class="flex items-center">
                            <i class="fas fa-flask mr-3"></i> Sustancias Químicas
                        </span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul id="dropdown1" class="space-y-2 mt-2 ml-6 hidden">
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Registrar Sustancias</a></li>
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Consultar Sustancias</a></li>
                    </ul>
                </li>
                <li class="relative">
                    <button class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700" onclick="toggleDropdown('dropdown2')">
                        <span class="flex items-center">
                            <i class="fas fa-sync-alt mr-3"></i> Actualización de Inventario
                        </span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul id="dropdown2" class="space-y-2 mt-2 ml-6 hidden">
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Añadir Stock</a></li>
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Eliminar Stock</a></li>
                    </ul>
                </li>
                <li class="relative">
                    <button class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700" onclick="toggleDropdown('dropdown3')">
                        <span class="flex items-center">
                            <i class="fas fa-boxes mr-3"></i> Lotes y Lotes
                        </span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul id="dropdown3" class="space-y-2 mt-2 ml-6 hidden">
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Registrar Lotes</a></li>
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Consultar Lotes</a></li>
                    </ul>
                </li>
                <li class="relative">
                    <button class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700" onclick="toggleDropdown('dropdown4')">
                        <span class="flex items-center">
                            <i class="fas fa-bell mr-3"></i> Notificaciones
                        </span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul id="dropdown4" class="space-y-2 mt-2 ml-6 hidden">
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Alertas Pendientes</a></li>
                        <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700">Historial de Alertas</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <button id="hideSidebar" class="btn-hide">
            <i class="fas fa-angle-left"></i> Ocultar Menú
        </button>
    </aside>

    <!-- Contenido Principal -->
    <main id="mainContent" class="content p-6">
        <header class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold gradient-text">Bienvenido, {{ auth()->user()->name }}</h2>
            <a href="{{ route('logout') }}" class="py-3 px-5 btn-primary rounded-lg font-medium flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
            </a>
        </header>
        <section class="bg-white bg-opacity-80 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Panel de Control</h3>
            <p>Selecciona una opción del menú para empezar.</p>
        </section>
    </main>

    <script>
        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const hideSidebar = document.getElementById('hideSidebar');
        const showSidebar = document.getElementById('showSidebar');

        hideSidebar.addEventListener('click', () => {
            sidebar.classList.add('hidden-menu');
            mainContent.classList.add('expanded');
            showSidebar.classList.remove('hidden');
        });

        showSidebar.addEventListener('click', () => {
            sidebar.classList.remove('hidden-menu');
            mainContent.classList.remove('expanded');
            showSidebar.classList.add('hidden');
        });
    </script>
</body>
</html> 
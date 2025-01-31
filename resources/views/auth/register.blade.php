<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Fondo ajustado para mantener proporción en cualquier pantalla */
        body {
            background-image: url('{{ asset('assets/images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Animación para el botón */
        .btn-animated {
            transition: all 0.3s ease;
        }

        .btn-animated:hover {
            background-color: #1d4ed8; /* Azul */
            color: #ffffff;
            transform: scale(1.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <!-- Contenedor Principal -->
    <div class="bg-white bg-opacity-95 shadow-lg rounded-lg p-8 w-full max-w-md">
        <!-- Título -->
        <h2 class="text-3xl font-semibold text-center text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-blue-500 mb-6 md:text-4xl">
            Registrar Usuario
        </h2>

        <!-- Formulario -->
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Campo de Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                <div class="mt-1 relative">
                    <input type="text" id="name" name="name" placeholder="Ingrese su nombre de usuario" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none transition duration-200">
                    <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Campo de Correo Electrónico -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <div class="mt-1 relative">
                    <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none transition duration-200">
                    <i class="fas fa-envelope absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Campo de Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <div class="mt-1 relative">
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none transition duration-200">
                    <i class="fas fa-lock absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Campo de Confirmación de Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <div class="mt-1 relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme su contraseña" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none transition duration-200">
                    <i class="fas fa-check absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Botón de Registrar -->
            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-red-500 text-white rounded-lg font-medium hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 btn-animated">
                    Registrar
                </button>
            </div>
        </form>

        <!-- Iniciar Sesión -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" class="text-blue-500 font-medium hover:underline">
                    Inicia sesión aquí
                </a>
            </p>
        </div>
    </div>
</body>
</html>

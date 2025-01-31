<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Fondo ajustado para cualquier pantalla */
        body {
            background-image: url('{{ asset('assets/images/background.png') }}');
            background-size: 100% auto; /* Se adapta horizontalmente */
            background-position: center top;
            background-repeat: repeat;
            background-attachment: fixed; /* Fijo al hacer scroll */
        }

        @media (max-width: 768px) {
            body {
                background-size: cover; /* En pantallas pequeñas, cubre toda el área */
            }
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
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-40">
        </div>

        <!-- Título -->
        <h2 class="text-3xl font-semibold text-center text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-blue-500 mb-4 md:text-4xl md:tracking-tight">
            Sistema de Inventario
        </h2>

        <!-- Formulario -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Campo de Usuario -->
            <div>
                <label for="login" class="block text-sm font-medium text-gray-700">Correo o Nombre de Usuario</label>
                <div class="mt-1 relative">
                    <input type="text" id="login" name="login" placeholder="Ingrese su usuario" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none transition duration-200">
                    <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Campo de Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <div class="mt-1 relative">
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none transition duration-200">
                    <i class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>

            <!-- Botón de Ingresar -->
            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-red-500 text-white rounded-lg font-medium hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 btn-animated">
                    Iniciar Sesión
                </button>
            </div>
        </form>

        <!-- Registro -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="text-blue-500 font-medium hover:underline">
                    Registrarse aquí
                </a>
            </p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const eyeIcon = passwordField.nextElementSibling;
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>

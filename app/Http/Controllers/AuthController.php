<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Muestra la vista de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Muestra la vista de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Registra un nuevo usuario
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255|unique:users', // Nombre de usuario debe ser único
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        // Crear el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // Encripta la contraseña
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Maneja el inicio de sesión
     */
    public function login(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'login' => 'required|string', // Puede ser nombre de usuario o email
            'password' => 'required|string|min:6',
        ]);

        // Buscar al usuario por email o por nombre de usuario
        $user = User::where('email', $request->login)
                    ->orWhere('name', $request->login)
                    ->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Credenciales incorrectas.']);
        }

        // Iniciar sesión con el usuario autenticado
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

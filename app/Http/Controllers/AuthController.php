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
            'name' => 'required|string|max:255|unique:users', // Nombre único
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        // Crear el usuario con contraseña encriptada
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // Hashear la contraseña
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        return redirect()->route('inicio')->with('success', 'Registro exitoso');
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

        // Definir si el usuario ingresó un email o un nombre de usuario
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Intentar autenticar con Auth::attempt()
        if (Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('inicio')->with('success', 'Inicio de sesión exitoso');
        }

        // Si la autenticación falla, retornar error
        return back()->withErrors(['login' => 'Credenciales incorrectas.'])->withInput();
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }
}

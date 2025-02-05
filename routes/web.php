<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\EnvaseController;
use App\Http\Controllers\FechaVencimientoController;
use App\Http\Controllers\MovimientoInventarioController;
use App\Http\Controllers\AlertaStockController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Redirigir la raíz de la aplicación a la página de login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de Autenticación
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Página de inicio
    Route::get('/inicio', function () {
        return view('pages.inicio');
    })->name('inicio');

    // Rutas de CRUD para cada módulo del sistema
    Route::resources([
        'familias' => FamiliaController::class,
        'categorias' => CategoriaController::class,
        'proveedores' => ProveedorController::class,
        'insumos' => InsumoController::class,
        'envases' => EnvaseController::class,
        'fechas-vencimiento' => FechaVencimientoController::class,
        'alertas-stock' => AlertaStockController::class,
        'documentos' => DocumentoController::class,
        'lotes' => LoteController::class,
    ]);

    // Rutas adicionales para inventario
    Route::prefix('inventario')->group(function () {
        Route::get('/entrada', [MovimientoInventarioController::class, 'entrada'])->name('inventario.entrada');
        Route::get('/salida', [MovimientoInventarioController::class, 'salida'])->name('inventario.salida');
        Route::post('/store', [MovimientoInventarioController::class, 'store'])->name('inventario.store');
        Route::get('/historial', [MovimientoInventarioController::class, 'historial'])->name('inventario.historial');
    });

    // Rutas para alertas
    Route::prefix('alertas')->group(function () {
        Route::get('/pendientes', [AlertaStockController::class, 'pendientes'])->name('alertas.pendientes');
        Route::get('/historial', [AlertaStockController::class, 'historial'])->name('alertas.historial');
    });

    // Rutas para reportes
    Route::prefix('reportes')->group(function () {
        Route::get('/stock', [ReporteController::class, 'stock'])->name('reportes.stock');
        Route::get('/movimientos', [ReporteController::class, 'movimientos'])->name('reportes.movimientos');
        Route::get('/consumo', [ReporteController::class, 'consumo'])->name('reportes.consumo');
    });

    // Rutas para usuarios
    Route::prefix('usuarios')->group(function () {
        Route::get('/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    });
});

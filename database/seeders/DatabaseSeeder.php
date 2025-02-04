<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Familia;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Insumo;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear un usuario administrador
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
        ]);

        // Crear algunas familias de insumos
        Familia::create(['nombre' => 'Metales']);
        Familia::create(['nombre' => 'Alcoholes']);
        Familia::create(['nombre' => 'Ácidos']);

        // Crear algunas categorías
        Categoria::create(['nombre' => 'Reactivos']);
        Categoria::create(['nombre' => 'Solventes']);

        // Crear un proveedor
        Proveedor::create([
            'nombre' => 'Químicos XYZ',
            'contacto' => 'Juan Pérez',
            'telefono' => '123456789',
            'email' => 'contacto@quimicosxyz.com',
            'direccion' => 'Av. Industrial 123, Lima'
        ]);
    }
}

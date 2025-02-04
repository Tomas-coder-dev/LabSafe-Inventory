<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['Usuario', 'Encargado', 'Admin'])->default('Usuario');
            $table->rememberToken(); // Agrega esta línea antes de $table->timestamps();
            $table->timestamps();
        });

        Schema::create('familias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps(); // Agrega esta línea
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });

        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('contacto')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->text('direccion')->nullable();
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });

        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_insumo')->unique();
            $table->foreignId('id_familia')->constrained('familias');
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->string('nombre');
            $table->string('formula_quimica')->nullable();
            $table->enum('estado_fisico', ['Sólido', 'Líquido', 'Gaseoso']);
            $table->enum('unidad_medida', ['Litros', 'Kilos']);
            $table->decimal('cantidad_total', 10,2);
            $table->decimal('capacidad_max', 10,2);
            $table->foreignId('id_proveedor')->nullable()->constrained('proveedores');
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });

        Schema::create('envases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_insumo')->constrained('insumos');
            $table->decimal('cantidad_envase', 10,2);
            $table->string('marca')->nullable();
            $table->string('ubicacion')->nullable();
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });

        Schema::create('fechas_vencimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_envase')->constrained('envases');
            $table->date('fecha_vencimiento');
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });

        Schema::create('movimientos_inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_insumo')->constrained('insumos');
            $table->foreignId('id_usuario')->constrained('users');
            $table->enum('tipo_movimiento', ['Entrada', 'Salida']);
            $table->decimal('cantidad', 10,2);
            $table->timestamp('fecha')->useCurrent();
            $table->text('motivo')->nullable();
            $table->string('numero_lote')->nullable();
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });

        Schema::create('alertas_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_insumo')->constrained('insumos');
            $table->text('mensaje');
            $table->timestamp('fecha')->useCurrent();
            $table->enum('estado', ['Pendiente', 'Atendida'])->default('Pendiente');
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });

        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_insumo')->constrained('insumos');
            $table->string('nombre_documento');
            $table->enum('tipo_documento', ['Ficha Técnica', 'Certificado de Seguridad', 'Manual de Manejo']);
            $table->text('url_documento');
            $table->timestamp('fecha_subida')->useCurrent();
            $table->timestamps(); // 🔹 Agregar esta línea para evitar el error
        });
    }

    public function down() {
        Schema::dropIfExists('documentos');
        Schema::dropIfExists('alertas_stock');
        Schema::dropIfExists('movimientos_inventario');
        Schema::dropIfExists('fechas_vencimiento');
        Schema::dropIfExists('envases');
        Schema::dropIfExists('insumos');
        Schema::dropIfExists('proveedores');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('familias');
        Schema::dropIfExists('users');
        
    }
};

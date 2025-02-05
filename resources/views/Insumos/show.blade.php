### **4. `resources/views/insumos/show.blade.php`**
```php
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Detalle del Insumo</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Información Básica</h3>
        <ul class="list-disc list-inside">
            <li><strong>Código:</strong> {{ $insumo->codigo_insumo }}</li>
            <li><strong>Nombre:</strong> {{ $insumo->nombre }}</li>
            <li><strong>Familia:</strong> {{ $insumo->familia->nombre ?? 'N/A' }}</li>
            <li><strong>Categoría:</strong> {{ $insumo->categoria->nombre ?? 'N/A' }}</li>
            <li><strong>Fórmula Química:</strong> {{ $insumo->formula_quimica ?? 'N/A' }}</li>
            <li><strong>Estado Físico:</strong> {{ $insumo->estado_fisico }}</li>
            <li><strong>Unidad de Medida:</strong> {{ $insumo->unidad_medida }}</li>
            <li><strong>Cantidad Total:</strong> {{ $insumo->cantidad_total }}</li>
            <li><strong>Capacidad Máxima:</strong> {{ $insumo->capacidad_max }}</li>
        </ul>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Proveedor</h3>
        <p>{{ $insumo->proveedor->nombre ?? 'No asignado' }}</p>
    </div>

    <div class="flex gap-4 mt-6">
        <a href="{{ route('insumos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Volver</a>
        <a href="{{ route('insumos.edit', $insumo) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Editar</a>
        <form action="{{ route('insumos.destroy', $insumo) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Eliminar</button>
        </form>
    </div>
</div>
@endsection

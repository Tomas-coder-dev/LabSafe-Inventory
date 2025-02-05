@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Editar Insumo</h2>

    <form action="{{ route('insumos.update', $insumo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="codigo_insumo" class="block text-sm font-medium text-gray-700">Código</label>
            <input type="text" name="codigo_insumo" id="codigo_insumo" class="w-full p-3 border rounded-lg" value="{{ $insumo->codigo_insumo }}" required>
        </div>

        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full p-3 border rounded-lg" value="{{ $insumo->nombre }}" required>
        </div>

        <div class="mb-4">
            <label for="id_familia" class="block text-sm font-medium text-gray-700">Familia</label>
            <select name="id_familia" id="id_familia" class="w-full p-3 border rounded-lg" required>
                @foreach($familias as $familia)
                    <option value="{{ $familia->id }}" {{ $insumo->id_familia == $familia->id ? 'selected' : '' }}>
                        {{ $familia->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
            <select name="id_categoria" id="id_categoria" class="w-full p-3 border rounded-lg" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $insumo->id_categoria == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="cantidad_total" class="block text-sm font-medium text-gray-700">Cantidad Total</label>
            <input type="number" name="cantidad_total" id="cantidad_total" class="w-full p-3 border rounded-lg" value="{{ $insumo->cantidad_total }}" required>
        </div>

        <button type="submit" class="btn-primary">Actualizar Insumo</button>
    </form>
</div>
@endsection
```

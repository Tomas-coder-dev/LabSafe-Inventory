@extends('layouts.app')

@section('title', 'Editar Insumo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center p-6">
  <div class="p-8 bg-white bg-opacity-90 rounded-xl shadow-2xl max-w-lg w-full transform transition duration-700 hover:scale-105">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-6 animate__animated animate__fadeInDown">
      Editar Insumo
    </h2>

    <!-- Mensaje de error -->
    @if ($errors->any())
      <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('insumos.update', $insumo->id) }}" method="POST" class="space-y-5 animate__animated animate__fadeInUp">
      @csrf
      @method('PUT')

      <!-- Código de Insumo -->
      <div>
        <label for="codigo_insumo" class="block text-lg font-medium text-gray-700">Código de Insumo</label>
        <input type="text" name="codigo_insumo" id="codigo_insumo" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" 
          value="{{ old('codigo_insumo', $insumo->codigo_insumo) }}" required>
      </div>

      <!-- Nombre -->
      <div>
        <label for="nombre" class="block text-lg font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" 
          value="{{ old('nombre', $insumo->nombre) }}" required>
      </div>

      <!-- Cantidad Total -->
      <div>
        <label for="cantidad_total" class="block text-lg font-medium text-gray-700">Cantidad Total</label>
        <input type="number" name="cantidad_total" id="cantidad_total" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" 
          value="{{ old('cantidad_total', $insumo->cantidad_total) }}" required>
      </div>

      <!-- Familia -->
      <div>
        <label for="id_familia" class="block text-lg font-medium text-gray-700">Familia</label>
        <select name="id_familia" id="id_familia" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
          @isset($familias)
            @foreach($familias as $familia)
              <option value="{{ $familia->id }}" {{ (old('id_familia', $insumo->id_familia) == $familia->id) ? 'selected' : '' }}>
                {{ $familia->nombre }}
              </option>
            @endforeach
          @endisset
        </select>
      </div>

      <!-- Categoría -->
      <div>
        <label for="id_categoria" class="block text-lg font-medium text-gray-700">Categoría</label>
        <select name="id_categoria" id="id_categoria" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
          @isset($categorias)
            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id }}" {{ (old('id_categoria', $insumo->id_categoria) == $categoria->id) ? 'selected' : '' }}>
                {{ $categoria->nombre }}
              </option>
            @endforeach
          @endisset
        </select>
      </div>

      <!-- Fórmula Química (Opcional) -->
      <div>
        <label for="formula_quimica" class="block text-lg font-medium text-gray-700">Fórmula Química</label>
        <input type="text" name="formula_quimica" id="formula_quimica" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" 
          value="{{ old('formula_quimica', $insumo->formula_quimica) }}">
      </div>

      <!-- Estado Físico -->
      <div>
        <label for="estado_fisico" class="block text-lg font-medium text-gray-700">Estado Físico</label>
        <select name="estado_fisico" id="estado_fisico" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
          <option value="Sólido" {{ old('estado_fisico', $insumo->estado_fisico) == 'Sólido' ? 'selected' : '' }}>Sólido</option>
          <option value="Líquido" {{ old('estado_fisico', $insumo->estado_fisico) == 'Líquido' ? 'selected' : '' }}>Líquido</option>
          <option value="Gaseoso" {{ old('estado_fisico', $insumo->estado_fisico) == 'Gaseoso' ? 'selected' : '' }}>Gaseoso</option>
        </select>
      </div>

      <!-- Unidad de Medida -->
      <div>
        <label for="unidad_medida" class="block text-lg font-medium text-gray-700">Unidad de Medida</label>
        <select name="unidad_medida" id="unidad_medida" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
          <option value="Litros" {{ old('unidad_medida', $insumo->unidad_medida) == 'Litros' ? 'selected' : '' }}>Litros</option>
          <option value="Kilos" {{ old('unidad_medida', $insumo->unidad_medida) == 'Kilos' ? 'selected' : '' }}>Kilos</option>
          <option value="Miligramos" {{ old('unidad_medida', $insumo->unidad_medida) == 'Miligramos' ? 'selected' : '' }}>Miligramos</option>
        </select>
      </div>

      <!-- Proveedor -->
      <div>
        <label for="id_proveedor" class="block text-lg font-medium text-gray-700">Proveedor</label>
        <select name="id_proveedor" id="id_proveedor" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
          @isset($proveedores)
            @foreach($proveedores as $proveedor)
              <option value="{{ $proveedor->id }}" {{ (old('id_proveedor', $insumo->id_proveedor) == $proveedor->id) ? 'selected' : '' }}>
                {{ $proveedor->nombre }}
              </option>
            @endforeach
          @endisset
        </select>
      </div>

      <!-- Botón -->
      <button type="submit" class="btn-primary w-full">
        Guardar Cambios
      </button>
    </form>
  </div>
</div>
@endsection

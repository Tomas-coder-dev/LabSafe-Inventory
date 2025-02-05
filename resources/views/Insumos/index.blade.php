@extends('layouts.app')

@section('title', 'Listado de Insumos')

@section('content')
<!-- Estilos Personalizados -->
<style>
  .btn-custom {
    background: linear-gradient(to right, #4f46e5, #9333ea);
    color: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .btn-custom:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
  }
  .btn-danger {
    background: linear-gradient(to right, #ef4444, #dc2626);
  }
  .btn-danger:hover {
    background: linear-gradient(to right, #dc2626, #b91c1c);
  }
  .btn-edit {
    background: linear-gradient(to right, #3b82f6, #2563eb);
  }
  .btn-edit:hover {
    background: linear-gradient(to right, #2563eb, #1d4ed8);
  }
</style>

<!-- Contenedor Principal con Fondo Transparente -->
<div class="min-h-screen flex items-center justify-center p-6" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
  <div class="p-8 bg-white bg-opacity-80 rounded-xl shadow-2xl max-w-7xl w-full transform transition duration-700 hover:scale-105">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-6 animate__animated animate__fadeInDown">
      📋 Listado de Insumos
    </h2>

    <!-- 🔍 Búsqueda Avanzada -->
    <form method="GET" action="{{ route('insumos.index') }}" class="mb-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <input type="text" name="buscar" placeholder="🔎 Código o Nombre" class="p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
      
      <select name="categoria" class="p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
        <option value="">📂 Categoría</option>
        @foreach($categorias as $categoria)
          <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
        @endforeach
      </select>

      <select name="familia" class="p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
        <option value="">🏷️ Familia</option>
        @foreach($familias as $familia)
          <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
        @endforeach
      </select>

      <select name="estado" class="p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
        <option value="">⚗️ Estado Físico</option>
        <option value="Sólido">Sólido</option>
        <option value="Líquido">Líquido</option>
        <option value="Gaseoso">Gaseoso</option>
      </select>

      <select name="unidad_medida" class="p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
        <option value="">⚖ Unidad de Medida</option>
        <option value="Litros">Litros</option>
        <option value="Kilos">Kilos</option>
        <option value="Miligramos">Miligramos</option>
      </select>

      <select name="proveedor" class="p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
        <option value="">🏭 Proveedor</option>
        @foreach($proveedores as $proveedor)
          <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
        @endforeach
      </select>

      <button type="submit" class="btn-custom w-full">🔎 Buscar</button>
    </form>

    <!-- 📊 Tabla de Insumos -->
    <table class="w-full bg-gray-100 shadow-lg rounded-lg">
      <thead class="bg-gray-700 text-white">
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Código</th>
          <th class="px-4 py-2">Nombre</th>
          <th class="px-4 py-2">Categoría</th>
          <th class="px-4 py-2">Familia</th>
          <th class="px-4 py-2">Estado</th>
          <th class="px-4 py-2">Unidad</th>
          <th class="px-4 py-2">Proveedor</th>
          <th class="px-4 py-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($insumos as $insumo)
          <tr class="text-center hover:bg-gray-200 transition">
            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border px-4 py-2">{{ $insumo->codigo_insumo }}</td>
            <td class="border px-4 py-2">{{ $insumo->nombre }}</td>
            <td class="border px-4 py-2">{{ $insumo->categoria->nombre ?? 'N/A' }}</td>
            <td class="border px-4 py-2">{{ $insumo->familia->nombre ?? 'N/A' }}</td>
            <td class="border px-4 py-2">{{ $insumo->estado_fisico }}</td>
            <td class="border px-4 py-2">{{ $insumo->unidad_medida }}</td>
            <td class="border px-4 py-2">{{ $insumo->proveedor->nombre ?? 'N/A' }}</td>
            <td class="border px-4 py-2 flex gap-2 justify-center">
              <a href="{{ route('insumos.edit', $insumo) }}" class="btn-custom btn-edit">
                ✏ Editar
              </a>
              <form action="{{ route('insumos.destroy', $insumo) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-custom btn-danger">
                  🗑 Eliminar
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-4 text-center">
      <a href="{{ route('insumos.create') }}" class="btn-custom">➕ Registrar Nuevo Insumo</a>
    </div>
  </div>
</div>
@endsection

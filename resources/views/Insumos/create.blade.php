@extends('layouts.app')

@section('title', 'Registrar Sustancia')

@section('content')
<!-- Estilos para el botón -->
<style>
  .btn-primary {
    background: linear-gradient(to right, #f43f5e, #3b82f6);
    color: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 12px 24px;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: bold;
  }
  .btn-primary:hover {
    transform: scale(1.1);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
  }
</style>

<!-- Incluimos Animate.css para las animaciones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- Contenedor con fondo transparente -->
<div class="min-h-screen bg-transparent flex items-center justify-center p-6">
    <!-- Contenedor del formulario completamente transparente -->
    <div class="p-8 rounded-xl shadow-2xl max-w-lg w-full bg-transparent transform transition duration-700 hover:scale-105">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6 animate__animated animate__fadeInDown">
            Registrar Nueva Sustancia
        </h2>
        
        <form id="formInsumo" class="space-y-5 animate__animated animate__fadeInUp" action="{{ route('insumos.store') }}" method="POST">
            @csrf

            <!-- Campo: Código de Insumo -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="codigo_insumo" class="block text-lg font-medium text-gray-700">Código de Insumo</label>
                <input type="text" id="codigo_insumo" name="codigo_insumo" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Campo: Nombre -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="nombre" class="block text-lg font-medium text-gray-700">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Campo: Cantidad Total -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="cantidad_total" class="block text-lg font-medium text-gray-700">Cantidad Total</label>
                <input type="number" id="cantidad_total" name="cantidad_total" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Campo: Familia -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="id_familia" class="block text-lg font-medium text-gray-700">Familia</label>
                <select name="id_familia" id="id_familia" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Seleccione una familia</option>
                    @foreach ($familias as $familia)
                        <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campo: Categoría -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="id_categoria" class="block text-lg font-medium text-gray-700">Categoría</label>
                <select name="id_categoria" id="id_categoria" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campo: Fórmula Química (opcional) -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="formula_quimica" class="block text-lg font-medium text-gray-700">Fórmula Química</label>
                <input type="text" id="formula_quimica" name="formula_quimica" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Campo: Estado Físico (Opciones: Sólido, Líquido, Gaseoso) -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="estado_fisico" class="block text-lg font-medium text-gray-700">Estado Físico</label>
                <select name="estado_fisico" id="estado_fisico" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Seleccione un estado</option>
                    <option value="solido">Sólido</option>
                    <option value="liquido">Líquido</option>
                    <option value="gaseoso">Gaseoso</option>
                </select>
            </div>

            <!-- Campo: Unidad de Medida (Opciones: Litros, Kilos) -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="unidad_medida" class="block text-lg font-medium text-gray-700">Unidad de Medida</label>
                <select name="unidad_medida" id="unidad_medida" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Seleccione una unidad</option>
                    <option value="Litros">Litros</option>
                    <option value="Kilos">Kilos</option>
                </select>
            </div>

            <!-- Campo: Capacidad Máxima -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="capacidad_max" class="block text-lg font-medium text-gray-700">Capacidad Máxima</label>
                <input type="number" id="capacidad_max" name="capacidad_max" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Campo: Proveedor -->
            <div class="transition-all duration-300 transform hover:-translate-y-1">
                <label for="id_proveedor" class="block text-lg font-medium text-gray-700">Proveedor</label>
                <select name="id_proveedor" id="id_proveedor" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn-primary w-full">
                Registrar Sustancia
            </button>
        </form>

        <!-- Mensajes de éxito y error -->
        <p id="message" class="text-green-600 mt-4 text-center hidden">Sustancia registrada correctamente</p>
        <p id="error-message" class="text-red-600 mt-4 text-center hidden"></p>
    </div>
</div>

<script>
  document.getElementById('formInsumo').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const errorMessageElem = document.getElementById('error-message');
    // Limpiar mensaje de error previo
    errorMessageElem.classList.add('hidden');
    errorMessageElem.textContent = '';

    fetch("{{ route('insumos.store') }}", {
      method: "POST",
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    .then(response => {
      // Verificamos el encabezado Content-Type
      const contentType = response.headers.get("content-type");
      if (contentType && contentType.indexOf("application/json") !== -1) {
        return response.json();
      } else {
        // Si no es JSON, asumimos que la operación fue exitosa
        return { success: true };
      }
    })
    .then(data => {
      if (data.success) {
        document.getElementById('message').classList.remove('hidden');
        document.getElementById('formInsumo').reset();
      } else {
        throw new Error('Error al registrar insumo.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      errorMessageElem.textContent = error.message;
      errorMessageElem.classList.remove('hidden');
    });
  });
</script>

@endsection

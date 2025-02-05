@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Listado de Insumos</h2>

    <!-- Mensajes de Éxito -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full bg-gray-100 shadow-lg rounded-lg">
        <thead class="bg-gray-700 text-white">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Código</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Categoría</th>
                <th class="px-4 py-2">Cantidad</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($insumos as $insumo)
                <tr class="text-center">
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $insumo->codigo_insumo }}</td>
                    <td class="border px-4 py-2">{{ $insumo->nombre }}</td>
                    <td class="border px-4 py-2">{{ $insumo->categoria->nombre ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $insumo->cantidad_total }}</td>
                    <td class="border px-4 py-2 flex justify-center gap-2">
                        <a href="{{ route('insumos.edit', $insumo) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Editar</a>
                        <form action="{{ route('insumos.destroy', $insumo) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border px-4 py-2 text-center">No hay insumos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('insumos.create') }}" class="btn-primary">Registrar Nuevo Insumo</a>
    </div>
</div>
@endsection

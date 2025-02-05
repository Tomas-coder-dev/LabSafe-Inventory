@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Añadir Stock</h1>
    <form action="{{ route('inventario.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tipo_movimiento" value="entrada">
        <div class="mb-4">
            <label for="id_insumo" class="block text-sm font-medium">Insumo</label>
            <select name="id_insumo" id="id_insumo" class="form-select w-full" required>
                <option value="">Seleccione un insumo</option>
                @foreach($insumos as $insumo)
                    <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="cantidad" class="block text-sm font-medium">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-input w-full" required>
        </div>
        <div class="mb-4">
            <label for="motivo" class="block text-sm font-medium">Motivo</label>
            <textarea name="motivo" id="motivo" class="form-textarea w-full"></textarea>
        </div>
        <button type="submit" class="btn-primary">Registrar Entrada</button>
    </form>
</div>
@endsection

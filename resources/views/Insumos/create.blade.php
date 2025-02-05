@extends('layouts.app')

@section('title', 'Registrar Sustancia')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Registrar Nueva Sustancia</h2>

    <form id="formInsumo" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Código de Insumo</label>
            <input type="text" id="codigo_insumo" name="codigo_insumo" class="w-full p-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="w-full p-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Cantidad Total</label>
            <input type="number" id="cantidad_total" name="cantidad_total" class="w-full p-2 border rounded-lg" required>
        </div>

        <button type="submit" class="btn-primary w-full">Registrar Sustancia</button>
    </form>

    <p id="message" class="text-green-500 mt-4 hidden">Sustancia registrada correctamente</p>
</div>

<script>
    document.getElementById('formInsumo').addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = new FormData(this);

        fetch("{{ route('insumos.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('message').classList.remove('hidden');
            this.reset();
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection

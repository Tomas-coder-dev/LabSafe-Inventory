<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Familia;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /**
     * Mostrar un listado de insumos.
     */
    public function index()
    {
        $insumos = Insumo::with(['familia', 'categoria', 'proveedor'])->get();

        return view('insumos.index', compact('insumos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo insumo.
     */
    public function create()
    {
        $familias = Familia::all();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('insumos.create', compact('familias', 'categorias', 'proveedores'));
    }

    /**
     * Almacenar un insumo recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'codigo_insumo' => 'required|unique:insumos,codigo_insumo|max:50',
            'id_familia' => 'required|exists:familias,id',
            'id_categoria' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'formula_quimica' => 'nullable|string|max:255',
            'estado_fisico' => 'required|string|max:50',
            'unidad_medida' => 'required|string|max:50',
            'cantidad_total' => 'required|integer|min:0',
            'capacidad_max' => 'required|integer|min:0',
            'id_proveedor' => 'required|exists:proveedores,id',
        ]);

        // Crear un nuevo insumo
        Insumo::create($validated);

        return redirect()->route('insumos.index')->with('success', 'Insumo registrado exitosamente.');
    }

    /**
     * Mostrar los detalles de un insumo específico.
     */
    public function show(Insumo $insumo)
    {
        return view('insumos.show', compact('insumo'));
    }

    /**
     * Mostrar el formulario para editar un insumo existente.
     */
    public function edit(Insumo $insumo)
    {
        $familias = Familia::all();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('insumos.edit', compact('insumo', 'familias', 'categorias', 'proveedores'));
    }

    /**
     * Actualizar un insumo específico en la base de datos.
     */
    public function update(Request $request, Insumo $insumo)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'codigo_insumo' => 'required|max:50|unique:insumos,codigo_insumo,' . $insumo->id,
            'id_familia' => 'required|exists:familias,id',
            'id_categoria' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'formula_quimica' => 'nullable|string|max:255',
            'estado_fisico' => 'required|string|max:50',
            'unidad_medida' => 'required|string|max:50',
            'cantidad_total' => 'required|integer|min:0',
            'capacidad_max' => 'required|integer|min:0',
            'id_proveedor' => 'required|exists:proveedores,id',
        ]);

        // Actualizar el insumo
        $insumo->update($validated);

        return redirect()->route('insumos.index')->with('success', 'Insumo actualizado exitosamente.');
    }

    /**
     * Eliminar un insumo específico de la base de datos.
     */
    public function destroy(Insumo $insumo)
    {
        $insumo->delete();

        return redirect()->route('insumos.index')->with('success', 'Insumo eliminado exitosamente.');
    }
}

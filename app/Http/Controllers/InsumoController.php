<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Familia;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InsumoController extends Controller
{
    /**
     * Mostrar un listado de insumos con filtros avanzados.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        $familias = Familia::all();
        $proveedores = Proveedor::all();

        $insumos = Insumo::query()
            ->with(['familia', 'categoria', 'proveedor']) // Cargar relaciones
            ->when($request->buscar, function ($query) use ($request) {
                return $query->where('codigo_insumo', 'like', "%{$request->buscar}%")
                    ->orWhere('nombre', 'like', "%{$request->buscar}%");
            })
            ->when($request->categoria, function ($query) use ($request) {
                return $query->where('id_categoria', $request->categoria);
            })
            ->when($request->familia, function ($query) use ($request) {
                return $query->where('id_familia', $request->familia);
            })
            ->when($request->estado, function ($query) use ($request) {
                return $query->where('estado_fisico', 'like', "%{$request->estado}%");
            })
            ->when($request->unidad_medida, function ($query) use ($request) {
                return $query->where('unidad_medida', 'like', "%{$request->unidad_medida}%");
            })
            ->when($request->proveedor, function ($query) use ($request) {
                return $query->where('id_proveedor', $request->proveedor);
            })
            ->orderBy('nombre')
            ->paginate(10); // Paginación de 10 elementos por página

        return view('insumos.index', compact('insumos', 'categorias', 'familias', 'proveedores'));
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
     * Almacenar un insumo en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'codigo_insumo'   => 'required|unique:insumos,codigo_insumo|max:50',
            'id_familia'      => 'required|exists:familias,id',
            'id_categoria'    => 'required|exists:categorias,id',
            'nombre'          => 'required|string|max:255',
            'formula_quimica' => 'nullable|string|max:255',
            'estado_fisico'   => 'required|string|max:50',
            'unidad_medida'   => 'required|string|max:50',
            'cantidad_total'  => 'required|integer|min:0',
            'capacidad_max'   => 'required|integer|min:0',
            'id_proveedor'    => 'required|exists:proveedores,id',
        ]);

        // Crear insumo
        Insumo::create($validated);

        return redirect()->route('insumos.index')->with('success', 'Insumo registrado exitosamente.');
    }

    /**
     * Mostrar los detalles de un insumo.
     */
    public function show(Insumo $insumo)
    {
        return view('insumos.show', compact('insumo'));
    }

    /**
     * Mostrar el formulario para editar un insumo.
     */
    public function edit(Insumo $insumo)
    {
        $familias = Familia::all();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('insumos.edit', compact('insumo', 'familias', 'categorias', 'proveedores'));
    }

    /**
     * Actualizar un insumo en la base de datos.
     */
    public function update(Request $request, Insumo $insumo)
    {
        try {
            
            // Validar datos
            $validated = $request->validate([
                'codigo_insumo'   => 'required|max:50|unique:insumos,codigo_insumo,' . $insumo->id,
                'id_familia'      => 'required|exists:familias,id',
                'id_categoria'    => 'required|exists:categorias,id',
                'nombre'          => 'required|string|max:255',
                'formula_quimica' => 'nullable|string|max:255',
                'estado_fisico'   => 'required|string|max:50',
                'unidad_medida'   => 'required|string|max:50',
                'cantidad_total'  => 'required|integer|min:0',
                'capacidad_max'   => 'required|integer|min:0',
                'id_proveedor'    => 'required|exists:proveedores,id',
            ]);

            // Actualizar insumo
            $insumo->update($validated);

            return redirect()->route('insumos.index')->with('success', 'Insumo actualizado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar insumo: ' . $e->getMessage());
            return redirect()->route('insumos.edit', $insumo)->with('error', 'Error al actualizar el insumo.');
        }
    }

    /**
     * Eliminar un insumo de la base de datos.
     */
    public function destroy(Insumo $insumo)
    {
        try {
            $insumo->delete();
            return redirect()->route('insumos.index')->with('success', 'Insumo eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar insumo: ' . $e->getMessage());
            return redirect()->route('insumos.index')->with('error', 'Error al eliminar el insumo.');
        }
    }
}

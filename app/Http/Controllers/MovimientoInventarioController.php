<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\MovimientoInventario;
use Illuminate\Http\Request;

class MovimientoInventarioController extends Controller
{
    public function entrada()
    {
        $insumos = Insumo::all();
        return view('pages.inventario.entrada', compact('insumos'));
    }

    public function salida()
    {
        $insumos = Insumo::all();
        return view('pages.inventario.salida', compact('insumos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_insumo' => 'required|exists:insumos,id',
            'cantidad' => 'required|numeric|min:1',
            'tipo_movimiento' => 'required|in:entrada,salida',
            'motivo' => 'nullable|string',
        ]);

        $insumo = Insumo::findOrFail($request->id_insumo);

        if ($request->tipo_movimiento === 'salida' && $insumo->cantidad_total < $request->cantidad) {
            return redirect()->back()->with('error', 'No hay suficiente stock para realizar la salida.');
        }

        // Crear el movimiento
        MovimientoInventario::create([
            'id_insumo' => $request->id_insumo,
            'id_usuario' => auth()->id(),
            'tipo_movimiento' => $request->tipo_movimiento,
            'cantidad' => $request->cantidad,
            'fecha' => now(),
            'motivo' => $request->motivo,
        ]);

        // Actualizar el stock
        $insumo->cantidad_total += $request->tipo_movimiento === 'entrada' ? $request->cantidad : -$request->cantidad;
        $insumo->save();

        return redirect()->route('inventario.historial')->with('success', 'Movimiento registrado con éxito.');
    }
}


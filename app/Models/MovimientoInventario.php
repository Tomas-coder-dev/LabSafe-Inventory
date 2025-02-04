<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_insumo',
        'id_usuario',
        'tipo_movimiento',
        'cantidad',
        'fecha',
        'motivo',
        'numero_lote',
    ];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'id_insumo');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}

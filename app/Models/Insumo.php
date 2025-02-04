<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_insumo',
        'id_familia',
        'id_categoria',
        'nombre',
        'formula_quimica',
        'estado_fisico',
        'unidad_medida',
        'cantidad_total',
        'capacidad_max',
        'id_proveedor',
    ];

    public function familia()
    {
        return $this->belongsTo(Familia::class, 'id_familia');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function envases()
    {
        return $this->hasMany(Envase::class, 'id_insumo');
    }
}

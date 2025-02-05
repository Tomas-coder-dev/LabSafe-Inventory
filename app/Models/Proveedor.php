<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Especificar el nombre correcto de la tabla
    protected $table = 'proveedores';

    // Campos que pueden ser rellenados en la tabla
    protected $fillable = ['nombre', 'contacto', 'telefono', 'email', 'direccion'];

    // Relación con insumos
    public function insumos()
    {
        return $this->hasMany(Insumo::class, 'id_proveedor');
    }
}

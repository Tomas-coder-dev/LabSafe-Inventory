<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'contacto', 'telefono', 'email', 'direccion'];

    public function insumos()
    {
        return $this->hasMany(Insumo::class, 'id_proveedor');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envase extends Model
{
    use HasFactory;

    protected $fillable = ['id_insumo', 'cantidad_envase', 'marca', 'ubicacion'];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'id_insumo');
    }

    public function fechas_vencimiento()
    {
        return $this->hasMany(FechaVencimiento::class, 'id_envase');
    }
}

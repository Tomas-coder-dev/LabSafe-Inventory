<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_insumo',
        'nombre_documento',
        'tipo_documento',
        'url_documento',
        'fecha_subida'
    ];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'id_insumo');
    }
}

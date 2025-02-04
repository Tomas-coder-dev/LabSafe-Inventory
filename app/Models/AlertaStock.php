<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaStock extends Model
{
    use HasFactory;

    protected $fillable = ['id_insumo', 'mensaje', 'fecha', 'estado'];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'id_insumo');
    }
}

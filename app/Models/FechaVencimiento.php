<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechaVencimiento extends Model
{
    use HasFactory;

    protected $fillable = ['id_envase', 'fecha_vencimiento'];

    public function envase()
    {
        return $this->belongsTo(Envase::class, 'id_envase');
    }
}

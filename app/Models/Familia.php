<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function insumos()
    {
        return $this->hasMany(Insumo::class, 'id_familia');
    }
}

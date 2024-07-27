<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
use App\Models\Marca;
use App\Models\Mueble;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'marca_id'];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Relación indirecta a través de la marca
    public function empresa()
    {
        return $this->hasOneThrough(Empresa::class, Marca::class, 'id', 'id', 'marca_id', 'empresa_id');
    }

    // Relación uno a muchos con Mueble
    public function muebles()
    {
        return $this->hasMany(Mueble::class);
    }
}

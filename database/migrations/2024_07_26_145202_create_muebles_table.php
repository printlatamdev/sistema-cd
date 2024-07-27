<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mueble extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_mueble',
        'cantidad_muebles',
        'medidas',
        'maquina',
        'tipo_impresion',
        'proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
    
}
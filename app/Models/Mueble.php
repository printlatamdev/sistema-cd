<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mueble extends Model
{
    protected $fillable = [
        'tipo_mueble',
        'cantidad_muebles',
        'base',
        'altura',
        'fondo',
        'maquina',
        'tipo_impresion',
        'acabado',
        'Nota',
        'Pais',
        'proyecto_id',  // Asegúrate de que este campo esté aquí
        'image'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }
}

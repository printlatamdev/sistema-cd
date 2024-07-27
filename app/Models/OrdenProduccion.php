<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenProduccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id', 
        'estado',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function muebles()
    {
        return $this->hasMany(Mueble::class);
    }
}

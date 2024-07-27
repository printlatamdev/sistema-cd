<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = ['proyecto_id', 'mueble_id', 'material_id', 'cantidad', 'material_adicional'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function mueble()
    {
        return $this->belongsTo(Mueble::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}

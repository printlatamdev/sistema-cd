<?php
namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\OrdenProduccion;
use Illuminate\Http\Request;

class OrdenProduccionController extends Controller
{
    public function index(Proyecto $proyecto)
    {
        $ordenesProduccion = $proyecto->ordenesProduccion()->with('muebles')->get();
        return view('ordenesProduccion.index', compact('proyecto', 'ordenesProduccion'));
    }
    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
        ]);

        $orden = new OrdenProduccion($request->all());
        $orden->proyecto()->associate($proyecto);
        $orden->save();

        return redirect()->route('ordenesProduccion.index', $proyecto->id)
                         ->with('success', 'Orden de producción creada exitosamente.');
    }

    public function update(Request $request, OrdenProduccion $ordenProduccion)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
        ]);

        $ordenProduccion->update($request->all());

        return redirect()->route('ordenesProduccion.index', $ordenProduccion->proyecto_id)
                         ->with('success', 'Orden de producción actualizada exitosamente.');
    }

    public function destroy(OrdenProduccion $ordenProduccion)
    {
        $ordenProduccion->delete();

        return redirect()->route('ordenesProduccion.index', $ordenProduccion->proyecto_id)
                         ->with('success', 'Orden de producción eliminada exitosamente.');
    }
}

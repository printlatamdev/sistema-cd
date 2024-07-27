<?php

namespace App\Http\Controllers;

use App\Models\Mueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MuebleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tipo_mueble' => 'required|string|max:255',
            'cantidad_muebles' => 'required|integer',
            'base' => 'required|numeric',
            'altura' => 'required|numeric',
            'fondo' => 'required|numeric',
            'maquina' => 'required|string|max:255',
            'tipo_impresion' => 'required|string|max:255',
            'acabado' => 'nullable|string|max:255',
            'Nota' => 'nullable|string',
            'Pais' => 'nullable|string|max:255',
            'proyecto_id' => 'required|exists:proyectos,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mueble = new Mueble($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('muebles', 'public');
            $mueble->image = $imagePath;
        }

        $mueble->save();

        return redirect()->route('proyectos.show', $request->proyecto_id)
                         ->with('success', 'Mueble creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $mueble = Mueble::findOrFail($id);
    
        $request->validate([
            'tipo_mueble' => 'required|string|max:255',
            'cantidad_muebles' => 'required|integer',
            'base' => 'required|numeric',
            'altura' => 'required|numeric',
            'fondo' => 'required|numeric',
            'maquina' => 'required|string|max:255',
            'tipo_impresion' => 'required|string|max:255',
            'acabado' => 'nullable|string|max:255',
            'Nota' => 'nullable|string',
            'Pais' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $mueble->tipo_mueble = $request->input('tipo_mueble');
        $mueble->cantidad_muebles = $request->input('cantidad_muebles');
        $mueble->base = $request->input('base');
        $mueble->altura = $request->input('altura');
        $mueble->fondo = $request->input('fondo');
        $mueble->maquina = $request->input('maquina');
        $mueble->tipo_impresion = $request->input('tipo_impresion');
        $mueble->acabado = $request->input('acabado');
        $mueble->Nota = $request->input('Nota');
        $mueble->Pais = $request->input('Pais');
    
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($mueble->image) {
                Storage::delete('public/' . $mueble->image);
            }
            
            // Guardar nueva imagen
            $imagePath = $request->file('image')->store('muebles', 'public');
            $mueble->image = $imagePath;
        }
    
        $mueble->save();
    
        return redirect()->route('proyectos.show', $mueble->proyecto_id)
                         ->with('success', 'Mueble actualizado con éxito.');
    }
    
    public function destroy($id)
    {
        $mueble = Mueble::findOrFail($id);
        // Eliminar imagen si existe
        if ($mueble->image) {
            Storage::delete('public/' . $mueble->image);
        }
        $mueble->delete();

        return redirect()->route('proyectos.show', $mueble->proyecto_id)
                         ->with('success', 'Mueble eliminado con éxito.');
    }
}

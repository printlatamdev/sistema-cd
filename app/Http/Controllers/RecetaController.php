<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Proyecto;
use App\Models\Mueble;
use App\Models\Material;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function index()
    {
        $recetas = Receta::all();
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        $proyectos = Proyecto::all();
        $muebles = Mueble::all();
        $materiales = Material::all();
        return view('recetas.create', compact('proyectos', 'muebles', 'materiales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required',
            'mueble_id' => 'required',
            'material_id' => 'required',
            'cantidad' => 'required|integer',
            'material_adicional' => 'boolean',
        ]);

        Receta::create($request->all());

        return redirect()->route('recetas.index')->with('success', 'Receta creada correctamente');
    }

    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }

    public function edit(Receta $receta)
    {
        $proyectos = Proyecto::all();
        $muebles = Mueble::all();
        $materiales = Material::all();
        return view('recetas.edit', compact('receta', 'proyectos', 'muebles', 'materiales'));
    }

    public function update(Request $request, Receta $receta)
    {
        $request->validate([
            'proyecto_id' => 'required',
            'mueble_id' => 'required',
            'material_id' => 'required',
            'cantidad' => 'required|integer',
            'material_adicional' => 'boolean',
        ]);

        $receta->update($request->all());

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada correctamente');
    }

    public function destroy(Receta $receta)
    {
        $receta->delete();
        return redirect()->route('recetas.index')->with('success', 'Receta eliminada correctamente');
    }
}

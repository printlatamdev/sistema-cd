<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Marca;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with('marca.empresa')->get(); // Cargar marca y empresa asociada
        $marcas = Marca::all();
        $empresas = Empresa::all();
        return view('empresas.index', compact('proyectos', 'marcas', 'empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Empresa::create($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa creada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();

        return redirect()->route('empresas.index')->with('success', 'Empresa borrada exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Empresa;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::with('empresa')->get();
        $empresas = Empresa::all();
        return view('marcas.index', compact('marcas', 'empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $marca = Marca::create($request->all());

        return redirect()->route('marcas.index')
                         ->with('success', 'Marca creada exitosamente.');
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $marca->update($request->all());

        return redirect()->route('marcas.index')
                         ->with('success', 'Marca actualizada exitosamente.');
    }

    public function destroy(Marca $marca)
    {
        try {
            // Borrar la marca
            $marca->delete();

            return redirect()->route('marcas.index')
                             ->with('success', 'Marca borrada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('marcas.index')
                             ->with('error', 'Hubo un error al borrar la marca.');
        }
    }
}

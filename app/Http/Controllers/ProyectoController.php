<?php
namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Mueble;
use App\Models\Marca;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
        // Muestra la lista de proyectos
        public function index()
        {
            $proyectos = Proyecto::with(['marca', 'marca.empresa'])->get();
            $marcas = Marca::all();
            $empresas = Empresa::all();
            return view('proyectos.index', compact('proyectos', 'marcas', 'empresas'));
        }
    
 
     public function create()
     {
         return view('proyectos.create'); // Vista específica para crear proyectos
     }
      // Muestra los detalles de un proyecto específico
      public function show(Proyecto $proyecto)
      {
          // Cargar el proyecto y sus muebles asociados si es necesario
          $muebles = $proyecto->muebles;  // Asegúrate de tener la relación 'muebles' definida en el modelo Proyecto
  
          return view('proyectos.show', compact('proyecto', 'muebles'));
      }
      
    // Almacena un nuevo proyecto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $proyecto = Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.');
    }

    // Muestra el formulario para editar un proyecto existente
    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    // Actualiza un proyecto existente en la base de datos
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    // Elimina un proyecto existente de la base de datos
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente.');
    }

    // Agrega un mueble al proyecto
    public function agregarMueble(Request $request)
    {
        $request->validate([
            'tipo_mueble' => 'required|string|max:255',
            'cantidad_muebles' => 'required|integer',
            'medidas' => 'required|string',
            'maquina' => 'required|string',
            'tipo_impresion' => 'required|string',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        Mueble::create([
            'tipo_mueble' => $request->tipo_mueble,
            'cantidad_muebles' => $request->cantidad_muebles,
            'medidas' => $request->medidas,
            'maquina' => $request->maquina,
            'tipo_impresion' => $request->tipo_impresion,
            'proyecto_id' => $request->proyecto_id,
        ]);

        return redirect()->route('proyectos.index')->with('success', 'Mueble agregado exitosamente.');
    }
}

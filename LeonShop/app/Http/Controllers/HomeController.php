<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca;
use Illuminate\Http\Request;

class HomeController extends Controller
{
      public function index(Request $request)
    {
        $query = Producto::with('marca');

        // busqueda por texto
        if ($request->filled('buscar')) {
            $query->where('nombre', 
            'like', 
            '%' . $request->buscar . '%')
                  ->orWhere('modelo', 
                  'like', 
                  '%' . $request->buscar . '%');
        }

        // filtro por marca
        if ($request->filled('marca')) {
            $query->where('marca_id', 
            $request->marca);
        }

        // filtro por tipo de prenda
        if ($request->filled('tipo')) {
            $query->where('tipo', 
            $request->tipo);
        }

        $productos = $query->get();

        // Para los selects
        $marcas = Marca::all();
        $tipos = Producto::select('tipo')->distinct()->pluck('tipo');

        return view('home', compact(
            'productos',
            'marcas',
            'tipos'
        ))->with([
            'busqueda' => 
            $request->buscar,
            'marcaSeleccionada' 
            => $request->marca,
            'tipoSeleccionado' 
            => $request->tipo,
        ]);
    }
}

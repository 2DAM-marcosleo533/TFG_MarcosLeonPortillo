<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $productos = Producto::with('marca')
            ->when($busqueda, function ($query, $busqueda) {
                $query->where('nombre', 'like', "%$busqueda%")
                      ->orWhere('modelo', 'like', "%$busqueda%");
            })
            ->get();

        return view('home', compact('productos', 'busqueda'));
    }
}

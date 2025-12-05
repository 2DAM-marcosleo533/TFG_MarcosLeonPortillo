<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('admin.products', compact('productos'));
    }

    public function create()
    {
        $marcas = Marca::all();
        return view('admin.nuevoProducto', compact('marcas'));
    }

    public function store(Request $request)
    {
        Producto::create([
            'nombre' => $request->nombre,
            'modelo' => $request->modelo,
            'precio' => $request->precio,
            'unidades' => $request->unidades,
            'marca_id' => $request->marca_id,
        ]);

        return redirect()->route('admin.products');
    }

    
 public function show(Producto $producto)
{
    return view('detallesProducto', compact('producto'));
}

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $marcas = Marca::all();
        return view('admin.editarProducto', compact('producto', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update([
            'nombre' => $request->nombre,
            'modelo' => $request->modelo,
            'precio' => $request->precio,
            'unidades' => $request->unidades,
            'marca_id' => $request->marca_id,
        ]);

        return redirect()->route('admin.products')
                         ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.products')
                         ->with('success', 'Producto eliminado correctamente.');
    }
}

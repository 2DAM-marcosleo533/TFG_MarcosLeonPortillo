<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca;
use App\Models\Comentario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
    // Comentarios del producto
    $comentarios = $producto->comentarios()
        ->with('user')
        ->latest()
        ->get();

    $puedeComentar = false;

    if (Auth::check()) {

        // ¿Ha comprado el producto?
        $haComprado = DB::table('compras')
            ->where('user_id', Auth::id())
            ->where('producto_id', $producto->id)
            ->exists();

        // ¿Ya ha comentado el producto?
        $yaComentado = DB::table('comentarios')
            ->where('user_id', Auth::id())
            ->where('producto_id', $producto->id)
            ->exists();

        // Puede comentar SOLO si ha comprado y NO ha comentado
        $puedeComentar = $haComprado && !$yaComentado;
    }

    return view('detallesProducto', compact(
        'producto',
        'comentarios',
        'puedeComentar'
    ));
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

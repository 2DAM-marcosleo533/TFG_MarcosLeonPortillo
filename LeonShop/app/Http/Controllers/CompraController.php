<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
   public function create(Producto $producto)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $direcciones = Auth::user()->direcciones;

    if ($direcciones->isEmpty()) {
        return redirect()
            ->route('perfil.edit')
            ->with('error', 'Se debe añadir una dirección antes de comprar.');
    }

    return view('compra', compact('producto', 'direcciones'));
}

 public function store(Request $request, Producto $producto)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $request->validate([
        'unidades' => 
        'required|integer|min:1',
        'direccion_id' => 
        'required|exists:direcciones,id'
    ]);

    $user = Auth::user();
    $unidades = $request->unidades;
    $direccionId = $request->direccion_id;

    if ($unidades > $producto->unidades) {
        return back()
        ->with('error', 'No hay suficientes unidades en stock');
    }

    $importe = $producto->precio * $unidades;

    if ($user->saldo < $importe) {
        return back()
        ->with('error', 'No tienes saldo suficiente');
    }

    DB::transaction(function () use (
        $producto, 
        $user, 
        $unidades, 
        $importe, 
        $direccionId) {

        Compra::create([
            'producto_id' => $producto->id,
            'user_id'     => $user->id,
            'unidades'    => $unidades,
            'importe'     => $importe,
            'iva'         => 0.21,
            'direccion_id'=> $direccionId, 
        ]);

        $producto
        ->decrement('unidades', $unidades);

        $user
        ->decrement('saldo', $importe);
    });

    return redirect()
    ->route('home')
    ->with('success', 'Compra realizada con éxito');
}

}

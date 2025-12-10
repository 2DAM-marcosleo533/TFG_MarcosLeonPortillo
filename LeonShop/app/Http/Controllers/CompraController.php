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

    return view('compra', compact('producto'));
}


   public function store(Request $request, Producto $producto)
{
    // 🔒 Seguridad: por si entran sin login
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $request->validate([
        'unidades' => 'required|integer|min:1'
    ]);

    $user = Auth::user();
    $unidades = $request->unidades;

 
    if ($unidades > $producto->unidades) {
        return back()->with('error', 'No hay suficientes unidades en stock');
    }

    $importe = $producto->precio * $unidades;

   
    if ($user->saldo < $importe) {
        return back()->with('error', 'No tienes saldo suficiente para realizar esta compra');
    }

    // ✅ TODO CORRECTO → SE REALIZA LA COMPRA
    DB::transaction(function () use ($producto, $user, $unidades, $importe) {

        // Crear compra
        Compra::create([
            'producto_id' => $producto->id,
            'user_id'     => $user->id,
            'unidades'    => $unidades,
            'importe'     => $importe,
            'iva'         => 0.21
        ]);

        // Restar stock
        $producto->decrement('unidades', $unidades);

        // Restar saldo al usuario
        $user->decrement('saldo', $importe);
    });

    return redirect()->route('home')->with('success', ' Compra realizada con éxito');
}

 public function edit()
    {
        $user = Auth::user();
        $compras = $user->compras()->with('producto')->orderBy('fecha', 'desc')->get();

        return view('perfil', compact('user', 'compras'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado');
    }

}

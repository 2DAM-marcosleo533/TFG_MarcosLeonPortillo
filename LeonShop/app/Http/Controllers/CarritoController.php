<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller{
   
    public function index()
{

    $userId = auth()->id();
    $carrito = session()->get("carrito_user_{$userId}", []);

    // Calcular el total del carrito
    $total = collect($carrito)
    ->sum(fn ($item) => $item['cantidad'] * $item['precio']);

    

    return view('carrito', compact('carrito', 'total'));
}


    // añadir un producto al carrito
public function add(Request $request, Producto $producto){
     $request->validate([
        'cantidad' => 'required|integer|min:1|max:' . $producto->unidades
    ]);

    $cantidad = $request->cantidad ?? 1;
    $userId = auth()->id();

    $key = "carrito_user_{$userId}";
    $carrito = session()->get($key, []);

    //si el carrito ya tiene el producto, sumo las unidades y si no, lo añado
    if (isset($carrito[$producto->id])) {

    $nuevaCantidad = $carrito[$producto->id]['cantidad'] + $cantidad;

    if ($nuevaCantidad > $producto->unidades) {
        return back()
        ->with('error', 'No hay suficiente stock disponible');
    }

    $carrito[$producto->id]['cantidad'] = $nuevaCantidad;

} else {
    $carrito[$producto->id] = [
        'producto_id' => $producto->id,
        'nombre'      => $producto->nombre,
        'precio'      => $producto->precio,
        'cantidad'    => $cantidad,
    ];
}


    session()->put($key, $carrito);

    return redirect()->route('home')
    ->with('success', 'Producto añadido al carrito');

}

//comprar el carrito entero
  public function checkout(Request $request){
    $request->validate([
        'direccion_id' => 'required|exists:direcciones,id'
    ]);

    $user = auth()->user();
    $userId = $user->id;

    $key = "carrito_user_{$userId}";
    $carrito = session()->get($key, []);

    if (empty($carrito)) {
        return back()
        ->with('error', 'El carrito está vacío');
    }

    // calcular total del carrito
    $total = collect($carrito)
    ->sum(fn ($i) => $i['cantidad'] * $i['precio']);

    // ver si hay saldo suficiente
    if ($user->saldo < $total) {
        return back()
        ->with('error', 'No tienes saldo suficiente para comprar todo el carrito');
    }

    DB::transaction(function () use ($carrito, $user, $request, $total) {

        foreach ($carrito as $item) {

            $producto = Producto::findOrFail($item['producto_id']);

            // para asegurarse que al añadir mas productos habiendo ya de antes, no haya stock
            if ($item['cantidad'] > $producto->unidades) {
                throw new \Exception('Stock insuficiente');
            }

            Compra::create([
                'producto_id'  => $producto->id,
                'user_id'      => $user->id,
                'unidades'     => $item['cantidad'],
                'importe'      => $item['cantidad'] * $item['precio'],
                'iva'          => 0.21,
                'direccion_id' => $request->direccion_id
            ]);

            $producto
            ->decrement('unidades', $item['cantidad']);
        }

        // descontar saldo
        $user->decrement('saldo', $total);
    });

    session()->forget($key);

    return redirect()->route('home')
        ->with('success', 'Compra realizada con éxito');
}


//eliminar un producto del carrito
public function remove(Producto $producto)
{
    $userId = auth()->id();
    $key = "carrito_user_{$userId}";
    $carrito = session()->get($key, []);

    unset($carrito[$producto->id]);

    session()->put($key, $carrito);

    return back()->with('success', 'Producto eliminado del carrito');
}


}

<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InformeController extends Controller
{
    public function index()
    {
        // si no tiene permisos, que salga aviso de prohibido
        if (!Auth::check() || 
        !Auth::user()->is_admin) {
        abort(403);
    }

        // 5 usuarios que mas dinero han gastado
        $topUsuarios = Compra::select(
                'users.name',
                DB::raw('SUM(compras.importe) as total_gastado')
            )
            ->join('users', 'compras.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_gastado')
            ->limit(5)
            ->get();

        // los 5 productos que mas se han vendido
        $topProductos = Compra::select(
                'productos.nombre',
                DB::raw('SUM(compras.unidades) as total_vendido')
            )
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->groupBy('productos.id', 'productos.nombre')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        // las 5 marcas que mas se ha vendido
        $topMarcas = Compra::select(
                'marcas.nombre',
                DB::raw('SUM(compras.unidades) as total_vendido')
            )
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->groupBy('marcas.id', 'marcas.nombre')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        return view('admin.informes', compact(
            'topUsuarios',
            'topProductos',
            'topMarcas'
        ));
    }
}

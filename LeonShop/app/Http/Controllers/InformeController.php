<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;

class InformeController extends Controller
{
    public function index()
    {
        // ✅ TOP 5 USUARIOS QUE MÁS HAN GASTADO
        $topUsuarios = Compra::select(
                'users.name',
                DB::raw('SUM(compras.importe) as total_gastado')
            )
            ->join('users', 'compras.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_gastado')
            ->limit(5)
            ->get();

        // ✅ TOP 5 PRODUCTOS MÁS VENDIDOS (POR UNIDADES)
        $topProductos = Compra::select(
                'productos.nombre',
                DB::raw('SUM(compras.unidades) as total_vendido')
            )
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->groupBy('productos.id', 'productos.nombre')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        // ✅ TOP 5 MARCAS MÁS VENDIDAS (POR UNIDADES)
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

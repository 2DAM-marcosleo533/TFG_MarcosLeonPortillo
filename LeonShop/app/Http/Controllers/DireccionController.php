<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'direccion_envio' => 
            'required|string',

            'direccion_facturacion' => 
            'required|string',
        ], [
            'direccion_envio.required' => 
            'Es obligatoria la dirección de envío',
            
            'direccion_facturacion.required' => 
            'Es obligatoria la dirección de facturación',
        ]);

        Direccion::create([
            'user_id' => 
            Auth::id(),
            'direccion_envio' => 
            $request->direccion_envio,
            'direccion_facturacion' => 
            $request->direccion_facturacion,
        ]);

        return redirect()
            ->route('perfil.edit')
            ->with('success', 'Dirección añadida correctamente');
    }
}

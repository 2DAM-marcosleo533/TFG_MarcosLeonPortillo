<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ComentarioController extends Controller
{

    // Formulario para crear comentario
    public function create(Producto $producto)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('comentarios.crearComentario', compact('producto'));
    }

    // Guardar comentario
public function store(Request $request, Producto $producto)
{
    $userId = Auth::id();

    // ¿Ya ha comentado?
    $yaComentado = DB::table('comentarios')
        ->where('user_id', $userId)
        ->where('producto_id', $producto->id)
        ->exists();

    if ($yaComentado) {
        return redirect()
            ->route('producto.show', $producto)
            ->with('error', 'Ya has comentado este producto.');
    }

    $request->validate([
        'texto' => 'required',
        'valoracion' => 'required|integer|min:1|max:5'
    ]);

    Comentario::create([
        'user_id' => $userId,
        'producto_id' => $producto->id,
        'texto' => $request->texto,
        'valoracion' => $request->valoracion
    ]);

    return redirect()
        ->route('producto.show', $producto)
        ->with('success', 'Comentario añadido correctamente.');
}
    // EDITAR (solo dueño)
    public function edit(Comentario $comentario)
    {
        if ($comentario->user_id !== Auth::id()) {
            abort(403);
        }

        return view('comentarios.editarComentario', compact('comentario'));
    }

    // ACTUALIZAR
    public function update(Request $request, Comentario $comentario)
    {
        if ($comentario->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'texto' => 'required',
            'valoracion' => 'required|integer|min:1|max:5'
        ], [
            'texto.required' => 'El comentario es obligatorio',
            'valoracion.required' => 'La valoración es obligatoria'
        ]);

        $comentario->update([
            'texto' => $request->texto,
            'valoracion' => $request->valoracion
        ]);

        return redirect()
            ->route('producto.show', $comentario->producto_id)
            ->with('success', 'Comentario actualizado correctamente');
    }

    // ELIMINAR (solo admin)
    public function destroy(Comentario $comentario)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $comentario->delete();

        return back()->with('success', 'Comentario eliminado');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $compras = $user->compras()->with('producto')->orderBy('created_at', 'desc')->get();

        return view('perfil', compact('user', 'compras'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|min:6|confirmed'
    ]);

    $user->update([
        'name' => $request->name,
        'password' => bcrypt($request->password)
    ]);

    return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente');
}

}

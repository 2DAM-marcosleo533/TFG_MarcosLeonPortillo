<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('perfil', [
            'user'        => $user,
            'compras'     => $user->compras()->with('producto')->latest()->get(),
            'direcciones' => $user->direcciones,
        ]);
    }

    public function update(Request $request)
    {
        Auth::user()->update([
            'name'     => $request->validate([
                'name'     => 'required|string|max:255',
                'password' => 'required|min:6|confirmed',
            ])['name'],
            'password' => bcrypt($request->password),
        ]);

        return redirect()
            ->route('perfil.edit')
            ->with('success', 'Perfil actualizado correctamente');
    }
}

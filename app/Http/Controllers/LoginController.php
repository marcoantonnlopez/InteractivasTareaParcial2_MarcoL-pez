<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('inicioSesion');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->tipo == 'administrador') {
                return redirect()->route('ProveedoresRegistrados');
            } elseif (auth()->user()->tipo == 'proveedor') {
                return redirect()->route('ProductosRegistrados');
            } elseif (auth()->user()->tipo == 'cliente') {
                return redirect()->route('cliente.mostrar-solicitud');
            }
        }

        return redirect()->route('inicio-sesion')->with('error', 'Credenciales incorrectas.');
    }
}

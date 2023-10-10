<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direccion; 
use App\Models\Solicitud;
use App\Models\DetalleSolicitud;
use App\Models\Producto;

class ClienteController extends Controller
{
    public function formularioRegistro()
    {
        return view('registroUsuarios');
    }

    public function guardarCliente(Request $request)
    {
        $cliente = new User();
        $cliente->name = $request->input('nombre_usuario');
        $cliente->email = $request->input('correo');
        $cliente->password = bcrypt($request->input('contrasena'));
        $cliente->tipo = 'cliente';

        $cliente->save();

        $direccion = new Direccion();
        $direccion->calle = $request->input('calle');
        $direccion->numero = $request->input('numero');

        $cliente->direccion()->save($direccion);

        return redirect('/')->with('success', 'Cliente registrado exitosamente');
    }

    public function mostrarFormularioSolicitud()
    {
        $productos = Producto::all();

        return view('altaSolicitud', compact('productos'));
    }

    public function guardarSolicitud(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
    
        $solicitud = new Solicitud();
        $solicitud->id_usuario = auth()->user()->id;
        $solicitud->save();
    
        $idSolicitud = $solicitud->id;

        $detalleSolicitud = new DetalleSolicitud();
        $detalleSolicitud->producto_id = $request->input('producto_id');
        $detalleSolicitud->cantidad = $request->input('cantidad');
        $detalleSolicitud->idsolicitud = $solicitud->id;
        $detalleSolicitud->save();
    
        return redirect()->route('cliente.mostrar-solicitud')->with('success', 'Solicitud creada exitosamente.');
    }

    public function mostrarSolicitudes()
    {
        $solicitudes = Solicitud::where('id_usuario', auth()->user()->id)->get();

        return view('estadoSolicitud', compact('solicitudes'));
    }

    public function mostrarFormularioDatos()
    {
        $cliente = auth()->user();
        return view('actualizarDatos', compact('cliente'));
    }

    // Procesar la actualización de datos personales y dirección
    public function actualizarDatos(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            'contrasena' => 'nullable|string|min:8|confirmed',
            'calle' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:255',
        ]);

        $cliente = auth()->user();
        $cliente->name = $request->input('nombre');
        $cliente->email = $request->input('correo');

        if ($request->filled('contrasena')) {
            $cliente->password = Hash::make($request->input('contrasena'));
        }

        $cliente->save();

        if ($request->filled('calle') && $request->filled('numero')) {
            if (!$cliente->direccion) {
                $direccion = new Direccion();
                $direccion->calle = $request->input('calle');
                $direccion->numero = $request->input('numero');
                $direccion->user_id = $cliente->id;
                $direccion->save();
            } else {
                $cliente->direccion->calle = $request->input('calle');
                $cliente->direccion->numero = $request->input('numero');
                $cliente->direccion->save();
            }
        }

        return redirect()->route('cliente.mostrar-formulario-datos')->with('success', 'Datos actualizados con éxito');
    }
    
}

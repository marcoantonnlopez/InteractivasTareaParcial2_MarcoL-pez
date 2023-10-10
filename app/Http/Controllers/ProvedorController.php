<?php

namespace App\Http\Controllers;
use App\Models\Solicitud;
use App\Models\Producto;
use App\Models\User;

use Illuminate\Http\Request;

class ProvedorController extends Controller
{
    public function mostrarCambiarEstado()
    {
        // Obtén todas las solicitudes de los clientes
        $solicitudes = Solicitud::with(['cliente', 'detalleSolicitud.producto'])->get();

        return view('cambiarEstado', compact('solicitudes'));
    }

    // Método para cambiar el estado de una solicitud
    public function cambiarEstado(Request $request, $id)
    {

        $solicitud = Solicitud::find($id);

        if (!$solicitud) {
            return redirect()->route('proveedor.mostrar-cambiar-estado')->with('error', 'Solicitud no encontrada');
        }
    
        $nuevoEstado = $request->input('nuevo_estado');
        $solicitud->estado = $nuevoEstado;
        $solicitud->save();
    
        return redirect()->route('proveedor.mostrar-cambiar-estado')->with('success', 'Estado de solicitud actualizado correctamente');
    }

    public function mostrarInformacion()
    {
        $productosMasSolicitados = Producto::withCount('solicitudes')
            ->orderByDesc('solicitudes_count')
            ->limit(10)
            ->get();

        $clientesNuevosAlMes = User::whereMonth('created_at', now()->month)->count();

        /*
        $gananciasAlMes = DB::table('solicitud')
            ->join('detalle_solicitud', 'solicitud.id', '=', 'detalle_solicitud.idsolicitud')
            ->join('productos', 'detalle_solicitud.producto_id', '=', 'productos.id')
            ->whereMonth('solicitud.fecha', now()->month)
            ->sum('productos.precio');
*/
        $topClientes = User::withCount('solicitudes')
            ->orderByDesc('solicitudes_count')
            ->limit(10)
            ->get();

        return view('informacionProveedor', compact('productosMasSolicitados', 'clientesNuevosAlMes', 'topClientes'));
    }
}

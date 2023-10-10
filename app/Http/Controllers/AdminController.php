<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producto;

class AdminController extends Controller
{
    public function ProveedoresRegistrados()
    {
        $proveedores = User::where('tipo', 'proveedor')->get();

        return view('ProveedoresRegistrados', compact('proveedores'));
    }

    public function formularioRegistroProveedor()
    {
        return view('registrarProveedor');
    }

    public function guardarProveedor(Request $request)
    {


        $proveedor = new User();
        $proveedor->name = $request->input('nombre');
        $proveedor->email = $request->input('correo');
        $proveedor->password = bcrypt($request->input('password'));
        $proveedor->tipo = 'proveedor'; 
        $proveedor->save();

        return redirect()->route('ProveedoresRegistrados')->with('success', 'Proveedor agregado correctamente');
    }

    public function formularioEditarProveedor($id)
    {
        $proveedor = User::find($id);

        return view('editaProveedores', compact('proveedor'));
    }

    public function actualizarProveedor(Request $request, $id)
    {
        $proveedor = User::find($id);

        $proveedor->name = $request->input('nombre');
        $proveedor->email = $request->input('correo');
        $proveedor->password = bcrypt($request->input('password'));
        $proveedor->save();

        return redirect()->route('ProveedoresRegistrados')->with('success', 'Proveedor actualizado correctamente');
    }

    public function eliminarProveedor($id)
    {
        $proveedor = User::find($id);

        $proveedor->delete();

        return redirect()->route('ProveedoresRegistrados')->with('borrar', 'Proveedor eliminado correctamente');
    }


    public function ProductosRegistrados()
    {
        $productos = Producto::all();

        return view('ProductosRegistrados', compact('productos'));
    }

    public function formularioRegistroProducto()
    {
        return view('altaProductos');
    }

        public function guardarProducto(Request $request)
        {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required|numeric',
            ]);

            $producto = new Producto();
            $producto->nombre = $request->input('nombre');
            $producto->precio = $request->input('precio');
            $producto->user_id = auth()->user()->id; 
            $producto->save();

            return redirect()->route('ProductosRegistrados')->with('success', 'Producto agregado correctamente');
        }

    public function formularioEditarProducto($id)
    {
        $producto = Producto::find($id);

        return view('editaProductos', compact('producto'));
    }

    public function actualizarProducto(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
        ]);

        $producto = Producto::find($id);

        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->save();

        return redirect()->route('ProductosRegistrados')->with('success', 'Producto actualizado correctamente');
    }

    public function eliminarProducto($id)
    {
        $producto = Producto::find($id);

        $producto->delete();
        return redirect()->route('ProductosRegistrados')->with('borrar', 'Producto eliminado correctamente');
    }


}

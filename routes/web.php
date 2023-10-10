<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProvedorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('/cliente/actualizar-datos', [ClienteController::class, 'mostrarFormularioDatos'])->name('cliente.mostrar-formulario-datos');
    Route::put('/cliente/actualizar-datos', [ClienteController::class, 'actualizarDatos'])->name('cliente.actualizar-datos');
    Route::get('/cliente/solicitudes', [ClienteController::class, 'mostrarSolicitudes'])->name('cliente.solicitudes');
    Route::get('/cliente/solicitud', [ClienteController::class, 'mostrarFormularioSolicitud'])->name('cliente.mostrar-solicitud');
    Route::post('/cliente/solicitud', [ClienteController::class, 'guardarSolicitud'])->name('cliente.guardar-solicitud');

});

Route::middleware(['auth', 'proveedor'])->group(function () {
    Route::get('/informacion-proveedor', [ProvedorController::class, 'mostrarInformacion'])->name('proveedor.informacion');
    Route::get('/proveedor/cambiar-estado', [ProvedorController::class, 'mostrarCambiarEstado'])->name('proveedor.mostrar-cambiar-estado');
    Route::put('/proveedor/cambiar-estado/{id}', [ProvedorController::class, 'cambiarEstado'])->name('proveedor.cambiar-estado');
    Route::get('/productos', [AdminController::class, 'listaProductos'])->name('listaProductos');
    Route::get('/productos/crear', [AdminController::class, 'formularioRegistroProducto'])->name('formularioRegistroProducto');
    Route::post('/productos/crear', [AdminController::class, 'guardarProducto'])->name('guardarProducto');
    Route::get('/productos/editar/{id}', [AdminController::class, 'formularioEditarProducto'])->name('formularioEditarProducto');
    Route::put('/productos/editar/{id}', [AdminController::class, 'actualizarProducto'])->name('actualizarProducto');
    Route::delete('/productos/eliminar/{id}', [AdminController::class, 'eliminarProducto'])->name('eliminarProducto');
});

Route::get('/inicio-sesion', [LoginController::class, 'showLoginForm'])->name('inicio-sesion');
Route::post('/inicio-sesion', [LoginController::class, 'login'])->name('login.post');
Route::get('/registro-cliente', [ClienteController::class, 'formularioRegistro'])->name('formularioRegistro');
Route::post('/guardar-cliente', [ClienteController::class, 'guardarCliente'])->name('guardarCliente');




Route::middleware(['auth', 'admin'])->group(function () {
    // Ruta para mostrar la lista de proveedores
    Route::get('/listaProveedores', [AdminController::class, 'listaProveedores'])->name('listaProveedores');

    // Ruta para mostrar el formulario de registro de proveedores
    Route::get('/altaProveedores', [AdminController::class, 'formularioRegistroProveedor'])->name('formularioRegistroProveedor');

    // Ruta para procesar el formulario de registro de proveedores
    Route::post('/guardarProveedor', [AdminController::class, 'guardarProveedor'])->name('guardarProveedor');

    // Ruta para mostrar el formulario de edición de proveedores
    Route::get('/editaProveedores/{id}', [AdminController::class, 'formularioEditarProveedor'])->name('formularioEditarProveedor');

    // Ruta para actualizar la información del proveedor
    Route::put('/actualizarProveedor/{id}', [AdminController::class, 'actualizarProveedor'])->name('actualizarProveedor');

    // Ruta para eliminar un proveedor
    Route::delete('/eliminarProveedor/{id}', [AdminController::class, 'eliminarProveedor'])->name('eliminarProveedor');

    Route::get('/productos', [AdminController::class, 'listaProductos'])->name('listaProductos');
    Route::get('/productos/crear', [AdminController::class, 'formularioRegistroProducto'])->name('formularioRegistroProducto');
    Route::post('/productos/crear', [AdminController::class, 'guardarProducto'])->name('guardarProducto');
    Route::get('/productos/editar/{id}', [AdminController::class, 'formularioEditarProducto'])->name('formularioEditarProducto');
    Route::put('/productos/editar/{id}', [AdminController::class, 'actualizarProducto'])->name('actualizarProducto');
    Route::delete('/productos/eliminar/{id}', [AdminController::class, 'eliminarProducto'])->name('eliminarProducto');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

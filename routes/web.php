<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProvedorController;
use App\Http\Controllers\ProfileController;


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

// PROVEEDOR RUTAS
Route::middleware(['auth', 'proveedor'])->group(function () {
    Route::get('/informacion-proveedor', [ProvedorController::class, 'mostrarInformacion'])->name('proveedor.informacion');
    Route::get('/proveedor/cambiar-estado', [ProvedorController::class, 'mostrarCambiarEstado'])->name('proveedor.mostrar-cambiar-estado');
    Route::put('/proveedor/cambiar-estado/{id}', [ProvedorController::class, 'cambiarEstado'])->name('proveedor.cambiar-estado');
    
    // Productos
    Route::get('/productos', [AdminController::class, 'ProductosRegistrados'])->name('ProductosRegistrados');
    Route::get('/productos/crear', [AdminController::class, 'formularioRegistroProducto'])->name('formularioRegistroProducto');
    Route::post('/productos/crear', [AdminController::class, 'guardarProducto'])->name('guardarProducto');
    Route::get('/productos/editar/{id}', [AdminController::class, 'formularioEditarProducto'])->name('formularioEditarProducto');
    Route::put('/productos/editar/{id}', [AdminController::class, 'actualizarProducto'])->name('actualizarProducto');
    Route::delete('/productos/eliminar/{id}', [AdminController::class, 'eliminarProducto'])->name('eliminarProducto');
});

// CLIENTE RUTAS
Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('/cliente/actualizar-datos', [ClienteController::class, 'mostrarFormularioDatos'])->name('cliente.mostrar-formulario-datos');
    Route::put('/cliente/actualizar-datos', [ClienteController::class, 'actualizarDatos'])->name('cliente.actualizar-datos');
    Route::get('/cliente/solicitudes', [ClienteController::class, 'mostrarSolicitudes'])->name('cliente.solicitudes');
    Route::get('/cliente/solicitud', [ClienteController::class, 'mostrarFormularioSolicitud'])->name('cliente.mostrar-solicitud');
    Route::post('/cliente/solicitud', [ClienteController::class, 'guardarSolicitud'])->name('cliente.guardar-solicitud');

});

Route::post('/guardar-cliente', [ClienteController::class, 'guardarCliente'])->name('guardarCliente');
Route::get('/registro-cliente', [ClienteController::class, 'formularioRegistro'])->name('formularioRegistro');
Route::get('/inicio-sesion', [LoginController::class, 'showLoginForm'])->name('inicio-sesion');
Route::post('/inicio-sesion', [LoginController::class, 'login'])->name('login.post');

// RUTAS ACCESO ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    // Proveedores 
    Route::get('/ProveedoresRegistrados', [AdminController::class, 'ProveedoresRegistrados'])->name('ProveedoresRegistrados');
    Route::get('/registrarProveedor', [AdminController::class, 'formularioRegistroProveedor'])->name('formularioRegistroProveedor');
    Route::post('/guardarProveedor', [AdminController::class, 'guardarProveedor'])->name('guardarProveedor');
    Route::get('/editaProveedores/{id}', [AdminController::class, 'formularioEditarProveedor'])->name('formularioEditarProveedor');
    Route::put('/actualizarProveedor/{id}', [AdminController::class, 'actualizarProveedor'])->name('actualizarProveedor');
    Route::delete('/eliminarProveedor/{id}', [AdminController::class, 'eliminarProveedor'])->name('eliminarProveedor');

    // Productos
    Route::get('/productos', [AdminController::class, 'ProductosRegistrados'])->name('ProductosRegistrados');
    Route::post('/productos/crear', [AdminController::class, 'guardarProducto'])->name('guardarProducto');
    Route::get('/productos/crear', [AdminController::class, 'formularioRegistroProducto'])->name('formularioRegistroProducto');
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

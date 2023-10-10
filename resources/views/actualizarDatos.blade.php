<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Datos Personales y Dirección</title>
    <!-- Agrega los enlaces a Bootstrap CSS aquí -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cambiar Datos Personales y Dirección</h1>
        <form method="POST" action="{{ route('cliente.actualizar-datos') }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $cliente->name) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $cliente->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Nueva Contraseña (opcional)</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control">
            </div>

            <div class="mb-3">
                <label for="confirmar_contrasena" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" class="form-control">
            </div>

            <div class="mb-3">
                <label for="calle" class="form-label">Calle</label>
                <input type="text" name="calle" id="calle" class="form-control" value="{{ old('calle', $cliente->direccion->calle ?? '') }}">
            </div>
            
            <div class="mb-3">
                <label for="numero" class="form-label">Número</label>
                <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero', $cliente->direccion->numero ?? '') }}">
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Agrega los enlaces a Bootstrap JavaScript aquí si es necesario -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>

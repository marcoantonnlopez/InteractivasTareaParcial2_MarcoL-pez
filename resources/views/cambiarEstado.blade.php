<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Estado de Solicitudes</title>
    <!-- Agrega los enlaces a Bootstrap CSS aquí -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cambiar Estado de Solicitudes</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Solicitud</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Estado Actual</th>
                    <th>Nuevo Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->cliente->name }}</td>
                    @foreach($solicitud->detalleSolicitud as $detalle)
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                    @endforeach
                    <td>{{ $solicitud->estado }}</td>
                    <td>
                        <form method="POST" action="{{ route('proveedor.cambiar-estado', $solicitud->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="nuevo_estado" class="form-select" autocomplete="off">
                                <option value="recibida">Recibida</option>
                                <option value="en proceso">En Proceso</option>
                                <option value="completada">Completada</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Cambiar Estado</button>
                        </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Agrega los enlaces a Bootstrap JavaScript aquí si es necesario -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>


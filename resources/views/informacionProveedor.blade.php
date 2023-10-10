<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información para Proveedor</title>
    <!-- Agrega los enlaces a Bootstrap CSS aquí -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Información para Proveedor</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Productos Más Solicitados</h2>
                <ul class="list-group">
                    @foreach($productosMasSolicitados as $producto)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $producto->nombre }}
                            <span class="badge bg-primary rounded-pill">Solicitudes: {{ $producto->solicitudes_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Número de Clientes Nuevos al Mes</h2>
                <p class="lead">{{ $clientesNuevosAlMes }}</p>
                <h2>Ganancias al Mes</h2>
                <h2>Top 10 Clientes con Más Solicitudes</h2>
                <ol class="list-group">
                    @foreach($topClientes as $cliente)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $cliente->name }}
                            <span class="badge bg-primary rounded-pill">Solicitudes: {{ $cliente->solicitudes_count }}</span>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <!-- Agrega los enlaces a Bootstrap JavaScript aquí si es necesario -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>

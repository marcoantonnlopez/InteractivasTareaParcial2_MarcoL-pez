<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administración de Proveedores</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>
<body>
    <header>
    </header>
    <main>
        <div class="container">
            <h1>Administración de Proveedores</h1>
            <a href="{{ route('formularioRegistroProveedor')}}" class="btn btn-primary">Agregar Proveedor</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->name }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td>
                                <a href="{{ route('formularioEditarProveedor', ['id' => $proveedor->id]) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('eliminarProveedor', ['id' => $proveedor->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </main>
    <footer>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Éxito',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 2000,
            });
        @endif

        @if(session('borrar'))
            Swal.fire({
                title: 'Proveedor Eliminado',
                text: '{{ session('borrar') }}',
                icon: 'success',
                timer: 2000,
            });
        @endif

        @if(session('save'))
            Swal.fire({
                title: 'Proveedor Agregado',
                text: '{{ session('save') }}',
                icon: 'success',
                timer: 2000,
            });
        @endif
    </script>
</body>
</html>

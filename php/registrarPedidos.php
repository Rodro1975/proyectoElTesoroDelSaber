<?php
// Incluir el archivo de conexión con PDO
require 'conexion.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $folioPedido = $_POST['folioPedido'];
    $ID_usuario = $_POST['ID_usuario'];
    $tituloLibro = $_POST['tituloLibro'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $fechaPedido = $_POST['fechaPedido'];

    // Verificar si el folioPedido ya existe
    $sqlCheck = "SELECT COUNT(*) FROM pedidos WHERE folioPedido = :folioPedido";
    $stmtCheck = $conexion->prepare($sqlCheck);
    $stmtCheck->bindParam(':folioPedido', $folioPedido);
    $stmtCheck->execute();

    if ($stmtCheck->fetchColumn() > 0) {
        echo "El folio del pedido ya existe. Por favor, elige otro.";
    } else {
        // Insertar los datos en la tabla 'pedidos'
        $sql = "INSERT INTO pedidos (folioPedido, ID_usuario, tituloLibro, autor, precio, fechaPedido) 
                VALUES (:folioPedido, :ID_usuario, :tituloLibro, :autor, :precio, :fechaPedido)";
        $stmt = $conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':folioPedido', $folioPedido);
        $stmt->bindParam(':ID_usuario', $ID_usuario);
        $stmt->bindParam(':tituloLibro', $tituloLibro);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':fechaPedido', $fechaPedido);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Pedido registrado exitosamente.";
            header("Location: registrarPedidos.php"); // Redirige a la misma página o a donde quieras
            exit();
        } else {
            echo "Error al registrar el pedido.";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pedidos PL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../php/usuarioPL.php">Librería PL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id=navbarNav>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../php/usuarioPL.php">Inicio PL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/consultarPL.php">Consultar PL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/registrarPedidos.php">Registrar PL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/editar.php">Modificar PL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/eliminar.php">Eliminar PL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/logout.php">Salir PL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="form-regPedidos">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2>Registrar Nuevo Pedido</h2>
                        </div>
                        <div class="card-body">
                            <form action="registrarPedidos.php" method="POST">
                                <div class="mb-3">
                                    <label for="folioPedido" class="form-label">Folio del Pedido:</label>
                                    <input type="text" class="form-control" id="folioPedido" name="folioPedido" pattern="[A-Z]{2}[0-9]{3}[A-Z]{3}" required data-bs-toggle="tooltip" data-bs-placement="top" title="Ingresa el folio como se muestra en el ejemplo abajo">
                                    <div class="form-text">Ejemplo: AB123CDE</div>
                                </div>

                                <div class="mb-3">
                                    <label for="tituloLibro" class="form-label">Título del Libro:</label>
                                    <input type="text" class="form-control" id="tituloLibro" name="tituloLibro" required data-bs-toggle="tooltip" data-bs-placement="top" title="Ingresa el título del libro">
                                </div>

                                <div class="mb-3">
                                    <label for="autor" class="form-label">Autor:</label>
                                    <input type="text" class="form-control" id="autor" name="autor" required data-bs-toggle="tooltip" data-bs-placement="top" title="Ingresa el nombre del autor">
                                </div>

                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio:</label>
                                    <input type="number" class="form-control" step="0.01" id="precio" name="precio" required data-bs-toggle="tooltip" data-bs-placement="top" title="Ingresa el precio del libro">
                                </div>

                                <div class="mb-3">
                                    <label for="fechaPedido" class="form-label">Fecha del Pedido:</label>
                                    <input type="date" class="form-control" id="fechaPedido" name="fechaPedido" required data-bs-toggle="tooltip" data-bs-placement="top" title="Ingresa la fecha usando el calendario">
                                </div>

                                <input type="hidden" name="ID_usuario" value="<?php echo $_SESSION['ID_usuario']; ?>">

                                <button type="submit" class="btn btn-primary">Registrar Pedido</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS (requerido para el menú desplegable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
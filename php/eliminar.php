<?php
// Incluir el archivo de conexión con PDO
require 'conexion.php';

// Iniciar la sesión
session_start();

// Variable para almacenar los datos del pedido encontrado
$pedido = [];

// Manejar la búsqueda del pedido por folio
if (isset($_POST['buscar_pedido'])) {
    $folioPedido = $_POST['folioPedido'];

    try {
        $sql = "SELECT * FROM pedidos WHERE folioPedido = :folioPedido";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':folioPedido', $folioPedido);
        $stmt->execute();

        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pedido) {
            echo "No se encontró ningún pedido con el folio proporcionado.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Manejar la eliminación del pedido
if (isset($_POST['actualizar_pedido'])) {
    $folioPedido = $_POST['folioPedido'];

    try {
        $sql = "DELETE FROM pedidos WHERE folioPedido = :folioPedido";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':folioPedido', $folioPedido);
        $stmt->execute();

        echo "Pedido eliminado exitosamente.";

        // Redirigir a otra página o limpiar la variable para mostrar el formulario vacío nuevamente
        header("Location: ../php/consultarPL.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Pedidos PL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js" defer></script>
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

    <section class="form-eliminar">
        <div class="content">
            <h1>Eliminar un pedido</h1>

            <!-- Formulario para buscar el pedido -->
            <?php if (empty($pedido)) : ?>
                <form class="row" action="" method="POST">
                    <div class="col-12">
                        <label for="folioInput" class="form-label">Número de folio</label>
                        <input type="text" class="form-control" id="folioInput" name="folioPedido" placeholder="Ingresa el folio del pedido" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="buscar_pedido">Buscar Pedido</button>
                </form>
            <?php endif; ?>

            <!-- Formulario para eliminar el pedido si se encontró -->
            <?php if (!empty($pedido)) : ?>
                <form class="row" action="" method="POST" onsubmit="return confirmarEliminacion();">
                    <input type="hidden" name="folioPedido" value="<?php echo htmlspecialchars($folioPedido); ?>">
                    <div class="col-6">
                        <label for="tituloLibro" class="form-label">Título del libro</label>
                        <input type="text" class="form-control" id="tituloLibro" name="titulo" value="<?php echo htmlspecialchars($pedido['tituloLibro']); ?>" readonly>
                    </div>
                    <div class="col-6">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($pedido['autor']); ?>" readonly>
                    </div>
                    <div class="col-6">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($pedido['precio']); ?>" readonly>
                    </div>
                    <div class="col-6">
                        <label for="fechaPedido" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fechaPedido" name="fecha" value="<?php echo htmlspecialchars($pedido['fechaPedido']); ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary" name="actualizar_pedido">Eliminar Pedido</button>
                    <a class="cancelar" href="../php/consultarPL.php">Cancelar</a>
                </form>
            <?php endif; ?>
        </div>
    </section>
    <!-- Bootstrap JS (requerido para el menú desplegable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
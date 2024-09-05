<?php
// Incluir el archivo de conexión con PDO
require 'conexion.php';

// Iniciar la sesión
session_start();

// Obtener el ID del usuario de la sesión
$ID_usuario = $_SESSION['ID_usuario'];

try {
    // Preparar la consulta para obtener los pedidos del usuario
    $sql = "SELECT folioPedido, tituloLibro, autor, precio, fechaPedido FROM pedidos WHERE ID_usuario = :ID_usuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':ID_usuario', $ID_usuario);
    $stmt->execute();

    // Obtener los resultados en un array
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar CL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../php/usuarioCL.php">Librería CL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id=navbarNav>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../php/usuarioCL.php">Inicio CL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/consultarCL.php">Consultar CL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Registrar CL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/logout.php">Salir CL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="pedidos">
        <div class="pedidos-content">
            <h1>Pedidos realizados</h1>
            <table>
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Título del libro</th>
                        <th>Autor</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pedidos)) : ?>
                        <?php foreach ($pedidos as $pedido) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pedido['folioPedido']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['tituloLibro']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['autor']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['precio']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['fechaPedido']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No has realizado ningún pedido aún.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Bootstrap JS (requerido para el menú desplegable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
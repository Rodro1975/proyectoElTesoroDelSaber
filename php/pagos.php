<?php
// Incluir el archivo de conexión con PDO
require 'conexion.php';

// Iniciar la sesión
session_start();

// Prioridad para obtener el ID_usuario: formulario, URL, sesión.
if (isset($_POST['ID_usuario'])) {
    $ID_usuario = $_POST['ID_usuario']; // Obtener el ID_usuario desde el formulario
} elseif (isset($_GET['ID_usuario'])) {
    $ID_usuario = $_GET['ID_usuario']; // Obtener el ID_usuario desde la URL
} else {
    $ID_usuario = $_SESSION['ID_usuario']; // Obtener el ID_usuario desde la sesión
}

// Verificar si se ha obtenido el ID_usuario correctamente
if (!$ID_usuario) {
    echo "Error: ID de usuario no proporcionado.";
    exit;
}

// Manejar la actualización de pedidos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['folioPedido'])) {
    $folioPedido = $_POST['folioPedido'];
    $tituloLibro = $_POST['tituloLibro'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $fechaPedido = $_POST['fechaPedido'];

    try {
        $sql = "UPDATE pedidos SET tituloLibro = :tituloLibro, autor = :autor, precio = :precio, fechaPedido = :fechaPedido WHERE folioPedido = :folioPedido AND ID_usuario = :ID_usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':tituloLibro', $tituloLibro);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':fechaPedido', $fechaPedido);
        $stmt->bindParam(':folioPedido', $folioPedido);
        $stmt->bindParam(':ID_usuario', $ID_usuario);
        $stmt->execute();

        // Redirigir a la misma página para evitar el reenvío del formulario
        header("Location: " . $_SERVER['PHP_SELF'] . "?ID_usuario=" . urlencode($ID_usuario));
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener el folio del pedido para edición desde la URL si está presente
$folioParaEditar = isset($_GET['folio']) ? $_GET['folio'] : null;

try {
    // Preparar la consulta para obtener los datos del usuario
    $sql_usuario = "SELECT nombre, apellidoPaterno, apellidoMaterno FROM usuarios WHERE ID_usuario = :ID_usuario";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bindParam(':ID_usuario', $ID_usuario);
    $stmt_usuario->execute();
    $usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

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
    <title>Pagos Realizados</title>
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

    <section class="pedidos">
        <h1>Pagos realizados</h1>
        <?php if ($usuario) : ?>
            <p>Cliente: <?php echo htmlspecialchars($ID_usuario); ?></p>
            <p>Nombre: <?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidoPaterno'] . ' ' . $usuario['apellidoMaterno']); ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Título del libro</th>
                        <th>Autor</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pedidos)) : ?>
                        <?php foreach ($pedidos as $pedido) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pedido['folioPedido']); ?></td>
                                <td>
                                    <?php if ($folioParaEditar === $pedido['folioPedido']) : ?>
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                            <input type="hidden" name="folioPedido" value="<?php echo htmlspecialchars($pedido['folioPedido']); ?>">
                                            <input type="hidden" name="ID_usuario" value="<?php echo htmlspecialchars($ID_usuario); ?>">
                                            <input type="text" name="tituloLibro" value="<?php echo htmlspecialchars($pedido['tituloLibro']); ?>">
                                        <?php else : ?>
                                            <?php echo htmlspecialchars($pedido['tituloLibro']); ?>
                                        <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($folioParaEditar === $pedido['folioPedido']) : ?>
                                        <input type="text" name="autor" value="<?php echo htmlspecialchars($pedido['autor']); ?>">
                                    <?php else : ?>
                                        <?php echo htmlspecialchars($pedido['autor']); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($folioParaEditar === $pedido['folioPedido']) : ?>
                                        <input type="text" name="precio" value="<?php echo htmlspecialchars($pedido['precio']); ?>">
                                    <?php else : ?>
                                        <?php echo htmlspecialchars($pedido['precio']); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($folioParaEditar === $pedido['folioPedido']) : ?>
                                        <input type="text" name="fechaPedido" value="<?php echo htmlspecialchars($pedido['fechaPedido']); ?>">
                                    <?php else : ?>
                                        <?php echo htmlspecialchars($pedido['fechaPedido']); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($folioParaEditar === $pedido['folioPedido']) : ?>
                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                        </form>
                                        <a class="btn btn-secondary btn-sm" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?ID_usuario=<?php echo urlencode($ID_usuario); ?>">Cancelar</a>
                                    <?php else : ?>
                                        <!-- Botón  "Editar" -->
                                        <form action="pagos.php" method="GET" style="display:inline;">
                                            <input type="hidden" name="folio" value="<?php echo urlencode($pedido['folioPedido']); ?>">
                                            <input type="hidden" name="ID_usuario" value="<?php echo urlencode($ID_usuario); ?>">
                                            <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                        </form>

                                        <!-- Botón "Borrar" -->
                                        <button class="btn btn-danger btn-sm" onclick="confirmarBorrado('borrarPedido.php?folio=<?php echo urlencode($pedido['folioPedido']); ?>')">Borrar</button>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">No se encontraron pedidos para este usuario.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>


            </table>
        <?php else : ?>
            <p>No se encontró el usuario con ID <?php echo htmlspecialchars($ID_usuario); ?>.</p>
        <?php endif; ?>
    </section>
    <!-- Bootstrap JS (requerido para el menú desplegable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
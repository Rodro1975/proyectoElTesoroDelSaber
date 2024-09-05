<?php
// Incluir el archivo de conexión con PDO
require 'conexion.php';

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión y si tiene un rol asignado
if (!isset($_SESSION['tipoUsuario'])) {
    echo "No has iniciado sesión o no tienes permisos para acceder a esta página.";
    exit;
}

// Verificar si el usuario tiene permisos de tipo PL
if ($_SESSION['tipoUsuario'] !== 'PL') {
    echo "Acceso denegado.";
    exit;
}

// Inicializar variables
$pedido = ['tituloLibro' => '', 'autor' => '', 'precio' => '', 'fechaPedido' => ''];
$folioPedido = '';

// Verificar si se ha enviado el formulario para buscar el pedido
if (isset($_POST['buscar_pedido'])) {
    $folioPedido = $_POST['folioPedido'];

    try {
        // Obtener los datos del pedido
        $sql = "SELECT tituloLibro, autor, precio, fechaPedido FROM pedidos WHERE folioPedido = :folioPedido";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':folioPedido', $folioPedido);
        $stmt->execute();
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pedido) {
            echo "No se encontró el pedido con el folio proporcionado.";
            $pedido = ['tituloLibro' => '', 'autor' => '', 'precio' => '', 'fechaPedido' => ''];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Verificar si se ha enviado el formulario para actualizar el pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_pedido'])) {
    $folioPedido = $_POST['folioPedido'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $fecha = $_POST['fecha'];

    try {
        // Preparar la consulta para actualizar los datos del pedido
        $sql = "UPDATE pedidos SET tituloLibro = :titulo, autor = :autor, precio = :precio, fechaPedido = :fecha WHERE folioPedido = :folioPedido";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':folioPedido', $folioPedido);
        $stmt->execute();

        echo "Pedido actualizado correctamente.";
        // Limpiar los datos del pedido después de actualizar
        $pedido = ['tituloLibro' => '', 'autor' => '', 'precio' => '', 'fechaPedido' => ''];
        $folioPedido = '';
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
    <title>Editar Pedido PL</title>
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

    <section class="form-editar">
        <div class="content">
            <h1>Modificar un pedido</h1>
            <!-- Formulario para buscar el pedido -->
            <?php if (empty($pedido['tituloLibro'])): ?>
                <form class="row" action="" method="POST">
                    <div class="col-12">
                        <label for="folioInput" class="form-label">Número de folio</label>
                        <input type="text" class="form-control" id="folioInput" name="folioPedido" placeholder="Ingresa el folio a modificar" value="<?php echo htmlspecialchars($folioPedido); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="buscar_pedido">Traer la información</button>
                </form>
            <?php endif; ?>

            <!-- Formulario para editar el pedido -->
            <?php if (!empty($pedido['tituloLibro'])): ?>
                <form class="row" action="" method="POST">
                    <input type="hidden" name="folioPedido" value="<?php echo htmlspecialchars($folioPedido); ?>">
                    <div class="col-12">
                        <label for="tituloLibro" class="form-label">Título del libro</label>
                        <input type="text" class="form-control" id="tituloLibro" name="titulo" value="<?php echo htmlspecialchars($pedido['tituloLibro']); ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($pedido['autor']); ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($pedido['precio']); ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="fechaPedido" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fechaPedido" name="fecha" value="<?php echo htmlspecialchars($pedido['fechaPedido']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="actualizar_pedido">Modificar la información</button>
                    <a class="cancelar" href="../php/consultarPL.php">Cancelar</a>
                </form>
            <?php endif; ?>
        </div>
    </section>
    <!-- Bootstrap JS (requerido para el menú desplegable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
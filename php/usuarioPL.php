<?php
session_start();

if (isset($_SESSION['ID_usuario']) && isset($_SESSION['nombre']) && isset($_SESSION['apellidoPaterno']) && isset($_SESSION['apellidoMaterno'])) {
    $ID_usuario = $_SESSION['ID_usuario'];
    $nombre = $_SESSION['nombre'];
    $apellidoPaterno = $_SESSION['apellidoPaterno'];
    $apellidoMaterno = $_SESSION['apellidoMaterno'];
} else {
    header("Location: iniciarSesion.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario PL</title>
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

    <section class="welcome-1">
        <div class="welcome-message">
            <h3 class="mb-4">¡Bienvenido a tu espacio dentro del Tesoro del saber!</h3>
            <h1 class="display-4">
                Usuario: <span class="text-primary"><?php echo htmlspecialchars($ID_usuario); ?></span>
            </h1>
            <h2 class="display-5">
                Nombre:
                <span class="text-success"><?php echo htmlspecialchars($nombre); ?></span>
                <span class="text-success"><?php echo htmlspecialchars($apellidoPaterno); ?></span>
                <span class="text-success"><?php echo htmlspecialchars($apellidoMaterno); ?></span>
            </h2>
        </div>
    </section>
    <!-- Bootstrap JS (requerido para el menú desplegable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
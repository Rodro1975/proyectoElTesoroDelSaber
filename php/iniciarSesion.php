<?php
// Incluir el archivo de conexión con PDO
require 'conexion.php';

session_start(); // Iniciar la sesión

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_usuario = $_POST['ID_usuario'];
    $password = $_POST['password'];

    // Consultar si el usuario existe
    $sql = "SELECT ID_usuario, nombre, apellidoPaterno, apellidoMaterno, tipoUsuario, password 
            FROM USUARIOS WHERE ID_usuario = :ID_usuario";

    try {
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':ID_usuario', $ID_usuario);
        $stmt->execute();

        // Obtener los resultados
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                // Guardar los datos en la sesión
                $_SESSION['ID_usuario'] = $ID_usuario;
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['apellidoPaterno'] = $usuario['apellidoPaterno'];
                $_SESSION['apellidoMaterno'] = $usuario['apellidoMaterno'];
                $_SESSION['tipoUsuario'] = $usuario['tipoUsuario'];

                // Construir el mensaje de bienvenida
                $mensaje = "¡Bienvenido " . $usuario['nombre'] . " " . $usuario['apellidoPaterno'] . " " . $usuario['apellidoMaterno'] . "! ¡Has ingresado como " . $usuario['tipoUsuario'] . "!";

                // Verificar el tipo de usuario y redirigir con JavaScript
                if ($usuario['tipoUsuario'] == 'PL') {
                    echo "<script>alert('$mensaje'); window.location.href = 'usuarioPL.php';</script>";
                } elseif ($usuario['tipoUsuario'] == 'CL') {
                    echo "<script>alert('$mensaje'); window.location.href = 'usuarioCL.php';</script>";
                }
                exit();
            } else {
                // Contraseña incorrecta
                echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
            }
        } else {
            // Usuario no encontrado
            echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
        }
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
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
<header>
        <!-- Barra de navegación fija -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">Librería</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/registrarse.php">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/iniciarSesion.php">Iniciar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="Form-login">
        <form action="iniciarSesion.php" method="POST" class="login-content">
            <h1 class="title">Login</h1>
            <label for=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
             <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
             </svg>
             <input type="text" class="input" id="ID_usuario" name="ID_usuario" placeholder="Usuario">
            </label>
            
            
            <a href="#" class="link">¿Has olvidado tu contraseña?</a>
            <label for=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
             <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
             </svg>
             <input type="password" class="input" id="password" name="password" placeholder="password">
            </label>            
                       
             <a href="#"><button>Inicia Sesión</button></a>

             <a href="../php/registrarse.php" class="link">¿No tienes una cuenta? Registrate</a>
                    
        </form>
        

    </section>

    

    <script src="../js/script.js"></script>

    <!-- Bootstrap JS (requerido para el menú desplegable) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
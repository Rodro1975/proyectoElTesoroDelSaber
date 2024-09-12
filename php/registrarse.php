<?php
// Incluir el archivo de conexión con PDO
require 'conexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si reCAPTCHA ha sido resuelto
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        $secretKey = '6LfEBUEqAAAAAJVXrKSpNY994FtbMtJlw5WYP_Uf'; // Tu clave secreta
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remoteip=$ip");
        $responseKeys = json_decode($response, true);

        if (intval($responseKeys["success"]) !== 1) {
            echo "Validación reCAPTCHA fallida. Inténtalo de nuevo.";
            exit;
        }
    } else {
        echo "Por favor, verifica que no eres un robot.";
        exit;
    }

    // Obtener los datos del formulario
    $ID_usuario = $_POST['ID_usuario'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $tipoUsuario = 'CL'; // Tipo fijo para clientes
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Verificar que las contraseñas coincidan
    if ($password !== $confirmPassword) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insertar los datos en la base de datos usando una sentencia preparada
        $sql = "INSERT INTO USUARIOS (ID_usuario, nombre, apellidoPaterno, apellidoMaterno, edad, sexo, email, telefono, tipoUsuario, password)
                VALUES (:ID_usuario, :nombre, :apellidoPaterno, :apellidoMaterno, :edad, :sexo, :email, :telefono, :tipoUsuario, :password)";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':ID_usuario', $ID_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidoPaterno', $apellidoPaterno);
        $stmt->bindParam(':apellidoMaterno', $apellidoMaterno);
        $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':tipoUsuario', $tipoUsuario);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            // Redirigir a la página de inicio de sesión si la inserción fue exitosa
            header("Location: iniciarSesion.php");
            exit;
        } else {
            echo "Error al registrar usuario.";
        }
    } catch (PDOException $e) {
        echo "Error al registrar usuario: " . $e->getMessage();
    }
}
?>








<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LfEBUEqAAAAAJbbWaz9QcxvcyJsID--UMZurnPy"></script>
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

    <div class="container mt-5 pt-4">
        <form class="row g-3 needs-validation" id="demo-form" action="../php/registrarse.php" method="POST" novalidate>
            <!-- Ajuste de clases para responsive design -->
            <div class="col-12 col-md-6 col-lg-4">
                <label for="IDinput" class="form-label">ID Usuario</label>
                <input type="text" class="form-control" id="IDinput" name="ID_usuario" placeholder="Escribe el número de ID de usuario" required data-bs-toggle="tooltip" data-bs-placement="top" title="Introduce un ID único para tu cuenta">
                <div class="invalid-feedback">Introduce un ID de usuario válido.</div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label for="nombreInput" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreInput" name="nombre" placeholder="Escribe tu nombre" required data-bs-toggle="tooltip" data-bs-placement="top" title="Escribe tu primer nombre">
                <div class="invalid-feedback">Introduce el nombre.</div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label for="apellidoPaternoIn" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellidoPaternoIn" name="apellidoPaterno" placeholder="Escribe tu apellido paterno" required data-bs-toggle="tooltip" data-bs-placement="top" title="Escribe tu primer apellido">
                <div class="invalid-feedback">Introduce el apellido paterno.</div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label for="apellidoMaternoIn" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="apellidoMaternoIn" name="apellidoMaterno" placeholder="Escribe tu apellido materno" required data-bs-toggle="tooltip" data-bs-placement="top" title="Escribe tu segundo apellido">
                <div class="invalid-feedback">Introduce el apellido materno.</div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label for="edadInput" class="form-label">Edad</label>
                <input type="number" class="form-control" id="edadInput" name="edad" placeholder="Escribe tu edad" required data-bs-toggle="tooltip" data-bs-placement="top" title="Introduce tu edad actual utilizando las flechas o escríbela directamente">
                <div class="invalid-feedback">Introduce una edad válida.</div>
            </div>

            <div class="col-12 mb-3">
                <label for="selectSexo" class="form-label">Selecciona tu sexo</label>
                <select class="form-select" id="selectSexo" name="sexo" required data-bs-toggle="tooltip" data-bs-placement="top" title="Selecciona de la lista tu opción deseada">
                    <option value="" selected>Selecciona tu sexo</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Otro">Otro</option>
                    <option value="Prefiero no especificar">Prefiero no especificar</option>
                </select>
                <div class="invalid-feedback">Selecciona una opción.</div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" placeholder="Escribe tu email" required data-bs-toggle="tooltip" data-bs-placement="top" title="Escribe tu correo electrónico: ejemplo@correo.com">
                <div class="invalid-feedback">Introduce un email válido.</div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label for="telefonoInput" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefonoInput" name="telefono" placeholder="Escribe tu teléfono" required data-bs-toggle="tooltip" data-bs-placement="top" title="Ingresa un número telefónico válido">
                <div class="invalid-feedback">Introduce un número de teléfono válido.</div>
            </div>

            <input type="hidden" name="tipoUsuario" value="CL">

            <!-- Campos de contraseña -->
            <div class="col-12">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputPassword" class="col-form-label">Password</label>
                    </div>
                    <div class="col-auto">
                        <input type="password" id="inputPassword" class="form-control" name="password" aria-describedby="passwordHelpInline" required pattern="(?=.*[A-Z])(?=.*\W).{8,20}" data-bs-toggle="tooltip" data-bs-placement="top" title="Longitud mínima de 8 posiciones, con letras y números y por lo menos un carácter especial (#,$,-,_,&,%)">
                        <div class="invalid-feedback">El password debe tener entre 8 y 20 caracteres, incluyendo una letra mayúscula y un carácter especial.</div>
                    </div>
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            El password debería contener entre 8 y 20 caracteres.
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputConfirmPassword" class="col-form-label">Confirma tu Password</label>
                    </div>
                    <div class="col-auto">
                        <input type="password" id="inputConfirmPassword" class="form-control" name="confirmPassword" aria-describedby="confirmPasswordHelpInline" required data-bs-toggle="tooltip" data-bs-placement="top" title="Confirma la contraseña que escribiste">
                        <div class="invalid-feedback">Por favor confirma tu password.</div>
                    </div>
                    <div class="col-auto">
                        <span id="confirmPasswordHelpInline" class="form-text">
                            Por favor confirma tu password.
                        </span>
                    </div>
                </div>
            </div>

            <!-- Botón para enviar -->
            <div class="col-12 d-flex justify-content-between mt-3">
                <a href="../php/iniciarSesion.php" class="btn btn-iniciar">Iniciar Sesión</a>
                <button type="submit" class="g-recaptcha btn btn-registrar"
                    data-sitekey="6LfEBUEqAAAAAJbbWaz9QcxvcyJsID--UMZurnPy"
                    data-callback="onSubmit"
                    data-action="submit">Registrar usuario</button>
            </div>
        </form>
    </div>


    <!-- Bootstrap JS y reCAPTCHA -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        (function() {
            'use strict'

            // Validación del formulario con Bootstrap
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })

            // Función de reCAPTCHA
            grecaptcha.ready(function() {
                document.querySelector('.btn-registrar').addEventListener('click', function(e) {
                    e.preventDefault();
                    grecaptcha.execute();
                });
            });
        })();

        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
</body>

</html>
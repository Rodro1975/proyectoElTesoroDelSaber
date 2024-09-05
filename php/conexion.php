<?php
// Configuración de la conexión a la base de datos local
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_tesoro";

try {
    // Crear una instancia de PDO para la conexión
    $conexion = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conexión exitosa a la base de datos"; // Puedes eliminar esta línea después de verificar la conexión.
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

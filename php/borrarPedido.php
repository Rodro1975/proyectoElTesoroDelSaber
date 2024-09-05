<?php
require 'conexion.php'; // Incluir la conexión con la base de datos

// Obtener el folioPedido desde la solicitud
$folioPedido = $_GET['folio'] ?? null;

if ($folioPedido) {
    try {
        $sql = "DELETE FROM pedidos WHERE folioPedido = :folioPedido";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':folioPedido', $folioPedido);
        $stmt->execute();

        // Responder con JSON para indicar éxito
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Responder con JSON para indicar error
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    // Responder con JSON para indicar error si no se envió el folioPedido
    echo json_encode(['success' => false, 'message' => 'Folio no proporcionado.']);
}

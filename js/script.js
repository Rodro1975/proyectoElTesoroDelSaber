// script.js para el enlace borrar en pagos realizados

function confirmarBorrado(url) {
  if (confirm('¿Estás seguro de que quieres eliminar este pedido?')) {
    // Realizar la solicitud AJAX para borrar el pedido
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Eliminar la fila de la tabla si la eliminación fue exitosa
          const row = document
            .querySelector(
              `a[href="javascript:void(0);"][onclick="confirmarBorrado('${url}')"]`,
            )
            .closest('tr');
          row.remove();
          alert('Pedido eliminado exitosamente.');
        } else {
          alert('Error al eliminar el pedido: ' + data.message);
        }
      })
      .catch((error) => {
        alert('Error en la solicitud: ' + error);
      });
  }
}

//script para enviar mensaje de advertencia en la seccion eliminar
function confirmarEliminacion() {
  return confirm('¿Estás seguro de que deseas borrar este pedido?');
}

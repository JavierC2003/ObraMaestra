<?php
// Conexión a la base de datos
$host = "localhost";
$puerto = 3306;
$usuario = "root";
$contraseña = "";
$basededatos = "tienda_online";

// Crear conexión
$conn = new mysqli($host, $usuario, $contraseña, $basededatos, $puerto);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$pedido_id = htmlspecialchars($_POST['pedido_id']);
$usuario_id = $_POST['usuario_id'];

// Consulta SQL para actualizar el estado del pedido a "cancelado"
$sql_update = "UPDATE Pedidos SET estado = 'cancelado' WHERE pedido_id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("i", $pedido_id);

if ($stmt_update->execute()) {
    echo "<h2>Pedido Cancelado</h2>";
    echo "<p>ID de Pedido: $pedido_id</p>";
    echo "<p>Estado del Pedido: cancelado</p>";

    header("refresh:2;url=index.php?usuario_id=$usuario_id");
} else {
    echo "<p>Error al cancelar el pedido: " . $stmt_update->error . "</p>";
}

// Cerrar la conexión
$stmt_update->close();
$conn->close();
?>

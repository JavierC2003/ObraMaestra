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
$monto = htmlspecialchars($_POST['monto']);
$fecha_pago = htmlspecialchars($_POST['fecha_pago']);
$metodo_pago = htmlspecialchars($_POST['metodo_pago']);
$usuario_id = $_POST['usuario_id'];

// Consulta SQL para insertar el pago en la tabla Pagos
$sql = "INSERT INTO Pagos (pedido_id, monto, fecha_pago, metodo_pago) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("idss", $pedido_id, $monto, $fecha_pago, $metodo_pago);

if ($stmt->execute()) {
    // Actualizar el estado del pedido a 'enviado'
    $sql_update = "UPDATE Pedidos SET estado = 'enviado' WHERE pedido_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("i", $pedido_id);

    if ($stmt_update->execute()) {
        echo "<h2>Pago Procesado y Pedido Actualizado</h2>";
        echo "<p>ID de Pedido: $pedido_id</p>";
        echo "<p>Monto: $$monto</p>";
        echo "<p>Fecha de Pago: $fecha_pago</p>";
        echo "<p>Método de Pago: $metodo_pago</p>";
        echo "<p>Estado del Pedido: enviado</p>";

        // Insertar en la tabla Envíos
        $sql_envio = "INSERT INTO Envíos (pedido_id, fecha_envio, estado_envio) VALUES (?, ?, ?)";
        $stmt_envio = $conn->prepare($sql_envio);
        $estado_envio = 'preparando';
        $stmt_envio->bind_param("iss", $pedido_id, $fecha_pago, $estado_envio);
        
        if ($stmt_envio->execute()) {
            echo "<p>Envío registrado: ID de Pedido $pedido_id, Estado de Envío: $estado_envio</p>";
        } else {
            echo "<p>Error al registrar el envío: " . $stmt_envio->error . "</p>";
        }
        $stmt_envio->close();
    } else {
        echo "<p>Error al actualizar el estado del pedido: " . $stmt_update->error . "</p>";
    }
    $stmt_update->close();

    header("refresh:2;url=index.php?usuario_id=$usuario_id");
} else {
    echo "<p>Error al procesar el pago: " . $stmt->error . "</p>";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
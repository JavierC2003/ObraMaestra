<?php

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
$usuario_id = $_POST['usuario_id'];
$fecha_pedido = $_POST['fecha_pedido'];
$estado = $_POST['estado'];
$total = $_POST['total'];

// Insertar los datos en la tabla Pedidos
$sql = "INSERT INTO Pedidos (usuario_id, fecha_pedido, estado, total) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $usuario_id, $fecha_pedido, $estado, $total);

if ($stmt->execute()) {
    echo "Nuevo pedido creado exitosamente";
    header("refresh:2;url=index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>

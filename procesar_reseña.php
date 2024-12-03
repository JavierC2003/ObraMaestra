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
$producto_id = htmlspecialchars($_POST['producto_id']);
$usuario_id = htmlspecialchars($_POST['usuario_id']);
$calificacion = htmlspecialchars($_POST['calificacion']);
$comentario = htmlspecialchars($_POST['comentario']);
$fecha = htmlspecialchars($_POST['fecha']);

// Consulta SQL para insertar la reseña en la tabla Reseñas
$sql = "INSERT INTO Reseñas (producto_id, usuario_id, calificacion, comentario, fecha) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiss", $producto_id, $usuario_id, $calificacion, $comentario, $fecha);

if ($stmt->execute()) {
    echo "<h2>Reseña Procesada</h2>";
    echo "<p>ID de Producto: $producto_id</p>";
    echo "<p>Calificación: $calificacion</p>";
    echo "<p>Comentario: $comentario</p>";
    echo "<p>Fecha: $fecha</p>";
    header("refresh:2;url=index.php?usuario_id=$usuario_id");
} else {
    echo "<p>Error al procesar la reseña: " . $stmt->error . "</p>";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

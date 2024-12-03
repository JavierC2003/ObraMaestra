<?php
$host = "localhost";
$puerto = 3306;
$usuario = "root";
$contraseña = "";
$basededatos = "tienda_online";

// Crear conexión
$conn = new mysqli($host, $usuario, $contraseña, $basededatos, $puerto);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el id del producto desde la URL
$producto_id = isset($_GET['producto_id']) ? (int)$_GET['producto_id'] : 0;

if ($producto_id === 0) {
    die("ID de producto inválido");
}

// Consulta para obtener las reseñas del producto
$sql = "SELECT calificacion, comentario, fecha FROM Reseñas WHERE producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$result = $stmt->get_result();

$reseñas = [];
if ($result->num_rows > 0) {
    // Asignar los datos a un array
    while ($row = $result->fetch_assoc()) {
        $reseñas[] = $row;
    }
} else {
    die("No se encontraron reseñas para ese producto");
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas del Producto</title>
    <link rel="stylesheet" href="diseño.css">
</head>
<body>
    <div class="container">
        <h2>Reseñas del Producto</h2>
        <?php if (!empty($reseñas)): ?>
            <?php foreach ($reseñas as $reseña): ?>
                <div class="reseña">
                    <h3>Calificación: <?php echo htmlspecialchars($reseña['calificacion']); ?>/5</h3>
                    <p><?php echo nl2br(htmlspecialchars($reseña['comentario'])); ?></p>
                    <div class="fecha"><?php echo htmlspecialchars($reseña['fecha']); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay reseñas para este producto.</p>
        <?php endif; ?>
    </div>
</body>
</html>


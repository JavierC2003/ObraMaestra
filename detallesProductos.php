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

// Consulta para obtener los detalles del producto
$sql = "SELECT nombre, descripcion, especificaciones, precio, imagen_url, stock FROM Productos WHERE producto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Asignar los datos a variables
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $especificaciones = $row['especificaciones'];
    $precio = $row['precio'];
    $imagen_url = $row['imagen_url'];
    $stock = $row['stock'];
} else {
    die("No se encontraron productos con ese ID");
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
    <title>Detalle del Producto</title>
    <link rel="stylesheet" href="diseño.css">
</head>
<body>
    <div class="container">
        <div class="producto">
            <img src="<?php echo htmlspecialchars($imagen_url); ?>" alt="<?php echo htmlspecialchars($nombre); ?>">
            <h3><?php echo htmlspecialchars($nombre); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($descripcion)); ?></p>
            <p><?php echo nl2br(htmlspecialchars($especificaciones)); ?></p>
            <div class="precio">$<?php echo htmlspecialchars($precio); ?></div>
        </div>
    </div>
</body>
</html>

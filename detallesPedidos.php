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
$detalle_id = isset($_GET['detalle_id']) ? (int)$_GET['detalle_id'] : 0;
$usuario_id=$_GET['usuario_id'];

if ($detalle_id === 0) {
    die("ID de pedido inválido");
}

// Consulta SQL para obtener los detalles del pedido y la información del producto
$sql = "
    SELECT dp.detalle_id, dp.producto_id, dp.cantidad AS cantidad_detalle, dp.total,
           pr.nombre AS nombre_producto, pr.descripcion AS descripcion_producto, pr.especificaciones, pr.precio, pr.imagen_url
    FROM Detalles_Pedido dp
    JOIN Productos pr ON dp.producto_id = pr.producto_id
    WHERE dp.detalle_id=$detalle_id
";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $detalles = [];
    while ($fila = $resultado->fetch_assoc()) {
        $detalles[] = $fila;
    }
} else {
    echo "No se encontraron detalles de pedidos.";
    exit;
}
?>
    <?php foreach ($detalles as $detalle): ?>
        <div class="detalle">
            <h3>ID DETALLE: <?php echo htmlspecialchars($detalle['detalle_id']); ?></h3>
            <form>
                <input type="hidden" name="detalle_id" value="<?php echo htmlspecialchars($detalle['detalle_id']); ?>">
                <p>Nombre del Producto: <input type="text" name="nombre_producto" value="<?php echo htmlspecialchars($detalle['nombre_producto']); ?>" disabled readonly> 
                Descripción: <textarea name="descripcion_producto" disabled><?php echo htmlspecialchars($detalle['descripcion_producto']); ?></textarea>
                Especificaciones: <textarea name="especificaciones" disabled><?php echo htmlspecialchars($detalle['especificaciones']); ?></textarea>
                Precio: <input type="number" name="precio" value="<?php echo htmlspecialchars($detalle['precio']); ?>" disabled step="0.01">
                Cantidad: <input type="number" name="cantidad_detalle" value="<?php echo htmlspecialchars($detalle['cantidad_detalle']); ?>" disabled>
                Total: <input type="number" name="total" value="<?php echo htmlspecialchars($detalle['total']); ?>" step="0.01" disabled></p>
                <img src="<?php echo htmlspecialchars($detalle['imagen_url']); ?>" alt="<?php echo htmlspecialchars($detalle['nombre_producto']); ?>">
            </form>
        </div>
<?php endforeach; ?>

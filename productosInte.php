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

    // Preparar la consulta SQL
    $sql = "SELECT producto_id, nombre, descripcion, especificaciones, precio, imagen_url 
            FROM productos";

    // Preparar la declaración
    $stmt = $conn->prepare($sql); 
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si se encontró el paciente
    if ($result->num_rows > 0) {
        $productos = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $productos = [];
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();

?>
<?php if (count($productos) > 0): ?>
    <?php foreach ($productos as $productos): ?>
        <div class="producto">
            <a href="formularioPedido.php?producto_id=<?php echo $productos['producto_id']; ?>">
                <img src="<?php echo htmlspecialchars($productos['imagen_url']); ?>" alt="<?php echo htmlspecialchars($productos['nombre']); ?>">
            </a>
            <h3><?php echo htmlspecialchars($productos['nombre']); ?></h3>
            <aside>
                Medida Nominal: <?php echo htmlspecialchars($productos['descripcion']); ?><br>
                Medida Específica: <?php echo htmlspecialchars($productos['especificaciones']); ?><br>
                Precio: <?php echo htmlspecialchars($productos['precio']); ?>.
            </aside>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron productos.</p>
<?php endif; ?>

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
// Consulta SQL para seleccionar los datos del usuario
$sql = "SELECT usuario_id, nombre, email, contraseña, direccion, telefono, tipo_usuario FROM Usuarios WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

// Asignar los datos del usuario a variables
if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $usuario_id = $usuario['usuario_id'];
    $nombre = $usuario['nombre'];
    $email = $usuario['email'];
    $contraseña = $usuario['contraseña'];
    $direccion = $usuario['direccion'];
    $telefono = $usuario['telefono'];
    $tipo_usuario = $usuario['tipo_usuario'];
} else {
    echo "No se encontró ningún usuario con el ID especificado.";
    exit;
}

$stmt->close();
$conn->close();
?>

<section class="usuario">
    <h2>Editar Información del Usuario</h2>
    <form action="editarUsuario.php" method="post">
        <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
        <label for="nombre">ID:</label>
        <input type="text" id="x" name="x" value="<?php echo $usuario_id; ?>" disabled>
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" value="<?php echo htmlspecialchars($contraseña); ?>" required>
        <br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>">
        <br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>">
        <br>

        
        <input type="hidden" name="tipo_usuario" value="<?php echo $tipo_usuario; ?>">
        <label for="tipo_usuario">Tipo de Usuario:</label>
        <select id="tipo_usuario" name="tipo_usuario" disabled>
            <option value="cliente" <?php echo ($tipo_usuario == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
            <option value="administrador" <?php echo ($tipo_usuario == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
        </select>
        <br>

        <input type="submit" value="Guardar Cambios">
    </form>
</section>
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

// Consulta SQL para obtener los pedidos, sus detalles y la información del producto
$sql = "
    SELECT p.pedido_id, p.usuario_id, p.fecha_pedido, p.estado, p.cantidad AS cantidad_pedido,
           dp.detalle_id, dp.producto_id, dp.cantidad AS cantidad_detalle, dp.total,
           pr.nombre AS nombre_producto, pr.descripcion AS descripcion_producto, pr.especificaciones, pr.precio, pr.imagen_url
    FROM Pedidos p
    JOIN Detalles_Pedido dp ON p.pedido_id = dp.pedido_id
    JOIN Productos pr ON dp.producto_id = pr.producto_id
    WHERE p.usuario_id = $usuario_id
";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Crear un array para almacenar los pedidos y sus detalles
    $pedidos = [];
    
    while ($fila = $resultado->fetch_assoc()) {
        $pedido_id = $fila['pedido_id'];
        if (!isset($pedidos[$pedido_id])) {
            $pedidos[$pedido_id] = [
                'pedido_id' => $pedido_id,
                'usuario_id' => $fila['usuario_id'],
                'fecha_pedido' => $fila['fecha_pedido'],
                'estado' => $fila['estado'],
                'cantidad_pedido' => $fila['cantidad_pedido'],
                'detalles' => []
            ];
        }
        
        $pedidos[$pedido_id]['detalles'][] = [
            'detalle_id' => $fila['detalle_id'],
            'producto_id' => $fila['producto_id'],
            'nombre_producto' => $fila['nombre_producto'],
            'descripcion_producto' => $fila['descripcion_producto'],
            'especificaciones' => $fila['especificaciones'],
            'precio' => $fila['precio'],
            'imagen_url' => $fila['imagen_url'],
            'cantidad' => $fila['cantidad_detalle'],
            'total' => $fila['total']
        ];
    }
} else {
    echo "No se encontraron pedidos.";
    exit;
}

$conn->close();
?>

<section class="pedidos">
    <h2>Lista de Pedidos</h2>
    <div class="pedidos-contenedor">
        <?php foreach ($pedidos as $pedido): ?>
            <div class="pedido">
                <h3>Pedido ID: <?php echo $pedido['pedido_id']; ?></h3>
                <p>Fecha del Pedido: <?php echo $pedido['fecha_pedido']; ?></p>
                <p>Estado: <?php echo $pedido['estado']; ?></p>
                <p>Cantidad Total: <?php echo $pedido['cantidad_pedido']; ?></p>
                
                <h4>Detalles del Pedido:</h4>
                <ul>
                    <?php foreach ($pedido['detalles'] as $detalle): ?>
                        <li>
                            <p><strong>Producto:</strong> <?php echo htmlspecialchars($detalle['nombre_producto']); ?></p>
                            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($detalle['descripcion_producto']); ?></p>
                            <p><strong>Especificaciones:</strong> <?php echo htmlspecialchars($detalle['especificaciones']); ?></p>
                            <p><strong>Precio:</strong> <?php echo htmlspecialchars($detalle['precio']); ?></p>
                            <p><strong>Cantidad:</strong> <?php echo htmlspecialchars($detalle['cantidad']); ?></p>
                            <p><strong>Total:</strong> <?php echo htmlspecialchars($detalle['total']); ?></p>
                            <img src="<?php echo htmlspecialchars($detalle['imagen_url']); ?>" alt="<?php echo htmlspecialchars($detalle['nombre_producto']); ?>">
                            
                            <?php if ($pedido['estado'] == 'pendiente'): ?>
                                <form action="index.php" method="get" style="display: inline;">
                                    <input type="hidden" name="content" value="pago">
                                    <input type="hidden" name="usuario_id" value="<?php echo $usuario_id?>">
                                    <input type="hidden" name="detalle_id" value="<?php echo $detalle['detalle_id']?>">
                                    <button type="submit" class="btn btn-primary">PAGAR</button>
                                </form>
                                <form action="cancelar_pedido.php" method="post" style="display: inline;">
                                    <input type="hidden" name="pedido_id" value="<?php echo $pedido['pedido_id']; ?>">
                                    <input type="hidden" name="usuario_id" value="<?php echo $usuario_id?>">
                                    <input type="hidden" name="producto_id" value="<?php echo $detalle['producto_id']?>">
                                    <button type="submit" class="btn btn-danger">CANCELAR</button>
                                </form>

                            <?php endif; ?>

                            <?php if ($pedido['estado'] == 'enviado'): ?>
                                <form action="index.php" method="get" style="display: inline;">
                                    <input type="hidden" name="content" value="reseña">
                                    <input type="hidden" name="usuario_id" value="<?php echo $usuario_id?>">
                                    <input type="hidden" name="producto_id" value="<?php echo $detalle['producto_id']?>">
                                    <button type="submit" class="btn btn-success">PUNTUAR</button>
                                </form>
                            <?php endif; ?>
                            
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</section>
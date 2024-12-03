<?php
    function obtenerUltimoPedidoId($conexion) {
        $sql = "SELECT pedido_id FROM Pedidos ORDER BY pedido_id DESC LIMIT 1";
        $resultado = $conexion->query($sql);
        
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['pedido_id'];
        } else {
            return null; // O algún valor por defecto si no hay pedidos
        }
    }
    function obtenerPrecio($conexion, $producto_id) {
        $sql = "SELECT precio FROM productos where producto_id=$producto_id";
        $resultado = $conexion->query($sql);
        
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['precio'];
        } else {
            return null; // O algún valor por defecto si no hay pedidos
        }
    }
    
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
    $cantidad = $_POST['cantidad'];

    // Insertar los datos en la tabla Pedidos
    $sql = "INSERT INTO Pedidos (usuario_id, fecha_pedido, estado, cantidad) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $usuario_id, $fecha_pedido, $estado, $cantidad);

    if ($stmt->execute()) {
        echo "Nuevo pedido creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Obtener los datos del formulario
    $pedido_id = obtenerUltimoPedidoId($conn);
    $producto_id = $_POST['producto_id'];
    $estado = $_POST['estado'];
    $precio = obtenerPrecio($conn, $producto_id);
    $total = $cantidad * $precio;
    // Insertar los datos en la tabla Pedidos
    $sql = "INSERT INTO Detalles_Pedido (pedido_id, producto_id, cantidad, total)VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $pedido_id, $producto_id, $cantidad, $total);

    if ($stmt->execute()) {
        echo "Nuevo pedido creado exitosamente";
        header("refresh:2;url=index.php?usuario_id=$usuario_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
?>

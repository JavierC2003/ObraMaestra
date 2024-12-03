<?php
$nombre_Usuario = $_POST['nombre_Usuario'];
$password_Usuario = $_POST['password_Usuario'];

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

// Preparar la consulta SQL para obtener el hash de la contraseña
$sql = "SELECT usuario_id, nombre, contraseña FROM Usuarios WHERE nombre=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $nombre_Usuario); 
$stmt->execute();

// Obtener el resultado
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Obtener el hash de la contraseña almacenada
    $row = $result->fetch_assoc();
    $hash_contraseña = $row['contraseña'];
    $usuario_id=$row['usuario_id'];
    // Verificar la contraseña ingresada con el hash almacenado
    if (($password_Usuario==$hash_contraseña)) {
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($row['nombre']) . "!";
        header("refresh:2;url=index.php?usuario_id=$usuario_id");
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta.";
    }
} else {
    // Usuario no encontrado
    echo "Usuario no encontrado.";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario_id = $_POST['usuario_id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Sanitizar datos para prevenir inyecciones SQL
    $usuario_id = $conn->real_escape_string($usuario_id);
    $nombre = $conn->real_escape_string($nombre);
    $email = $conn->real_escape_string($email);
    $contraseña = $conn->real_escape_string($contraseña);
    $direccion = $conn->real_escape_string($direccion);
    $telefono = $conn->real_escape_string($telefono);
    $tipo_usuario = $conn->real_escape_string($tipo_usuario);

    // Consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE Usuarios SET 
            nombre = '$nombre',
            email = '$email',
            contraseña = '$contraseña',
            direccion = '$direccion',
            telefono = '$telefono',
            tipo_usuario = '$tipo_usuario'
            WHERE usuario_id = $usuario_id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Los datos del usuario se actualizaron correctamente.";
        header("refresh:2;url=index.php?content=usuario");
    } else {
        echo "Error actualizando los datos: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>

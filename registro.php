<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Registrarse</h2>
            </div>
            <div class="card-body">
                <form action="registro.php" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña:</label>
                        <input type="password" id="contraseña" name="contraseña" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control">
                    </div>
                    <input type="hidden" name="tipo_usuario" value="cliente">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </form>
                <div class="mt-3">
                    <a href="index.php" class="btn btn-link">¿Ya tienes una cuenta? Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $nombre = htmlspecialchars($_POST['nombre']);
        $email = htmlspecialchars($_POST['email']);
        $contraseña = htmlspecialchars($_POST['contraseña']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $tipo_usuario = htmlspecialchars($_POST['tipo_usuario']);

        // Consulta SQL para insertar el nuevo usuario
        $sql = "INSERT INTO Usuarios (nombre, email, contraseña, direccion, telefono, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nombre, $email, $contraseña, $direccion, $telefono, $tipo_usuario);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Registro exitoso. <a href='index.php'>Iniciar sesión</a></div>";
            header("refresh:2;url=login.html");
        } else {
            echo "<div class='alert alert-danger mt-3'>Error al registrar el usuario: " . $stmt->error . "</div>";
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>

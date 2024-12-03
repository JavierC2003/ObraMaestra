<?php
// Asegúrate de que el valor 'producto_id' esté presente en la URL
if (isset($_GET['producto_id'])) {
    $producto_id = htmlspecialchars($_GET['producto_id']);
} else {
    // Maneja el caso donde 'producto_id' no está presente
    $producto_id = "";
}

$usuario_id=$_GET['usuario_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion y Pedido</title>
    <link rel="stylesheet" href="diseño.css">
    <style>
        main {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Cambia la dirección del flex a columna */
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .tabla1 {
            width: 100%;
            max-width: 1200px;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        tr.titulos {
            background-color: #e60000;
            color: #fff;
        }

        th.titulo {
            padding: 20px;
            text-align: center;
        }

        tr.contenido td {
            padding: 20px;
            vertical-align: top;
            border-bottom: 1px solid #ddd;
        }

        td.detalles,
        td.form {
            width: 50%;
        }

        div.producto {
            text-align: center;
            padding: 20px;
        }

        div.producto img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        div.producto h3 {
            font-size: 1.8em;
            margin: 10px 0;
            color: #333;
        }

        div.producto p {
            font-size: 1.1em;
            color: #555;
        }

        div.producto .precio {
            font-size: 1.5em;
            color: #e60000;
            margin: 15px 0;
        }

        .boton-comprar {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.2em;
            color: #fff;
            background-color: #e60000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .boton-comprar:hover {
            background-color: #c40000;
        }

        form.formulario1 {
            max-width: 500px;
            margin: 0 auto;
            text-align: left;
        }

        form.formulario1 label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        form.formulario1 input,
        form.formulario1 select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form.formulario1 input[type="submit"] {
            background-color: #e60000;
            color: #fff;
            border: none;
            cursor: pointer;
            width: auto;
            padding: 10px 20px;
            font-size: 1em;
        }

        form.formulario1 input[type="submit"]:hover {
            background-color: #c40000;
        }

    </style>
</head>
<header>
    <h1>Obra Maestra</h1>
    <div class="carrito">
        <a href="index.php?content=usuario&usuario_id=<?php echo $usuario_id?>"><img src="imagenes/usuario.png" alt="usuario"></a>
    </div>
    <div class="logo">
        <img src="logotipo.webp" alt="logotipo">
    </div>
    <div class="barra">
                <div>
                    <a href="index.php?usuario_id=<?php echo $usuario_id?>">INICIO</a>
                    <p>Página principal</p>
                </div>

                <div>
                    <a href="index.php?content=empresa&usuario_id=<?php echo $usuario_id?>">EMPRESA</a>
                    <p>Sobre nosotros</p>
                </div>
                
                <div>
                    <a href="index.php?content=vivienda&usuario_id=<?php echo $usuario_id?>">VIVIENDA</a>
                    <p>Blocks para construcción</p>
                </div>
                
                <div>
                    <a href="index.php?content=bardacreto&usuario_id=<?php echo $usuario_id?>">BARDACRETO</a>
                    <p>Blocks decorativos</p>
                </div>
                
                <div>
                    <a href="index.php?content=techocreto&usuario_id=<?php echo $usuario_id?>">TECHOCRETO</a>
                    <p>Viga y bovedilla</p>
                </div>
                
                <div>
                    <a href="index.php?content=adoquines&usuario_id=<?php echo $usuario_id?>">ADOQUINES</a>
                    <p>Pavimentos</p>
                </div>
                
                <div>
                    <a href="index.php?content=patiocreto&usuario_id=<?php echo $usuario_id?>">PATIOCRETO</a>
                    <p>Accesorios para jardín</p>
                </div>
        </div>
</header>
<body>
<main>
    <table class="tabla1">
        <tr class="titulos">
            <th class="titulo"><h2>informacion del producto</h2></th>
            <th class="titulo"><h2>Crear Nuevo Pedido</h2></th>
        </tr>
        <tr class="contenido">
            <td class="detalles"><?php include 'detallesProductos.php'; ?></td>
            <td class="form">
                <form class="formulario1" action="insertarPedido.php" method="post">
                    <input type="hidden" name="producto_id" value="<?php echo $producto_id?>">
                    <input type="hidden" name="usuario_id" value="<?php echo $usuario_id?>">
                    <label for="usuario_id">ID de Usuario:</label>
                    <input type="number" id="x" name="x" value="<?php echo $usuario_id?>" disabled><br>

                    <label for="fecha_pedido">Fecha del Pedido:</label>
                    <input type="datetime-local" id="fecha_pedido" name="fecha_pedido" required><br>

                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" required>
                        <option value="pendiente">Pendiente</option>
                    </select><br>

                    <label for="cantidad">Cantidad de piezas:</label>
                    <input type="number" id="cantidad" name="cantidad" required><br>

                    <input type="submit" value="Crear Pedido">
                </form>
            </td>
        </tr>
    </table>
    <br>
    <table class="tabla1">
        <tr class="titulos">
            <th class="titulo"><h2>Reseñas del producto</h2></th>
        </tr>
        <tr class="contenido">
            <td class="reseñas"><?php include 'rereseñas.php'; ?></td>
        </tr>
    </table>
</main>
</body>
</html>
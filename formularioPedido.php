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
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        table.tabla1 {
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
        <a href="#"><img src="imagenes/carrito.png" alt="Carrito de compra"></a>
    </div>
    <div class="logo">
        <img src="logotipo.webp" alt="logotipo">
    </div>
    <div class="barra">
                <div>
                    <a href="#">INICIO</a>
                    <p>Página principal</p>
                </div>

                <div>
                    <a href="#">EMPRESA</a>
                    <p>Sobre nosotros</p>
                </div>
                
                <div>
                    <a href="#">VIVIENDA</a>
                    <p>Blocks para construcción</p>
                </div>
                
                <div>
                    <a href="#">BARDACRETO</a>
                    <p>Blocks decorativos</p>
                </div>
                
                <div>
                    <a href="#">TECHOCRETO</a>
                    <p>Viga y bovedilla</p>
                </div>
                
                <div>
                    <a href="#">ADOQUINES</a>
                    <p>Pavimentos</p>
                </div>
                
                <div>
                    <a href="#">PATIOCRETO</a>
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
                    <label for="usuario_id">ID de Usuario:</label>
                    <input type="number" id="usuario_id" name="usuario_id" required><br>

                    <label for="fecha_pedido">Fecha del Pedido:</label>
                    <input type="datetime-local" id="fecha_pedido" name="fecha_pedido" required><br>

                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" required>
                        <option value="pendiente">Pendiente</option>
                    </select><br>

                    <label for="total">Total:</label>
                    <input type="number" id="total" name="total" step="0.01" required><br>

                    <input type="submit" value="Crear Pedido">
                </form>
            </td>
        </tr>
    </table>
</main>
</body>
</html>
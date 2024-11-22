<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="logotipo.webp" type="image/x-icon">
    <link rel="shortcut icon" href="logotipo.webp" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obra Maestra: Tienda de Materiales</title>
    <link rel="stylesheet" href="diseño.css">
</head>
<body>
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
    <main>
        <section class="hero">
            <h2>Bienvenido a la mejor tienda de materiales</h2>
            <aside>Encuentra todo lo que necesitas para tus proyectos</aside>
        </section>
        <section class="Productos_Destacados">
            <h2><br><br><br>Productos Destacados</h2>
            <?php include 'productosDesta.php'; ?>
        </section>
        <section class="Productos_De_Interes">
            <h2><br><br><br>Productos De Interes</h2>
            <?php include 'productosInte.php'; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Obra Maestra. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
<?php 
    $usuario_id=$_GET['usuario_id'];
?>
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
            <a href="index.php?content=usuario&usuario_id=<?php echo $usuario_id?>"><img src="imagenes/usuario.png" alt="usuario"></a>
        </div>
        <div class="logo">
            <img src="logotipo.webp" alt="logotipo">
        </div>
        <form method="post">
        <section class="barra">
                <div>
                    <a href="index.php?usuario_id=<?php echo $usuario_id?>">INICIO</a>
                    <p>Página principal</p>
                </div>

                <div>
                    <button class="boton" type="submit" name="content" value="empresa">EMPRESA</button>
                    <p>Sobre nosotros</p>
                </div>
                
                <div>
                    <button class="boton" type="submit" name="content" value="vivienda">VIVIENDA</button>
                    <p>Blocks para construcción</p>
                </div>
                
                <div>
                    <button class="boton" type="submit" name="content" value="bardacreto">BARDACRETO</button>
                    <p>Blocks decorativos</p>
                </div>
                
                <div>
                    <button class="boton" type="submit" name="content" value="techocreto">TECHOCRETO</button>
                    <p>Viga y bovedilla</p>
                </div>
                
                <div>
                    <button class="boton" type="submit" name="content" value="adoquines">ADOQUINES</button>
                    <p>Pavimentos</p>
                </div>
                
                <div>
                    <button class="boton" type="submit" name="content" value="patiocreto">PATIOCRETO</button>
                    <p>Accesorios para jardín</p>
                </div>
        </section>
        </form>
    </header>
    <main>
        <?php
            $categoria_id=0;
            if (isset($_POST['content'])) {
                $content = $_POST['content'];
            } 
            else{
                if (isset($_GET['content'])) {
                    $content = $_GET['content'];
                }else {
                    $content = 'productos';
                }
            } 
            
            if ($content == 'empresa') {
                $usuario_id=$_GET['usuario_id'];
                include 'empresa.php';
            } elseif ($content == 'vivienda') {
                $usuario_id=$_GET['usuario_id'];
                include 'vivienda.php';
            } elseif ($content == 'bardacreto') {
                $usuario_id=$_GET['usuario_id'];
                include 'bardacreto.php';
            } elseif ($content == 'techocreto') {
                $usuario_id=$_GET['usuario_id'];
                include 'techocreto.php';
            } elseif ($content == 'adoquines') {
                $usuario_id=$_GET['usuario_id'];
                include 'adoquines.php';
            } elseif ($content == 'patiocreto') {
                $usuario_id=$_GET['usuario_id'];
                include 'patiocreto.php';
            } elseif ($content == 'usuario') {
                $usuario_id=$_GET['usuario_id'];
                include "usuario.php";
            } elseif ($content == 'pago') {
                $usuario_id=$_GET['usuario_id'];
                include "pago.php";
            } elseif ($content == 'reseña') {
                $usuario_id=$_GET['usuario_id'];
                include "reseña.php";
            }
            else {
                $usuario_id=$_GET['usuario_id'];
                include "productos.php"; // Cargar por defecto
            }
        ?>
        <p class="categorias">Nuestros productos cumplen con las normas internacionales de la ASTM (American Society for Testing and Materials, "Sociedad Americana de Ensayos y Materiales") por lo que usted puede confiar en la homogeneidad de medidas y resistencia desde el primer block hasta el último.</p>
        <section class="container">
            <div class="product">
                <img src="imagenes/vivienda.jpg" alt="Vivienda">
                <div class="product-title1">VIVIENDA<br>Blocks para construcción</div>
                <div class="product-description">Blocks de concreto con diferentes medidas y piezas especiales que te convencerán de que son la mejor opción para la construcción.</div>
                <a href="index.php?content=vivienda&usuario_id=<?php echo $usuario_id?>" class="product-button">VER PRODUCTOS &gt;&gt;</a>
            </div>
            <div class="product">
                <img src="imagenes/bardacreto.jpg" alt="Bardacreto">
                <div class="product-title2">BARDACRETO<br>Blocks decorativos</div>
                <div class="product-description">Blocks decorativos, columnas y remates que permiten crear bardas de gran realce, de menor costo de obra terminada y mantenimiento.</div>
                <a href="index.php?content=bardacreto&usuario_id=<?php echo $usuario_id?>" class="product-button">VER PRODUCTOS &gt;&gt;</a>
            </div>
            <div class="product">
                <img src="imagenes/techocreto.jpg" alt="Techocreto">
                <div class="product-title3">TECHOCRETO<br>Viga y bovedilla</div>
                <div class="product-description">Vigas híbridas con armadura de refuerzo y alambre de presfuerzo que retoma lo mejor del sistema de vigueta-bovedilla-dovela.</div>
                <a href="index.php?content=techocreto&usuario_id=<?php echo $usuario_id?>" class="product-button">VER PRODUCTOS &gt;&gt;</a>
            </div>
        </section>
        <section class="container">
            <div class="product">
                <img src="imagenes/adoquines.jpg" alt="Adoquines">
                <div class="product-title4">ADOQUINES<br>El pavimento bioclimático</div>
                <div class="product-description">Adoquines de concreto que se unen a base de ensamble milimétrico, resultando en un recubrimiento ecológico y de alta calidad.</div>
                <a href="index.php?content=adoquines&usuario_id=<?php echo $usuario_id?>" class="product-button">VER PRODUCTOS &gt;&gt;</a>
            </div>
            <div class="product">
                <img src="imagenes/patiocreto.jpg" alt="Patiocreto">
                <div class="product-title5">PATIOCRETO<br>Accesorios para jardín</div>
                <div class="product-description">Con nuestros accesorios para jardín construya ese espacio excepcional y único con el que siempre soñó. Personaliza tus patios.</div>
                <a href="index.php?content=patiocreto&usuario_id=<?php echo $usuario_id?>" class="product-button">VER PRODUCTOS &gt;&gt;</a>
            </div>
        </section>
    </main>
    <br><br><br><br><br><br>
    <footer>
        <p>&copy; 2024 Obra Maestra. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
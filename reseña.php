<?php
$producto_id=$_GET['producto_id'];
$usuario_id=$_GET['usuario_id'];
?>
<section class="detallitos">    
    <h2>informacion del pedido</h2><br>
    <div class="detalles-contenedor">
        <?php include 'detallesProductos.php'; ?>
        <div class="detalle">
            <form action="procesar_reseña.php" method="post">
                <input type="hidden" id="producto_id" name="producto_id" value="<?php echo $producto_id?>">
                <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $usuario_id?>">
                <label for="pedido_id">ID del Producto:</label>
                <input type="number" id="x" name="x" value="<?php echo $producto_id ?>" disabled required><br><br>

                <label for="calificacion">Calificacion:</label>
                <input type="number" id="calificacion" name="calificacion" step="1" required><br><br>

                <label for="comentario">Comentario:</label>
                <input type="text" id="comentario" name="comentario" required><br><br>

                <label for="fecha">Fecha:</label>
                <input type="datetime-local" id="fecha" name="fecha" required><br><br>

                <input type="submit" value="PUNTUAR">
            </form>
        </div>
    </div>
</section>
<section class="detallitos">    
    <h2>informacion del pedido</h2><br>
    <div class="detalles-contenedor">
        <?php include 'detallesPedidos.php'; ?>
        <div class="detalle">
            <form action="procesar_pago.php" method="post">
                <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $usuario_id?>">
                <label for="pedido_id">ID de Pedido:</label>
                <input type="hidden" id="pedido_id" name="pedido_id" value="<?php echo htmlspecialchars($detalle['detalle_id']); ?>">
                <input type="number" id="x" name="x" value="<?php echo htmlspecialchars($detalle['detalle_id']); ?>" disabled required><br><br>

                <label for="monto">Monto:</label>
                <input type="hidden" id="monto" name="monto" value="<?php echo htmlspecialchars($detalle['total']); ?>">
                <input type="number" id="z" name="z" value="<?php echo htmlspecialchars($detalle['total']); ?>" step="0.01" disabled required><br><br>

                <label for="fecha_pago">Fecha de Pago:</label>
                <input type="datetime-local" id="fecha_pago" name="fecha_pago" required><br><br>

                <label for="metodo_pago">Método de Pago:</label>
                <select id="metodo_pago" name="metodo_pago" required>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="PayPal">PayPal</option>
                    <option value="transferencia">Transferencia</option>
                </select><br><br>

                <input type="submit" value="Realizar Pago">
            </form>
        </div>
    </div>
</section>
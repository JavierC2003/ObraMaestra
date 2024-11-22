CREATE DATABASE tienda_online;

USE tienda_online;

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    tipo_usuario ENUM('cliente', 'administrador') NOT NULL
);

-- Tabla de Categorías
CREATE TABLE Categorias (
    categoria_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Tabla de Productos
CREATE TABLE Productos (
    producto_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    especificaciones TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen_url VARCHAR(255),
    stock INT NOT NULL,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES Categorias(categoria_id)
);

-- Tabla de Pedidos
CREATE TABLE Pedidos (
    pedido_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    fecha_pedido DATETIME NOT NULL,
    estado ENUM('pendiente', 'enviado', 'entregado', 'cancelado') NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

-- Tabla de Detalles de Pedido
CREATE TABLE Detalles_Pedido (
    detalle_id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    producto_id INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id),
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id)
);

-- Tabla de Pagos
CREATE TABLE Pagos (
    pago_id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    monto DECIMAL(10, 2) NOT NULL,
    fecha_pago DATETIME NOT NULL,
    metodo_pago ENUM('tarjeta', 'PayPal', 'transferencia') NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id)
);

-- Tabla de Reseñas
CREATE TABLE Reseñas (
    reseña_id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    usuario_id INT,
    calificacion INT NOT NULL,
    comentario TEXT,
    fecha DATETIME NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

-- Tabla de Inventario
CREATE TABLE Inventario (
    inventario_id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    cantidad INT NOT NULL,
    fecha_actualizacion DATETIME NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id)
);

-- Tabla de Promociones
CREATE TABLE Promociones (
    promocion_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    descuento DECIMAL(5, 2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL
);

-- Tabla de Historial de Compras
CREATE TABLE Historial_Compras (
    historial_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    producto_id INT,
    fecha_compra DATETIME NOT NULL,
    cantidad INT NOT NULL,
    precio_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id),
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id)
);

-- Tabla de Envíos
CREATE TABLE Envíos (
    envio_id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    fecha_envio DATETIME NOT NULL,
    estado_envio VARCHAR(50) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id)
);

-- Tabla de Carrito de Compra
CREATE TABLE Carrito (
    carrito_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    producto_id INT,
    cantidad INT NOT NULL,
    fecha_agregado DATETIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id),
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id)
);
/*------insertciones--------*/
INSERT INTO Usuarios (nombre, email, contraseña, direccion, telefono, tipo_usuario)
VALUES ('Javier Cazarez', 'Javier.Cazarez@example.com', '123456', 'Calle Falsa 123', '555-1234', 'cliente');

INSERT INTO Categorias (nombre, descripcion)
VALUES ('Vivienda', 'Blocks de concreto con diferentes medidas y piezas especiales que te convencerán de que son la mejor opción para la construcción.');

INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Block de 10 entero', '10 x 20 x 40 cm.', '9.20 x 19.37 x 39.70 cm.', 14.79, 'imagenes/block10_entero.png', 50, 1);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Block de 12 entero', '12 x 20 x 40 cm.', '11.75 x 19.37 x 39.70 cm.', 19.79, 'imagenes/block12_entero.png', 50, 1);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Block de 15 entero', '15 x 20 x 40 cm.', '14.30 x 19.37 x 39.70 cm.', 24.79, 'imagenes/block13_entero.png', 50, 1);

INSERT INTO Pedidos (usuario_id, fecha_pedido, estado, total)
VALUES (2, '2024-11-21 10:00:00', 'pendiente', 1696.9);

INSERT INTO Detalles_Pedido (pedido_id, producto_id, cantidad, precio_unitario)
VALUES (2, 1, 10, 147.9);
INSERT INTO Detalles_Pedido (pedido_id, producto_id, cantidad, precio_unitario)
VALUES (2, 2, 6, 118.74);
INSERT INTO Detalles_Pedido (pedido_id, producto_id, cantidad, precio_unitario)
VALUES (2, 3, 4, 99.16);

INSERT INTO Reseñas (producto_id, usuario_id, calificacion, comentario, fecha)
VALUES (1, 1, 5, 'Excelente producto, muy recomendado', '2024-11-22 09:00:00');
INSERT INTO Reseñas (producto_id, usuario_id, calificacion, comentario, fecha)
VALUES (2, 1, 3, 'Producto convencional', '2024-11-22 09:00:00');
INSERT INTO Reseñas (producto_id, usuario_id, calificacion, comentario, fecha)
VALUES (3, 1, 4, 'Excelente producto', '2024-11-22 09:00:00');

INSERT INTO Inventario (producto_id, cantidad, fecha_actualizacion)
VALUES (1, 50, '2024-11-21 08:00:00');
INSERT INTO Inventario (producto_id, cantidad, fecha_actualizacion)
VALUES (2, 50, '2024-11-21 08:00:00');
INSERT INTO Inventario (producto_id, cantidad, fecha_actualizacion)
VALUES (3, 50, '2024-11-21 08:00:00');

INSERT INTO Promociones (nombre, descripcion, descuento, fecha_inicio, fecha_fin)
VALUES ('Descuento de Fin de Año', 'Descuento especial para las compras de fin de año', 100.64, '2024-11-21', '2024-12-31');

INSERT INTO Historial_Compras (usuario_id, producto_id, fecha_compra, cantidad, precio_total)
VALUES (1, 1, '2024-11-21 11:00:00', 10, 147.9);
INSERT INTO Historial_Compras (usuario_id, producto_id, fecha_compra, cantidad, precio_total)
VALUES (1, 2, '2024-11-21 11:00:00', 6, 118.74);
INSERT INTO Historial_Compras (usuario_id, producto_id, fecha_compra, cantidad, precio_total)
VALUES (1, 3, '2024-11-21 11:00:00', 4, 99.16);

INSERT INTO Envíos (pedido_id, fecha_envio, estado_envio)
VALUES (2, '2024-11-21 15:00:00', 'preparando');

INSERT INTO Carrito (usuario_id, producto_id, cantidad, fecha_agregado)
VALUES (1, 1, 10, '2024-11-20 17:00:00');
INSERT INTO Carrito (usuario_id, producto_id, cantidad, fecha_agregado)
VALUES (1, 2, 6, '2024-11-20 17:00:00');
INSERT INTO Carrito (usuario_id, producto_id, cantidad, fecha_agregado)
VALUES (1, 3, 4, '2024-11-20 17:00:00');







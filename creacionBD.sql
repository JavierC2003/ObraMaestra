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
    cantidad INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

-- Tabla de Detalles de Pedido
CREATE TABLE Detalles_Pedido (
    detalle_id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    producto_id INT,
    cantidad INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
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

-- Tabla de Envíos
CREATE TABLE Envíos (
    envio_id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    fecha_envio DATETIME NOT NULL,
    estado_envio VARCHAR(50) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id)
);

/*------insertciones--------*/
INSERT INTO Usuarios (nombre, email, contraseña, direccion, telefono, tipo_usuario)
VALUES ('Javier Cazarez', 'Javier.Cazarez@example.com', '123456', 'Calle Falsa 123', '555-1234', 'cliente');
/*------categorias--------*/
INSERT INTO Categorias (nombre, descripcion)
VALUES ('Vivienda', 'Blocks de concreto con diferentes medidas y piezas especiales que te convencerán de que son la mejor opción para la construcción.');
INSERT INTO Categorias (nombre, descripcion)
VALUES ('Bardacreto', 'Blocks decorativos, columnas y remates que permiten crear bardas de gran realce, de menor costo de obra terminada y mantenimiento.');
INSERT INTO Categorias (nombre, descripcion)
VALUES ('Techocreto', 'Vigas híbridas con armadura de refuerzo y alambre de presfuerzo que retoma lo mejor del sistema de vigueta-bovedilla-dovela.');
INSERT INTO Categorias (nombre, descripcion)
VALUES ('Adoquines', 'Adoquines de concreto que se unen a base de ensamble milimétrico, resultando en un recubrimiento ecológico y de alta calidad.');
INSERT INTO Categorias (nombre, descripcion)
VALUES ('Patiocreto', 'Con nuestros accesorios para jardín construya ese espacio excepcional y único con el que siempre soñó. Personaliza tus patios.');
-- productos categoria 1
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Block de 10 entero', '10 x 20 x 40 cm.', '9.20 x 19.37 x 39.70 cm.', 14.79, 'imagenes/block10_entero.png', 50, 1);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Block de 12 entero', '12 x 20 x 40 cm.', '11.75 x 19.37 x 39.70 cm.', 19.79, 'imagenes/block12_entero.png', 50, 1);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Block de 15 entero', '15 x 20 x 40 cm.', '14.30 x 19.37 x 39.70 cm.', 24.79, 'imagenes/block15_entero.png', 50, 1);
-- productos categoria 2
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Arquiblock de 15 Entero', '15 x 20 x 40 cm.', '14.30 x 19.37 x 39.70 cm.', 29.79, 'imagenes/arquiblock15_entero.png', 50, 2);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Arquiblock 4 Estrías Entero', '20 x 20 x 40 cm.', '19.37 x 19.37 x 39.70 cm.', 35.79, 'imagenes/arquiblock4estrias_entero.png', 50, 2);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Columblock Standar', '30 x 20 x 30 cm.', '29.52x19.37x29.52 cm', 35.79, 'imagenes/columblock_standar.png', 50, 2);
-- productos categoria 3
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('BOVEDILLA DE 60', '60 cm.', 'ENTRE EJES: 68 cm.', 89.79, 'imagenes/BOVEDILLA_60.png', 50, 3);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('BOVEDILLA DE 80', '80 cm.', ' ENTRE EJES: 90 cm.', 120.79, 'imagenes/BOVEDILLA_80.png', 50, 3);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('BOVEDILLA CON DOVELA', '60 x 20 x 13 cm.', 'ENTRE EJES: 69 cm.', 110.79, 'imagenes/BOVEDILLA_ DOVELA.png', 50, 3);
-- productos categoria 4
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Adoquín Cuadrado', '15 x 15 x 8 cm.', '15 x 15 x 8 cm.', 50.79, 'imagenes/Adoquín_Cuadrado_15.png', 50, 4);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Adoquín Tipo Hueso', '20 x 16 x 8 cm.', '20 x 16 x 8 cm.', 50.79, 'imagenes/Adoquín_Tipo_Hueso.png', 50, 4);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Adoquín Tipo Z', '21 x 10 x 8 cm.', '21 x 10 x 8 cm.', 50.79, 'imagenes/Adoquín_Tipo_Z.png', 50, 4);
-- productos categoria 5
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Banca De Concreto', '122 x 65 x 88 cm.', '122 x 65 x 88 cm.', 1500.79, 'imagenes/BANCA1.png', 50, 5);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Banca Metropolitana', '240 x 66 x 50 cm.', '240 x 66 x 50 cm.', 2000.79, 'imagenes/BANCA2.png', 50, 5);
INSERT INTO Productos (nombre, descripcion, especificaciones, precio, imagen_url, stock, categoria_id)
VALUES ('Mesa De Picnic', '180 x 155 x 80 cm.', '180 x 155 x 80 cm.', 4000.79, 'imagenes/BANCA3.png', 50, 5);





/* =========================================================
   LIMPIEZA DE TABLAS
========================================================= */
DROP TABLE IF EXISTS detallesPedidos;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS edadRecomendadProductos;
DROP TABLE IF EXISTS cantidadPiezasProductos;
DROP TABLE IF EXISTS tipoImpresionProductos;
DROP TABLE IF EXISTS modelosProductos;
DROP TABLE IF EXISTS dimensiones;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS tematicasProductos;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS tarjetas_prueba;


CREATE TABLE tarjetas_prueba (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_tarjeta VARCHAR(20) UNIQUE,
    marca VARCHAR(20),
    saldo DECIMAL(10,2),
    activa TINYINT(1) DEFAULT 1
);

INSERT INTO tarjetas_prueba (numero_tarjeta, marca, saldo, activa)
VALUES
('4111111111111111', 'VISA', 1000.00, 1),
('4012888888881881', 'VISA', 250.00, 1),
('4222222222222',     'VISA', 20.00, 1),

('5555555555554444', 'MASTERCARD', 50.00, 1),
('5105105105105100', 'MASTERCARD', 800.00, 1),
('2223003122003222', 'MASTERCARD', 0.00, 1),

('378282246310005',  'AMEX', 1500.00, 1),
('371449635398431',  'AMEX', 100.00, 1),

('6011111111111117', 'DISCOVER', 300.00, 1),

('4000000000000002', 'VISA', 500.00, 0); -- tarjeta desactivada







/* =========================================================
   USUARIOS
========================================================= */
CREATE TABLE roles(
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    descripcion varchar(80) not null
);

INSERT INTO roles(descripcion) values
('ADMIN'),('CLIENTE');


CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    idRol INT NOT NULL,
    fechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(idRol) REFERENCES roles(idRol) 
) ENGINE=InnoDB;

INSERT INTO usuarios(nombre,email,password,idRol,fechaRegistro) VALUES

('Admin','admin@gmail.com','$2y$10$0gNE9ce6hOiR0XrSneTWluoNPTAobcppWL.j69OMuz9S.dmvPbUD6',1,'2026-01-08'),
('Cliente','cliente@gmail.com','$2y$10$0gNE9ce6hOiR0XrSneTWluoNPTAobcppWL.j69OMuz9S.dmvPbUD6',2,'2026-01-08'),
('Cliente2','cliente2@gmail.com','$2y$10$0gNE9ce6hOiR0XrSneTWluoNPTAobcppWL.j69OMuz9S.dmvPbUD6',2,'2026-01-08'),
('Ronal','ronalm326@gmail.com','$2y$10$0gNE9ce6hOiR0XrSneTWluoNPTAobcppWL.j69OMuz9S.dmvPbUD6',2,'2026-01-08');


/* =========================================================
   CATEGORÍAS
========================================================= */
CREATE TABLE categorias (
    idCategoria INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

INSERT INTO categorias (descripcion) VALUES
('Abarrotes'),
('Bebidas'),
('Lácteos'),
('Carnes'),
('Frutas y Verduras'),
('Panadería'),
('Limpieza'),
('Higiene Personal'),
('Congelados'),
('Hogar');


/* =========================================================
   TEMÁTICAS
========================================================= */
CREATE TABLE tematicasProductos (
    idTematica INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(70) NOT NULL
) ENGINE=InnoDB;

INSERT INTO tematicasProductos (descripcion) VALUES
('Nestlé'),
('Coca-Cola'),
('Bimbo'),
('Lala'),
('P&G'),
('Unilever'),
('Genérico');


/* =========================================================
   PRODUCTOS (CON TIEMPO Y COSTO BASE)
========================================================= */
CREATE TABLE productos (
    idProducto INT AUTO_INCREMENT PRIMARY KEY,
    idCategoria INT NOT NULL,
    idTematica INT NOT NULL,
    nombre VARCHAR(150),
    descripcion TEXT,
    stock INT UNSIGNED NOT NULL,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0,
    img VARCHAR(100),
    activo TINYINT(1) DEFAULT 1,

   
    FOREIGN KEY (idCategoria) REFERENCES categorias(idCategoria),
    FOREIGN KEY (idTematica) REFERENCES tematicasProductos(idTematica)
) ENGINE=InnoDB;

INSERT INTO productos
(idCategoria, idTematica, nombre, descripcion, stock, precio,img, activo)
VALUES
-- Abarrotes
(1,7,'Arroz 1kg','Arroz blanco grano largo',120,1.50,'GranoLargoArroz.jpg',1),
(1,7,'Azúcar 1kg','Azúcar refinada',100,1.20,'azucarRefinada.jpg',1),

-- Bebidas
(2,2,'Coca-Cola 2L','Bebida gaseosa',80,2.50,'cocaCola2L.jpg',1),


-- Lácteos
(3,4,'Leche Entera 1L','Leche Lala',90,1.10,'lecheEntera.jpg',1),
(3,4,'Yogurt Fresa','Yogurt bebible',60,0.90,'yogurtFresa.jpg', 1),

-- Panadería
(6,3,'Pan Blanco','Pan Bimbo',70,1.30,'panBlanco.jpg', 1),

-- Limpieza
(7,5,'Detergente 1kg','Detergente en polvo',50,3.20,'detergente1kg.jpg',1),

-- Higiene
(8,5,'Shampoo 750ml','Shampoo familiar',40,4.50,'shampoo750ml.jpg',1);


-- =========================================================
-- PRODUCTOS MASIVOS
-- =========================================================

INSERT INTO productos (idCategoria, idTematica, nombre, descripcion, stock, precio, img, activo) VALUES

-- ABARROTES (Categoria 1, Tematica 7)
(1,7,'Arroz 1kg','Arroz blanco grano largo',120,1.50,'arroz1kg.jpeg',1),
(1,7,'Azúcar 1kg','Azúcar refinada',100,1.20,'azucar1kg.jpeg',1),
(1,7,'Harina 1kg','Harina de trigo',80,1.10,'harina1kg.jpeg',1),
(1,7,'Aceite 1L','Aceite vegetal',60,2.00,'aceite1L.jpg',1),
(1,7,'Sal 500g','Sal de mesa',150,0.50,'sal500g.jpg',1),
(1,7,'Frijol 1kg','Frijol negro',90,1.80,'frijol1kg.jpg',1),
(1,7,'Lenteja 500g','Lenteja',70,1.20,'lenteja500g.jpg',1),
(1,7,'Pasta 500g','Pasta espagueti',100,1.00,'pasta500g.jpg',1),
(1,7,'Café 250g','Café molido',50,2.50,'cafe250g.jpg',1),
(1,7,'Té 20 sobres','Té negro',60,1.50,'te20sobres.jpg',1),
(1,7,'Galletas 200g','Galletas dulces',80,1.20,'galletas200g.jpg',1),
(1,7,'Pan integral 500g','Pan integral',90,1.40,'panintegral500g.jpg',1),
(1,7,'Miel 250g','Miel natural',40,3.00,'miel250g.jpg',1),
(1,7,'Mayonesa 200g','Mayonesa tradicional',50,1.80,'mayonesa200g.jpg',1),
(1,7,'Mostaza 150g','Mostaza amarilla',70,1.20,'mostaza150g.jpg',1),
(1,7,'Salsa tomate 200g','Salsa de tomate',100,1.10,'salsatomate200g.jpg',1),
(1,7,'Vinagre 500ml','Vinagre blanco',90,1.00,'vinagre500ml.jpg',1),
(1,7,'Galletas saladas 200g','Galletas saladas',80,1.10,'galletassaladas200g.jpg',1),
(1,7,'Cereal 250g','Cereal desayuno',50,2.50,'cereal250g.jpg',1),
(1,7,'Chocolates 100g','Chocolate amargo',60,1.80,'chocolate100g.jpg',1),

-- BEBIDAS (Categoria 2, Tematica 2)
(2,2,'Fanta Naranja 2L','Bebida gaseosa',70,2.30,'fanta2L.jpeg',1),
(2,2,'Sprite 2L','Bebida gaseosa',60,2.30,'sprite2L.jpeg',1),
(2,2,'Jugo de Naranja 1L','Jugo natural',50,2.00,'jugoNaranja1L.jpeg',1),
(2,2,'Jugo de Manzana 1L','Jugo natural',50,2.00,'jugoManzana1L.jpg',1),
(2,2,'Cerveza 330ml','Cerveza nacional',120,1.50,'cerveza330ml.jpg',1),
(2,2,'Té helado 500ml','Té frío',100,1.20,'tehelado500ml.jpg',1),
(2,2,'Café soluble 100g','Café instantáneo',60,3.00,'cafesoluble100g.jpg',1),
(2,2,'Bebida energética 250ml','Energizante',40,2.50,'bebidaEnergetica250ml.jpg',1),
(2,2,'Agua mineral 500ml','Agua con gas',150,1.00,'aguamineral500ml.jpeg',1),
(2,2,'Leche de almendra 1L','Leche vegetal',50,3.50,'lechealmendra1L.jpg',1),
(2,2,'Bebida de soja 1L','Bebida vegetal',50,3.20,'bebidasoja1L.jpg',1),
(2,2,'Kombucha 330ml','Bebida fermentada',40,4.00,'kombucha330ml.jpg',1),
(2,2,'Smoothie fresa 250ml','Smoothie natural',30,3.50,'smoothieFresa250ml.jpg',1),
(2,2,'Smoothie mango 250ml','Smoothie natural',30,3.50,'smoothieMango250ml.jpg',1),
(2,2,'Refresco dietético 2L','Bebida sin azúcar',60,2.80,'refrescoDiet2L.jpg',1),
(2,2,'Agua saborizada 500ml','Agua sabor',100,1.20,'aguasaborizada500ml.jpg',1),
(2,2,'Jugo piña 1L','Jugo natural',50,2.10,'jugopina1L.jpg',1),
(2,2,'Jugo multifrutas 1L','Jugo natural',50,2.20,'jugomultifrutas1L.jpg',1),

-- LÁCTEOS (Categoria 3, Tematica 4)
(3,4,'Queso panela 250g','Queso fresco',40,2.50,'quesoPanela250g.jpeg',1),
(3,4,'Queso cheddar 200g','Queso cheddar',50,3.00,'quesoCheddar200g.jpeg',1),
(3,4,'Mantequilla 200g','Mantequilla natural',60,2.50,'mantequilla200g.jpeg',1),
(3,4,'Crema de leche 200ml','Crema líquida',40,1.80,'crema200ml.jpg',1),
(3,4,'Leche descremada 1L','Leche baja en grasa',50,1.10,'lecheDescremada1L.jpg',1),
(3,4,'Yogurt natural 500ml','Yogurt sin azúcar',50,1.80,'yogurtNatural500ml.jpg',1),
(3,4,'Kéfir 500ml','Bebida fermentada',30,2.50,'kefir500ml.jpg',1),
(3,4,'Queso ricotta 200g','Queso suave',40,2.50,'quesoRicotta200g.jpg',1),
(3,4,'Queso mozzarella 250g','Queso fundido',60,3.00,'quesoMozzarella250g.jpg',1),
(3,4,'Helado vainilla 1L','Helado artesanal',50,4.00,'heladoVainilla1L.jpg',1),
(3,4,'Helado chocolate 1L','Helado artesanal',50,4.00,'heladoChocolate1L.jpg',1),
(3,4,'Leche de cabra 1L','Leche natural',30,3.50,'lecheCabra1L.jpg',1),
(3,4,'Yogurt griego 200g','Yogurt griego',40,2.00,'yogurtGriego200g.jpg',1),
(3,4,'Leche condensada 400g','Leche dulce',50,2.50,'lecheCondensada400g.jpg',1),
(3,4,'Queso cottage 200g','Queso bajo grasa',40,2.20,'quesoCottage200g.jpg',1),
(3,4,'Mantequilla sin sal 200g','Mantequilla natural',30,2.80,'mantequillaSinSal200g.jpg',1),
(3,4,'Queso azul 150g','Queso fuerte',20,3.50,'quesoAzul150g.jpg',1),
(3,4,'Yogurt vainilla 500ml','Yogurt saborizado',40,1.80,'yogurtVainilla500ml.jpg',1);

-- (Se puede continuar igual para PANADERÍA, LIMPIEZA e HIGIENE)


/* =========================================================
   DIMENSIONES
========================================================= */
CREATE TABLE dimensiones (
    idDimension INT AUTO_INCREMENT PRIMARY KEY,
    ancho DECIMAL(6,2),
    largo DECIMAL(6,2),
    tiempoExtra INT DEFAULT 0,
    costoExtra DECIMAL(10,2) DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO dimensiones (ancho, largo, tiempoExtra, costoExtra) VALUES
(250, 0, 1, 0.00),   -- 250g
(500, 0, 1, 0.50),   -- 500g
(1000, 0, 1, 1.00),  -- 1kg
(2000, 0, 1, 1.80),  -- 2kg
(1500, 0, 1, 1.20);  -- 1.5L

/* =========================================================
   MODELOS
========================================================= */
CREATE TABLE modelosProductos (
    idModelo INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(80) NOT NULL,
    tiempoExtra INT DEFAULT 0,
    costoExtra DECIMAL(10,2) DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO modelosProductos (descripcion, tiempoExtra, costoExtra) VALUES
('Bolsa plástica', 1, 0.00),
('Botella PET', 0, 1.30),
('Caja de cartón', 1, 0.40),
('Lata', 1, 0.50),
('Envase retornable', 1, -0.20);


/* =========================================================
   TIPO IMPRESIÓN
========================================================= */
CREATE TABLE tipoImpresionProductos (
    idTipoImpresion INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(90) NOT NULL,
    tiempoExtra INT NOT NULL,
    costoExtra DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

INSERT INTO tipoImpresionProductos (descripcion, tiempoExtra, costoExtra) VALUES
('Producto fresco', 1, 0.00),
('Refrigerado', 1, 0.60),
('Congelado', 1, 1.20),
('No perecedero', 1, 0.00),
('Pasteurizado', 1, 0.40);

/* =========================================================
   CANTIDAD DE PIEZAS
========================================================= */
CREATE TABLE cantidadPiezasProductos (
    idCantidadPiezas INT AUTO_INCREMENT PRIMARY KEY,
    cantidad INT UNSIGNED NOT NULL,
    tiempoPorPieza INT NOT NULL,
    costoPorPieza DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;

INSERT INTO cantidadPiezasProductos (cantidad, tiempoPorPieza, costoPorPieza) VALUES
(1, 1, 0.00),   -- unidad suelta
(6, 1, 0.20),   -- pack 6
(12, 1, 0.35),  -- docena
(24, 1, 0.60);  -- caja


/* =========================================================
   EDAD RECOMENDADA
========================================================= */
CREATE TABLE edadRecomendadProductos (
    idEdadRecomendada INT AUTO_INCREMENT PRIMARY KEY,
    idCantidadPiezas INT NOT NULL,
    edadRecomendada INT UNSIGNED NOT NULL,
    FOREIGN KEY (idCantidadPiezas) REFERENCES cantidadPiezasProductos(idCantidadPiezas)
) ENGINE=InnoDB;

INSERT INTO edadRecomendadProductos (idCantidadPiezas, edadRecomendada) VALUES
(1, 0),   -- consumo general
(2, 0),
(3, 0),
(4, 0);

/* =========================================================
   PEDIDOS
========================================================= */
CREATE TABLE pedidos (
    idPedido INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    fechaPedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('PENDIENTE', 'EN_PROCESO', 'FINALIZADO', 'CANCELADO'),
    total DECIMAL(10,2) DEFAULT 0,
    tiempoTotal INT DEFAULT 0,
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
) ENGINE=InnoDB;


/* =========================================================
   DETALLES PEDIDOS
========================================================= */
CREATE TABLE detallesPedidos (
    idDetalle INT AUTO_INCREMENT PRIMARY KEY,
    idPedido INT NOT NULL,
    idProducto INT NOT NULL,
    idDimension INT NOT NULL,
    idModelo INT NOT NULL,
    idTematica INT NOT NULL,
    idTipoImpresion INT NOT NULL,
    idCantidadPiezas INT NOT NULL,

    cantidad INT UNSIGNED NOT NULL,
    costoUnitario DECIMAL(10,2) NOT NULL,
    tiempoUnitario INT NOT NULL,
    subTotal DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (idPedido) REFERENCES pedidos(idPedido),
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto),
    FOREIGN KEY (idDimension) REFERENCES dimensiones(idDimension),
    FOREIGN KEY (idModelo) REFERENCES modelosProductos(idModelo),
    FOREIGN KEY (idTematica) REFERENCES tematicasProductos(idTematica),
    FOREIGN KEY (idTipoImpresion) REFERENCES tipoImpresionProductos(idTipoImpresion),
    FOREIGN KEY (idCantidadPiezas) REFERENCES cantidadPiezasProductos(idCantidadPiezas)
) ENGINE=InnoDB;

INSERT INTO pedidos (idUsuario, fechaPedido, estado, total, tiempoTotal) VALUES
(2, '2026-01-01 10:15:00', 'CANCELADO', 25.50, 15),
(3, '2026-01-02 11:20:00', 'CANCELADO', 40.00, 20),
(4, '2026-01-03 09:10:00', 'CANCELADO', 15.75, 10),
(2, '2026-01-04 14:05:00', 'CANCELADO', 60.30, 25),
(3, '2026-01-05 16:45:00', 'CANCELADO', 22.10, 12),
(4, '2026-01-06 12:30:00', 'CANCELADO', 75.00, 30),
(2, '2026-01-07 08:25:00', 'CANCELADO', 18.90, 9),
(3, '2026-01-08 17:10:00', 'CANCELADO', 55.40, 22),
(4, '2026-01-09 13:50:00', 'CANCELADO', 33.33, 18),
(2, '2026-01-10 19:15:00', 'CANCELADO', 80.00, 35),

(3, '2026-01-11 10:40:00', 'CANCELADO', 27.60, 14),
(4, '2026-01-12 15:25:00', 'CANCELADO', 45.90, 21),
(2, '2026-01-13 11:05:00', 'CANCELADO', 19.99, 11),
(3, '2026-01-14 09:45:00', 'CANCELADO', 120.00, 40),
(4, '2026-01-15 16:30:00', 'CANCELADO', 66.60, 28),
(2, '2026-01-16 14:10:00', 'CANCELADO', 34.75, 17),
(3, '2026-01-17 18:55:00', 'CANCELADO', 23.45, 13),
(4, '2026-01-18 12:15:00', 'CANCELADO', 90.20, 32),
(2, '2026-01-19 10:05:00', 'CANCELADO', 48.80, 20),
(3, '2026-01-20 13:35:00', 'CANCELADO', 15.00, 8),

(4, '2026-01-21 17:45:00', 'CANCELADO', 77.70, 29),
(2, '2026-01-22 09:30:00', 'CANCELADO', 39.90, 19),
(3, '2026-01-23 11:55:00', 'CANCELADO', 21.10, 12),
(4, '2026-01-24 14:20:00', 'CANCELADO', 54.60, 23),
(2, '2026-01-25 16:40:00', 'CANCELADO', 88.00, 36),
(3, '2026-01-26 08:10:00', 'CANCELADO', 29.99, 15),
(4, '2026-01-27 19:05:00', 'CANCELADO', 63.25, 27),
(2, '2026-01-28 10:50:00', 'CANCELADO', 47.10, 21),
(3, '2026-01-29 15:15:00', 'CANCELADO', 18.75, 10),
(4, '2026-01-30 12:00:00', 'CANCELADO', 99.99, 38),

(2, '2026-02-01 09:10:00', 'CANCELADO', 41.20, 18),
(3, '2026-02-02 11:35:00', 'CANCELADO', 52.50, 24),
(4, '2026-02-03 14:45:00', 'CANCELADO', 36.80, 16),
(2, '2026-02-04 17:25:00', 'CANCELADO', 70.00, 30),
(3, '2026-02-05 10:55:00', 'CANCELADO', 24.60, 12),
(4, '2026-02-06 13:40:00', 'CANCELADO', 82.30, 33),
(2, '2026-02-07 16:10:00', 'CANCELADO', 19.40, 9),
(3, '2026-02-08 18:20:00', 'CANCELADO', 58.75, 26),
(4, '2026-02-09 12:35:00', 'CANCELADO', 44.44, 20),
(2, '2026-02-10 09:50:00', 'CANCELADO', 67.89, 28),

(3, '2026-02-11 15:05:00', 'CANCELADO', 31.25, 14),
(4, '2026-02-12 11:15:00', 'CANCELADO', 73.60, 29),
(2, '2026-02-13 14:30:00', 'CANCELADO', 20.00, 10),
(3, '2026-02-14 16:45:00', 'CANCELADO', 95.10, 37),
(4, '2026-02-15 10:25:00', 'CANCELADO', 49.95, 22),
(2, '2026-02-16 13:55:00', 'CANCELADO', 28.80, 13),
(3, '2026-02-17 17:35:00', 'CANCELADO', 62.00, 27),
(4, '2026-02-18 08:45:00', 'CANCELADO', 85.50, 34),
(2, '2026-02-19 12:20:00', 'CANCELADO', 30.30, 15),
(3, '2026-02-20 18:00:00', 'CANCELADO', 59.90, 25);

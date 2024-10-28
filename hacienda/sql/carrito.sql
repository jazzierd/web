CREATE TABLE carrito (
    id_carrito INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    nombre_cliente VARCHAR(255),
    id_producto INT,
    nombre_producto VARCHAR(255),
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cantidad INT,
    precio INT,
    total INT
);

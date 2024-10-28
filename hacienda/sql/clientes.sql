CREATE TABLE clientes (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100),
    correo_electronico VARCHAR(100),
    telefono VARCHAR(15),
    direccion VARCHAR(255),
    contrasena VARCHAR(255)
);
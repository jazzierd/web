CREATE TABLE productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre_producto VARCHAR(100),
    categoria_producto VARCHAR(50),
    precio DECIMAL(10, 2),
    cantidad INT
);

-- Insertar productos de la categoría "Lácteos"
INSERT INTO productos (nombre_producto, categoria_producto, precio, cantidad)
VALUES 
    ('Margarina Mazola Con Chile Jalapeño 400Gr', 'Lácteos', 34.90, 20),
    ('Queso Fyour Heart Style Parmesano 5Oz', 'Lácteos', 241.90, 15),
    ('Alimento Líquido Silk Almendra Sin Azúcar Monk Fruit 946Ml', 'Lácteos', 100.90, 25),
    ('Alimento Líquido Natures Heart Almendra 1Lt', 'Lácteos', 86.90, 18),
    ('Yogurt Líquido Sula Kids Semidescremado Probiótico', 'Lácteos', 14.90, 30),
    ('Leche Descremada Lacthosa 1Lt', 'Lácteos', 22.50, 40),
    ('Queso Mozzarella Rallado 500Gr', 'Lácteos', 150.00, 10),
    ('Mantequilla Sin Sal 250Gr', 'Lácteos', 85.00, 50),
    ('Crema Agria 500Ml', 'Lácteos', 65.00, 35),
    ('Queso Cheddar 300Gr', 'Lácteos', 120.00, 20);

-- Insertar productos de la categoría "Carnes"
INSERT INTO productos (nombre_producto, categoria_producto, precio, cantidad)
VALUES 
    ('Pechuga de Pollo 1Kg', 'Carne', 120.50, 30),
    ('Carne Molida Res 500Gr', 'Carne', 85.00, 50),
    ('Chorizo de Cerdo 1Kg', 'Carne', 105.75, 20),
    ('Costilla de Cerdo 1Kg', 'Carne', 160.00, 15),
    ('Salchicha Vienesa 12Unidades', 'Carne', 75.90, 60),
    ('Jamón de Pavo 500Gr', 'Carne', 135.00, 25),
    ('Tocino Ahumado 300Gr', 'Carne', 90.00, 40),
    ('Lomo de Res 1Kg', 'Carne', 250.00, 10),
    ('Pierna de Pollo 1Kg', 'Carne', 130.00, 35),
    ('Filete de Cerdo 1Kg', 'Carne', 140.00, 18);

-- Insertar productos de la categoría "Cereales"
INSERT INTO productos (nombre_producto, categoria_producto, precio, cantidad)
VALUES 
    ('Cereal Zucaritas 500Gr', 'Cereales', 60.00, 45),
    ('Cereal Choco Krispis 500Gr', 'Cereales', 55.00, 50),
    ('Cereal Corn Flakes 700Gr', 'Cereales', 70.00, 35),
    ('Granola Con Miel 1Kg', 'Cereales', 90.00, 20),
    ('Avena Quaker 1Kg', 'Cereales', 40.00, 60),
    ('Cereal Froot Loops 500Gr', 'Cereales', 65.00, 25),
    ('Cereal Special K 300Gr', 'Cereales', 85.00, 18),
    ('Barra Energética Granola 6 Unidades', 'Cereales', 45.00, 40),
    ('Cereal All Bran 300Gr', 'Cereales', 80.00, 30),
    ('Cereal Cheerios 400Gr', 'Cereales', 60.00, 50);

-- Insertar productos de la categoría "Limpieza"
INSERT INTO productos (nombre_producto, categoria_producto, precio, cantidad)
VALUES 
    ('Detergente Líquido Ariel 1Lt', 'Limpieza', 110.00, 40),
    ('Suavizante Downy 900Ml', 'Limpieza', 85.00, 35),
    ('Cloro Lírico 1Lt', 'Limpieza', 25.00, 50),
    ('Desinfectante Pinol 1Lt', 'Limpieza', 40.00, 45),
    ('Limpiador Ajax Fabuloso 900Ml', 'Limpieza', 55.00, 50),
    ('Toallas Desinfectantes 30Unidades', 'Limpieza', 70.00, 20),
    ('Detergente En Polvo Omo 500Gr', 'Limpieza', 95.00, 25),
    ('Lustrador De Muebles Pronto 500Ml', 'Limpieza', 80.00, 18),
    ('Limpiavidrios Windex 750Ml', 'Limpieza', 75.00, 30),
    ('Ambientador Glade 300Ml', 'Limpieza', 45.00, 35);

-- Insertar productos de la categoría "Golosinas"
INSERT INTO productos (nombre_producto, categoria_producto, precio, cantidad)
VALUES 
    ('Chocolate Snickers 50Gr', 'Golosinas', 18.00, 60),
    ('Galletas Oreo 200Gr', 'Golosinas', 25.00, 50),
    ('Paleta Payaso 30Gr', 'Golosinas', 10.00, 100),
    ('Chicles Trident 12Unidades', 'Golosinas', 15.00, 75),
    ('Bomba De Chicle Bubbaloo', 'Golosinas', 5.00, 200),
    ('Caramelos Halls 12Unidades', 'Golosinas', 12.00, 90),
    ('Gomitas Rellenas Ricolino 50Gr', 'Golosinas', 8.00, 150),
    ('Chocolates M&M 100Gr', 'Golosinas', 22.00, 80),
    ('Chicles Orbit 12Unidades', 'Golosinas', 20.00, 65),
    ('Chocolatina Hershey 50Gr', 'Golosinas', 30.00, 55);

-- Insertar productos de la categoría "Frutas"
INSERT INTO productos (nombre_producto, categoria_producto, precio, cantidad)
VALUES 
    ('Manzana Roja 1Kg', 'Frutas', 40.00, 45),
    ('Plátano 1Kg', 'Frutas', 20.00, 60),
    ('Pera 1Kg', 'Frutas', 35.00, 50),
    ('Fresa 500Gr', 'Frutas', 45.00, 30),
    ('Piña Entera 1Unid', 'Frutas', 30.00, 25),
    ('Melón 1Unid', 'Frutas', 55.00, 15),
    ('Sandía Entera 1Unid', 'Frutas', 60.00, 10),
    ('Papaya 1Kg', 'Frutas', 35.00, 20),
    ('Mango 1Kg', 'Frutas', 50.00, 30),
    ('Uvas 1Kg', 'Frutas', 75.00, 18);

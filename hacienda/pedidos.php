<?php
session_start(); // Iniciar sesión para poder acceder a la variable de sesión
include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión

// Verificar si el usuario ha iniciado sesión y si es admin


$conn = conectarse();

// Obtener los pedidos de la base de datos
$sql = "SELECT * FROM pedidos"; // Ajusta esta consulta según tus necesidades
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - La Hacienda</title>
    <link rel="stylesheet" href="carrito.css">
</head>
<body>
    <div class="container">
        <h1>Consulta de Pedidos</h1>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>ID Cliente</th>
                        <th>Nombre Cliente</th>
                        <th>Fecha del Pedido</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_pedido']; ?></td>
                            <td><?php echo $row['id_cliente']; ?></td>
                            <td><?php echo $row['nombre_cliente']; ?></td>
                            <td><?php echo $row['fecha_pedido']; ?></td>
                            <td><?php echo $row['nombre_producto']; ?></td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td>$<?php echo $row['precio_unitario']; ?></td>
                            <td>$<?php echo $row['total']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay pedidos registrados.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>
</body>
</html>

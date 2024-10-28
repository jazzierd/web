<?php
session_start(); // Iniciar sesión para poder acceder a la variable de sesión
include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio-sesion.php");
    exit();
}

$conn = conectarse();
$nombre_cliente = $_SESSION['usuario'];

// Eliminar producto del carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_carrito'])) {
    $id_carrito = $_POST['id_carrito'];
    $sql_delete = "DELETE FROM carrito WHERE id_carrito = '$id_carrito' AND nombre_cliente = '$nombre_cliente'";
    
    if ($conn->query($sql_delete) === TRUE) {
        $message = "Producto eliminado del carrito.";
    } else {
        $message = "Error al eliminar el producto: " . $conn->error;
    }
}

// Enviar pedido y registrar productos en la tabla de pedidos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar_pedido'])) {
    $sql_pedido = "INSERT INTO pedidos (id_cliente, nombre_cliente, fecha_pedido, id_producto, nombre_producto, cantidad, precio_unitario, total)
                   SELECT id_cliente, nombre_cliente, CURRENT_TIMESTAMP, id_producto, nombre_producto, cantidad, precio, total
                   FROM carrito
                   WHERE nombre_cliente = '$nombre_cliente'";

    if ($conn->query($sql_pedido) === TRUE) {
        // Limpiar carrito tras enviar el pedido
        $conn->query("DELETE FROM carrito WHERE nombre_cliente = '$nombre_cliente'");
        $message = "Pedido enviado con éxito.";
    } else {
        $message = "Error al enviar el pedido: " . $conn->error;
    }
}

// Obtener los productos del carrito del cliente actual
$sql = "SELECT * FROM carrito WHERE nombre_cliente = '$nombre_cliente'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - La Hacienda</title>
    <link rel="stylesheet" href="carrito.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <main>
            <header>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
                    <span><?php echo $_SESSION['usuario']; ?></span>
                </div>
            </header>

            <h1>Tu Carrito de Compras</h1>

            <?php if (isset($message)): ?>
                <script>
                    Swal.fire({
                        title: '<?php echo ($message) ? "Éxito" : "Error"; ?>',
                        text: '<?php echo $message; ?>',
                        icon: '<?php echo ($message) ? "success" : "error"; ?>'
                    });
                </script>
            <?php endif; ?>

            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id_producto']; ?></td>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td>$<?php echo $row['precio']; ?></td>
                                <td>$<?php echo $row['total']; ?></td>
                                <td>
                                    <form method="POST" action="carrito.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                        <input type="hidden" name="id_carrito" value="<?php echo $row['id_carrito']; ?>">
                                        <button type="submit" class="cb">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
                <!-- Botones de acciones -->
                <div class="acciones-carrito">
                    <button class="cb" onclick="window.location.href='tienda.php';">Seguir comprando</button>
                    <form method="POST" action="carrito.php">
                        <button type="submit" name="enviar_pedido" class="cb">Enviar Pedido</button>
                    </form>
                </div>
            <?php else: ?>
                <p>No tienes productos en tu carrito.</p>
                <!-- Botón para regresar a la tienda -->
                <div class="acciones-carrito">
                    <button class="cb" onclick="window.location.href='tienda.php';">Regresar a la Tienda</button>
                </div>
            <?php endif; ?>

            <?php $conn->close(); ?>
        </main>
    </div>
</body>
</html>

<?php
session_start(); 
include 'conexion.php'; 

$message = "";
$messageType = "";

// Verificar si se ha hecho clic en "Agregar al carrito"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    $conn = conectarse();

    $id_producto = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $cantidad = intval($_POST['cantidad']); // Cantidad ingresada por el usuario
    $precio = intval($_POST['precio']); // Precio extraído de la base de datos
    
    // Calcular el total
    $total = $cantidad * $precio;

    // Verificar que el usuario esté autenticado
    if (isset($_SESSION['usuario'])) {
        $nombre_cliente = $_SESSION['usuario'];
        $id_cliente = 1; // Puedes cambiar esto según cómo manejes los IDs de los clientes

        // Insertar los datos en la tabla 'carrito'
        $sql = "INSERT INTO carrito (id_cliente, nombre_cliente, id_producto, nombre_producto, cantidad, precio, total) 
                VALUES ('$id_cliente', '$nombre_cliente', '$id_producto', '$nombre_producto', '$cantidad', '$precio', '$total')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Producto agregado al carrito con éxito.";
            $messageType = "success";
        } else {
            $message = "Error al agregar el producto: " . $conn->error;
            $messageType = "error";
        }
    } else {
        $message = "Debes iniciar sesión para agregar productos al carrito.";
        $messageType = "error";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Hacienda - Tienda</title>
    <link rel="stylesheet" href="categorias.css">
    <link rel="stylesheet" href="tiendaa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>LA HACIENDA</h2>
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="tienda.php">Tienda</a></li>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="inicio-sesion.php">Iniciar sesión</a></li>
                    <li><a href="registro.php">Registro</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <main>
            <header>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <span><?php echo $_SESSION['usuario']; ?></span>
                    <?php endif; ?>
                </div>
            </header>
            <h1>Productos de Limpieza</h1><br>

            <section class="pepes">
<?php
$conn = conectarse();

$sql = "SELECT * FROM productos WHERE categoria_producto = 'Limpieza'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Extraemos el precio del producto
        $precio_producto = intval($row['precio']);
?>
    <div class="pepes">
        <div class="producto">
            <h3><?php echo $row['nombre_producto']; ?></h3>
            <p>Precio: $<?php echo $precio_producto; ?></p>
            <p>Cantidad disponible: <?php echo $row['cantidad']; ?></p>
            <form method="POST" action="">
                <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
                <input type="hidden" name="nombre_producto" value="<?php echo $row['nombre_producto']; ?>">
                <input type="hidden" name="precio" value="<?php echo $precio_producto; ?>">

                <!-- Input para la cantidad -->
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="1" min="1" required>

                <button type="submit" class="cb">Agregar al carrito</button>
            </form>
        </div>
    </div>
<?php
    }
} else {
    echo "<p>No se encontraron productos en la categoría de Limpieza.</p>";
}

$conn->close();
?>
            </section>
        </main>
    </div>

    <?php if ($message): ?>
        <script>
            Swal.fire({
                title: '<?php echo ($messageType === "error") ? "Error!" : "Éxito!"; ?>',
                text: '<?php echo $message; ?>',
                icon: '<?php echo $messageType; ?>'
            });
        </script>
    <?php endif; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Registro de Clientes - La Hacienda</title>
    <link rel="stylesheet" href="registro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
include("conexion.php");

$message = ""; // Variable para almacenar el mensaje
$messageType = ""; // Variable para almacenar el tipo de mensaje

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['name'];
    $correo_electronico = $_POST['email'];
    $telefono = $_POST['phone'];
    $direccion = $_POST['address'];
    $contrasena = $_POST['password']; // No encriptar la contraseña

    // Conectar a la base de datos
    $link = conectarse();

    // Verificar si el correo ya existe
    $query = "SELECT * FROM clientes WHERE correo_electronico = ?";
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "s", $correo_electronico);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Si ya existe, guardar el mensaje
        $message = "Cliente ya existe, intente de nuevo.";
        $messageType = "error"; // Tipo de mensaje para error
    } else {
        // Insertar nuevo cliente
        $query = "INSERT INTO clientes (nombre_completo, correo_electronico, telefono, direccion, contrasena) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción: " . mysqli_error($link));
        }

        mysqli_stmt_bind_param($stmt, "sssss", $nombre_completo, $correo_electronico, $telefono, $direccion, $contrasena);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Cliente registrado con éxito.";
            $messageType = "success"; // Tipo de mensaje para éxito
        } else {
            $message = "Error en la inserción: " . mysqli_error($link);
            $messageType = "error"; // Tipo de mensaje para error
        }
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
?>

<body>
    <div class="container">
        <!-- Barra lateral -->
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

        <!-- Contenido principal -->
        <div class="main-content">
            <header>
            <div class="user-icon">
    <i class="fas fa-user"></i>
    <?php if (isset($_SESSION['usuario'])): ?>
        <span><?php echo $_SESSION['usuario']; ?></span>
    <?php endif; ?>
</div>

            </header>
            <h1>Registro de Clientes</h1>
            <form class="registration-form" method="POST" id="registrationForm">
                <label for="name">Nombre Completo:</label>
                <input type="text" id="name" name="name" placeholder="Ingresa el nombre completo" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa el correo electrónico" required>

                <label for="phone">Número de Teléfono:</label>
                <input type="tel" id="phone" name="phone" placeholder="Ingresa el número de teléfono" required>

                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" placeholder="Ingresa la dirección" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa la contraseña" required>

                <button type="submit">Registrar Cliente</button>
            </form>
        </div>
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

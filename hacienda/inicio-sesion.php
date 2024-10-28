<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: tienda.php"); // Redirigir a la tienda si ya ha iniciado sesión
    exit();
}

include("conexion.php");

$message = ""; // Variable para almacenar el mensaje
$messageType = ""; // Variable para almacenar el tipo de mensaje

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST['name'];
    $contrasena = $_POST['password'];

    // Conectar a la base de datos
    $link = conectarse();

    // Verificar si el nombre y la contraseña coinciden
    $query = "SELECT id FROM clientes WHERE nombre_completo = ? AND contrasena = ?";
    $stmt = mysqli_prepare($link, $query);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, "ss", $nombre_completo, $contrasena);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Si coinciden, obtener el ID del usuario
        mysqli_stmt_bind_result($stmt, $id_usuario);
        mysqli_stmt_fetch($stmt);

        // Iniciar sesión y guardar el nombre del usuario y el ID en la sesión
        $_SESSION['usuario'] = $nombre_completo;
        $_SESSION['id_usuario'] = $id_usuario; // Guardar el ID del usuario

        // Verificar si el usuario es admin
        if ($nombre_completo === 'admin') {
            $_SESSION['tipo_usuario'] = 'admin'; // Indicador de que es admin
        } else {
            $_SESSION['tipo_usuario'] = 'usuario'; // Indicador de que es un usuario normal
        }

        // Mensaje de éxito
        $message = "Has iniciado sesión correctamente.";
        $messageType = "success";

        // Redirigir a la tienda
        header("Location: tienda.php");
        exit();
    } else {
        // Si no coinciden, mensaje de error
        $message = "Información incorrecta, intente de nuevo.";
        $messageType = "error";
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Iniciar Sesión - La Hacienda</title>
    <link rel="stylesheet" href="registro.css">
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
                <li><a href="inicio-sesion.php">Iniciar sesión</a></li>
                <li><a href="registro.php">Registro</a></li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
                    <!-- Mostrar el nombre del usuario si ha iniciado sesión -->
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <span><?php echo $_SESSION['usuario']; ?></span>
                    <?php endif; ?>
                </div>
            </header>

            <h1>Iniciar Sesión</h1>
            <form class="registration-form" method="POST" id="loginForm">
                <label for="name">Nombre Completo:</label>
                <input type="text" id="name" name="name" placeholder="Ingresa tu nombre completo" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                <button type="submit">Iniciar Sesión</button>
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

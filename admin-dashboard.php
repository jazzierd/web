<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("Location: acceso-denegado.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
</head>
<body>
    <h1>Bienvenido al Panel de Administración, <?php echo $_SESSION['usuario']; ?></h1>
    <p>Aquí puedes gestionar el contenido de la tienda.</p>
</body>
</html>

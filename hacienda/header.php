<?php
// session_start(); // Eliminar esta línea

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    echo '<a href="logout.php">Cerrar sesión</a>'; // Agregar enlace para cerrar sesión
} else {
    echo '<a href="inicio-sesion.php">Iniciar sesión</a>'; // Enlace a iniciar sesión
}
?>

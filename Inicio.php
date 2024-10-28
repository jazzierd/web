<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Hacienda - Inicio</title>
    <link rel="stylesheet" href="inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Barra lateral -->
        <div class="sidebar">
            <h2 class="nop">LA HACIENDA</h2>
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="tienda.php">Tienda</a></li>
                <!-- Mostrar enlaces de inicio de sesión o cerrar sesión según si el usuario está logueado -->
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
                    <!-- Mostrar el nombre del usuario si ha iniciado sesión -->
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <span><?php echo $_SESSION['usuario']; ?></span>
                    <?php endif; ?>
                </div>
            </header>
            
            <h1>LA HACIENDA</h1>
            <section class="ci" id="informacion">
                <h2>Bienvenido a La Hacienda</h2><br>
                <p>En La Hacienda, ofrecemos productos frescos y de calidad a precios competitivos. Nuestro compromiso es brindarte una experiencia de compra excepcional.</p>
            </section>

            <section class="ci" id="productos">
                <h2>Nuestros Productos</h2><br>
                <p>Descubre una amplia gama de productos, desde lácteos y carnes hasta frutas y verduras. Trabajamos con proveedores locales para garantizar la frescura.</p>
            </section>

            <section class="ci" id="ofertas">
                <h2>Ofertas Especiales</h2><br>
                <p>No te pierdas nuestras ofertas semanales. Visita regularmente nuestra sección de ofertas para obtener descuentos exclusivos en tus productos favoritos.</p>
            </section>

            <section class="ci" id="servicios">
                <h2>Servicios Adicionales</h2><br>
                <p>Además de nuestra amplia selección de productos, ofrecemos servicios como entrega a domicilio y pedidos en línea para tu comodidad.</p>
            </section>
        </main>
    </div>
</body>
</html>

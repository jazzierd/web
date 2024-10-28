<?php
session_start(); // Iniciar sesión para poder acceder a la variable de sesión
include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Hacienda - Tienda</title>
    <link rel="stylesheet" href="tiendaa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- SweetAlert2 CDN -->
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
            <h1>Tienda</h1>

            <section id="categorias">
                <div class="categoria lacteos">
                    <img src="./img/lacteos.png" alt="Lácteos"><br>
                    <input class="cb" type="button" value="Lácteos" onclick="window.location.href='lacteos.php';">
                </div>
                <div class="categoria mover">
                    <img src="./img/carne.png" alt="Carnes"><br>
                    <input class="cb" type="button" value="Carnes" onclick="window.location.href='carnes.php';">
                </div>
                <div class="categoria mover">
                    <img src="./img/cereales.png" alt="Cereales"><br>
                    <input class="cb" type="button" value="Cereales" onclick="window.location.href='cereales.php';">
                </div>
                <div class="categoria mover">
                    <img src="./img/limpieza.png" alt="Limpieza"><br>
                    <input class="cb" type="button" value="Limpieza" onclick="window.location.href='limpieza.php';">
                </div>
                <div class="categoria mover">
                    <img src="./img/galleta.png" alt="Golosinas"><br>
                    <input class="cb" type="button" value="Golosinas" onclick="window.location.href='golosinas.php';">
                </div>
                <div class="categoria mover">
                    <img src="./img/verduras.png" alt="Frutas y verduras"><br>
                    <input class="cb" type="button" value="Frutas y verduras" onclick="window.location.href='frutas.php';">
                </div>
            </section>

            <section id="busqueda">
                <div class="wasa"><input type="text" placeholder="Buscar por ID del producto" class="busqueda"> <input class="pepe" type="button" value="Buscar"></div>
                <div class="wasa"><input type="text" placeholder="Buscar por nombre del producto" class="busqueda mover2"><input class="pepe" type="button" value="Buscar"></div>
            </section>

            <section id="acciones">
    <button class="cb" id="carrito" onclick="verificarSesion();">Carrito</button>
    <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin'): ?>
        <button class="cb" id="pedidos" onclick="window.location.href='pedidos.php';">Pedidos</button>
    <?php endif; ?>
</section>

        </main>
    </div>

    <script>
        function verificarSesion() {
            // Verificamos si el usuario ha iniciado sesión con una variable PHP
            var usuarioIniciado = <?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>;

            if (!usuarioIniciado) {
                // Si no ha iniciado sesión, mostramos el mensaje de error
                Swal.fire({
                    title: 'Error',
                    text: 'Debes iniciar sesión para acceder al carrito.',
                    icon: 'error',
                    confirmButtonText: 'Iniciar sesión',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario presiona "Iniciar sesión", lo llevamos a la página de inicio de sesión
                        window.location.href = 'inicio-sesion.php';
                    }
                });
            } else {
                // Si ha iniciado sesión, redirigimos al carrito
                window.location.href = 'carrito.php';
            }
        }
    </script>

</body>
</html>

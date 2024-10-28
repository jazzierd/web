<?php
session_start();
include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión

$categoria = $_GET['categoria'];

// Consulta para obtener productos de la categoría seleccionada
$query = "SELECT nombre_producto, precio, cantidad FROM hacienda WHERE categoria_producto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $categoria);
$stmt->execute();
$result = $stmt->get_result();

$productos = [];
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);
?>
